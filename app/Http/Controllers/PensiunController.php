<?php

namespace App\Http\Controllers;

use App\Mail\NotifPensiun;
use App\Models\Pensiun;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PensiunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $showEntries = $request->input('show_entries',Session::get('show_entries', 100));
         $selectedYear = $request->input('tahun');
         $query = Pegawai::with(['jabatan','pangkat','pensiun']);


        if ($selectedYear !== 'all') {
            $query->whereYear('tanggal_lahir', '<=', $selectedYear - 58);
        }

        $pegawai = $query->orderBy('nama')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
// ================================


         $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $pensiun = Pensiun::with('pegawai')
        ->where('pegawai_id', auth()->user()->pegawai->id)->
        orderBy('jenis_pensiun')->
        filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $pensiun = Pensiun::with(['pegawai'])
            ->orderBy('jenis_pensiun')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('pensiun.index',[
            'title' => 'Pensiun',
            'pensiun' => $pensiun,
            'pegawai' => $pegawai,
            'selectedYear' =>$selectedYear,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $lastPensiun = Pensiun::latest('no_surat')->first();
    $urutan = $lastPensiun ? intval(substr($lastPensiun->no_surat, 6, 3)) + 1 : 1; // Ambil urutan dan tambahkan 1
    $now = Carbon::now();
    $tahunSaatIni = $now->year; // Dapatkan tahun saat ini menggunakan Carbon
     // Format urutan menjadi tiga digit dengan sprintf
    $formattedUrutan = sprintf('%03d', $urutan);
     $noSurat = "900/{$formattedUrutan}/431.315.1.1/{$tahunSaatIni}";
         return view('pensiun.create',[
            'title' => 'Pensiun',
            'pegawai' => Pegawai::all(),
              'surat' => $noSurat,
              'now' => $now
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'jenis_pensiun' => 'required|string',
            'tmt_pensiun' => 'required:date',
            'alasan' =>'required',
            // 'tanggal_surat' => 'required',
            'masa_kerja' => 'required|string',
            'alamat_pensiun' => 'required',
        ]);

         $lastPensiun = Pensiun::latest('no_surat')->first();
    $urutan = $lastPensiun ? intval(substr($lastPensiun->no_surat, 6, 3)) + 1 : 1; // Ambil urutan dan tambahkan 1
    $now = Carbon::now();
    $tahunSaatIni = $now->year; // Dapatkan tahun saat ini menggunakan Carbon
     // Format urutan menjadi tiga digit dengan sprintf
    $formattedUrutan = sprintf('%03d', $urutan);
     $noSurat = "900/{$formattedUrutan}/431.315.1.1/{$tahunSaatIni}";

     $pensiun = new Pensiun;
     $pensiun->pegawai_id = $validatedData['pegawai_id'];
     $pensiun->jenis_pensiun = $validatedData['jenis_pensiun'];
     $pensiun->tmt_pensiun = $validatedData['tmt_pensiun'];
     $pensiun->alasan = $validatedData['alasan'];
     $pensiun->no_surat = $noSurat;
    //  $pensiun->tanggal_surat = $validatedData['tanggal_surat'];
     $pensiun->masa_kerja = $validatedData['masa_kerja'];
     $pensiun->alamat_pensiun = $validatedData['alamat_pensiun'];

        $pensiun->save();
        return redirect('/petugas/pensiun')->with('success', 'Data Pensiun Berhasil ditambahkan');
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
    public function edit(Pensiun $pensiun)
    {
          return view('pensiun.edit',[
            'title' => 'Pensiun',
            'pegawai' => Pegawai::all(),
            'pensiun' => $pensiun,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pensiun $pensiun)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'jenis_pensiun' => 'required|string',
            'tmt_pensiun' => 'required:date',
            'alasan' =>'required',
            // 'no_surat' => 'required',
            // 'tanggal_surat' => 'required|date',
            'masa_kerja' => 'required|string',
            'alamat_pensiun' => 'required',
        ]);
        Pensiun::where('id', $pensiun->id)->update($validatedData);
        return redirect('/petugas/pensiun')->with('edit', 'Data Pensiun Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pensiun $pensiun)
    {
        Pensiun::destroy($pensiun->id);
        return redirect('/petugas/pensiun')->with('delete', 'Data Pensiun Berhasil dihapus');
    }

    public function print($id)
{
    $pensiun = Pensiun::with('pegawai.pangkat', 'pegawai.jabatan',)->findOrFail($id);
    $nama = $pensiun->pegawai->nama;

    $pdf = Pdf::loadView('pensiun.cetak', ['pensiun' => $pensiun, 'nama' => $nama]);
    $pdf->setPaper('legal', 'potrait');

    return $pdf->stream("Surat Pensiun $nama.pdf");
}

 public function notif(Pegawai $id)
    {
         Mail::to($id->email)->send(new NotifPensiun($id));
        return redirect('/petugas/pensiun')->with('success', 'Notifikasi Pensiun Berhasil dikirim');
    }

    public function laporan(Request $request)
    {
    $tahun = Carbon::now()->year;
    $bulan = $request->input('bulan');

$laporan = Pensiun::with('pegawai.pangkat', 'pegawai.jabatan')
            ->whereYear('tmt_pensiun', $tahun)
            ->whereMonth('tmt_pensiun', $bulan)
            ->get();

 $pdf = Pdf::loadView('pensiun.laporan', ['laporan' => $laporan, 'bulan' => $bulan]);
 $pdf->setPaper('legal', 'landscape');

  return $pdf->stream("Laporan Pensiun");
    }

public function filterspensiun()
{
return view('pensiun.filters');
}

}