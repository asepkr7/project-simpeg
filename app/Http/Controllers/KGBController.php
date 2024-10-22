<?php

namespace App\Http\Controllers;

use App\Models\KGB;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class KGBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $kgb = KGB::with('pegawai')
        ->where('pegawai_id', auth()->user()->pegawai->id)->
        orderBy('gapok_lama')->
        filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $kgb = KGB::with(['pegawai'])
            ->orderBy('gapok_lama')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('kgb.index',[
            'title' => 'KGB',
            'kgb' => $kgb
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lastkgb = KGB::latest('no_surat')->first();
    $urutan = $lastkgb ? intval(substr($lastkgb->no_surat, 6, 3)) + 1 : 1; // Ambil urutan dan tambahkan 1
    $now = Carbon::now();
    $tahunSaatIni = $now->year; // Dapatkan tahun saat ini menggunakan Carbon
     // Format urutan menjadi tiga digit dengan sprintf
    $formattedUrutan = sprintf('%03d', $urutan);
    $noSurat = "830/{$formattedUrutan}/431.315.1.1/{$tahunSaatIni}";

         return view('kgb.create',[
            'title' => 'KGB',
            'pegawai' => Pegawai::all(),
            'surat' => $noSurat
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'pejabat_sk_lama' => 'required|string',
            'gapok_lama' => 'required|numeric',
            'tmt_lama' => 'required|date',
            'masa_kerja_lama' => 'required',
            'no_sk_lama' => 'required',
            'tanggal_sk_lama' => 'required',
            'gapok_baru' => 'required|numeric',
            'tmt_baru' => 'required|date',
            'masa_kerja_baru' => 'required',
            // 'tanggal' => 'required|date',
            'naik_lanjut' => 'required|date',
        ]);

        $lastkgb = KGB::latest('no_surat')->first();
    $urutan = $lastkgb ? intval(substr($lastkgb->no_surat, 6, 3)) + 1 : 1; // Ambil urutan dan tambahkan 1
    $now = Carbon::now();
    $tahunSaatIni = $now->year; // Dapatkan tahun saat ini menggunakan Carbon
     // Format urutan menjadi tiga digit dengan sprintf
    $formattedUrutan = sprintf('%03d', $urutan);
    $noSurat = "830/{$formattedUrutan}/431.315.1.1/{$tahunSaatIni}";

    $kgb = new KGB;
    $kgb->pejabat_sk_lama = $validatedData['pejabat_sk_lama'];
    $kgb->gapok_lama = $validatedData['gapok_lama'];
    $kgb->tmt_lama = $validatedData['tmt_lama'];
    $kgb->masa_kerja_lama = $validatedData['masa_kerja_lama'];
    $kgb->no_sk_lama = $validatedData['no_sk_lama'];
    $kgb->tanggal_sk_lama = $validatedData['tanggal_sk_lama'];
    $kgb->gapok_baru = $validatedData['gapok_baru'];
    $kgb->tmt_baru = $validatedData['tmt_baru'];
    $kgb->masa_kerja_baru = $validatedData['masa_kerja_baru'];
    $kgb->no_surat = $noSurat;
    // $kgb->tanggal = $validatedData['tanggal'];
    $kgb->naik_lanjut = $validatedData['naik_lanjut'];
    $kgb->pegawai_id = $validatedData['pegawai_id'];

        $kgb->save();
        return redirect('/petugas/kgb')->with('success', 'Data KGB Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KGB $kgb)
    {
        return view('kgb.edit',[
            'title' => 'Jabatan',
            'pegawai' => Pegawai::all(),
            'kgb' => $kgb,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KGB $kgb)
    {
          $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'pejabat_sk_lama' => 'required|string',
            'gapok_lama' => 'required|numeric',
            'tmt_lama' => 'required|date',
            'masa_kerja_lama' => 'required',
            'no_sk_lama' => 'required',
            'tanggal_sk_lama' => 'required',
            'gapok_baru' => 'required|numeric',
            'tmt_baru' => 'required|date',
            'masa_kerja_baru' => 'required',
            // 'tanggal' => 'required|date',
            'naik_lanjut' => 'required|date',
        ]);

        KGB::where('id', $kgb->id)->update($validatedData);
        return redirect('/petugas/kgb')->with('edit', 'Data KGB Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KGB $kgb)
    {
        KGB::destroy($kgb->id);
        return redirect('/petugas/kgb')->with('delete', 'Data KGB Berhasil dihapus');
    }

    public function print($id)
{
    $kgb = KGB::with('pegawai.pangkat', 'pegawai.jabatan')->findOrFail($id);
    $nama = $kgb->pegawai->nama;

    $pdf = Pdf::loadView('kgb.cetak', ['kgb' => $kgb, 'nama' => $nama]);
    $pdf->setPaper('legal', 'portrait');

    return $pdf->stream("surat kgb $nama.pdf");
}

public function laporan(Request $request)
{
     $tahun = Carbon::now()->year;
     $bulan = $request->input('bulan');


$kgb = KGB::with('pegawai.pangkat', 'pegawai.jabatan')
            ->whereYear('tmt_baru', $tahun)
            ->whereMonth('tmt_baru', $bulan)
            ->get();

 $pdf = Pdf::loadView('kgb.laporan', ['kgb' => $kgb, 'bulan' => $bulan]);
 $pdf->setPaper('legal', 'landscape');

  return $pdf->stream("Laporan KGB");
}

public function filterskgb()
{
    return view('kgb.filters');
}

}