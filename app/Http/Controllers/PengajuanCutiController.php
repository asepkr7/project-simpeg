<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\NotifCuti;
use App\Models\Pegawai;
use App\Models\PengajuanCuti;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Milon\Barcode\DNS1D;

class PengajuanCutiController extends Controller
{
    public function index(Request $request)
    {
         $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
         if (Auth::user()->level == 'Pegawai') {
            $cuti = PengajuanCuti::with('pegawai')->where('pegawai_id', auth()->user()->pegawai->id)->orderBy('tanggal_surat')->filter(request(['search']))
               ->paginate($showEntries)->withQueryString();
         }else{
            $cuti = PengajuanCuti::with('pegawai')->orderBy('tanggal_surat')->filter(request(['search']))
               ->paginate($showEntries)->withQueryString();
         }
        return view('cuti.index',[
            'title' => 'Cuti',
            'pengajuan_cuti' => $cuti
        ]);
    }

    public function create()
    {
         $lastCuti = PengajuanCuti::where('status', 'Diterima')->latest('no_surat')->first();
    $urutan = $lastCuti ? intval(substr($lastCuti->no_surat, 6, 3)) + 1 : 1; // Ambil urutan dan tambahkan 1
    $now = Carbon::now();
    $tahunSaatIni = $now->year; // Dapatkan tahun saat ini menggunakan Carbon
     // Format urutan menjadi tiga digit dengan sprintf
    $formattedUrutan = sprintf('%03d', $urutan);
     $noSurat = "854/{$formattedUrutan}/431.405.1/{$tahunSaatIni}";

        return view('cuti.create',[
            'pegawai' => Pegawai::all(),
            'surat' => $noSurat
        ]);
    }

    private function generateNomorSurat($status)
{
    if ($status == 'Pending') {
        $lastPendingCuti = PengajuanCuti::where('status', 'Pending')->latest('no_surat')->first();
        $urutan = $lastPendingCuti ? intval(substr($lastPendingCuti->no_surat, 6, 3)) + 1 : 1;
        $now = Carbon::now();
        $tahunSaatIni = $now->year;
        $formattedUrutan = sprintf('%03d', $urutan);
        return "854/{$formattedUrutan}/431.405.1/{$tahunSaatIni}";
    } else {
        $lastAcceptedCuti = PengajuanCuti::where('status', 'Diterima')->latest('no_surat')->first();
        $urutan = $lastAcceptedCuti ? intval(substr($lastAcceptedCuti->no_surat, 6, 3)) + 1 : 1;
        $now = Carbon::now();
        $tahunSaatIni = $now->year;
        $formattedUrutan = sprintf('%03d', $urutan);
        return "855/{$formattedUrutan}/431.405.1/{$tahunSaatIni}";
    }
}

    Public function store(Request $request)
    {

        $validatedData = $request->validate([
            'pegawai_id' => 'required',
            'jenis_cuti' => 'required',
            'alasan' => 'nullable',
            // 'tanggal_surat' => 'required',
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

         $lastCuti = PengajuanCuti::where('status', 'Diterima')->latest('no_surat')->first();
    $urutan = $lastCuti ? intval(substr($lastCuti->no_surat, 6, 3)) + 1 : 1; // Ambil urutan dan tambahkan 1
    $now = Carbon::now();
    $tahunSaatIni = $now->year; // Dapatkan tahun saat ini menggunakan Carbon
     // Format urutan menjadi tiga digit dengan sprintf
    $formattedUrutan = sprintf('%03d', $urutan);
     $noSurat = "854/{$formattedUrutan}/431.405.1/{$tahunSaatIni}";

        $cuti = new PengajuanCuti;
        $cuti->jenis_cuti = $validatedData['jenis_cuti'];
        $cuti->alasan = $validatedData['alasan'];
        $cuti->no_surat = $noSurat;
        // $cuti->tanggal_surat = $validatedData['tanggal_surat'];
        $cuti->mulai = $validatedData['mulai'];
        $cuti->selesai = $validatedData['selesai'];
        $cuti->status = 'Pending'; // Default status pengajuan cuti

         if (Auth::user()->level == 'Petugas') {
        // Jika pengguna adalah admin, tambahkan pengajuan cuti untuk pegawai tertentu
        $cuti->pegawai_id = $validatedData['pegawai_id'];
    } else {
        // Jika pengguna bukan admin, tambahkan pengajuan cuti untuk diri sendiri
        $cuti->pegawai_id = auth()->user()->pegawai->id;
    }

        $cuti->save();
        return redirect('/petugas/pengajuan-cuti')->with('success', 'Pengajuan Cuti Berhasil diajukan');
    }
    public function approve(PengajuanCuti $cuti)
    {
        $cuti->status ='Diterima';
         $cuti->no_surat = $this->generateNomorSurat('Diterima');

        // Kirim email notifikasi pengajuan cuti yang disetujui
        Mail::to($cuti->pegawai->email)->send(new NotifCuti($cuti));
        $cuti->save();
        return redirect('/petugas/pengajuan-cuti')->with('success', 'Pengajuan cuti berhasil disetujui');
    }
    public function reject(PengajuanCuti $cuti)
    {
        $cuti->status ='Ditolak';
        Mail::to($cuti->pegawai->email)->send(new NotifCuti($cuti));
        $cuti->save();
        return redirect('/petugas/pengajuan-cuti')->with('reject', 'Pengajuan cuti berhasil ditolak');
    }

    public function cancel(PengajuanCuti $cuti)
    {
        $cuti->delete();
        return redirect('/petugas/pengajuan-cuti')->with('reject', 'Pengajuan cuti dibatalkan');
    }

// private function generateBarcode($content)
// {
//     $barcode = new DNS1D();
//     $barcode->setStorPath(public_path('barcodes')); // Simpan gambar barcode di folder 'barcodes'
//     $path = $barcode->getBarcodePNG($content, 'C128');

//     return $path;
// }
public function print($id)
{
    $cuti = PengajuanCuti::with('pegawai.pangkat', 'pegawai.jabatan')->findOrFail($id);
    $nama = $cuti->pegawai->nama;

    //  // Menghasilkan barcode dari nomor surat
    // $barcodeContent = $cuti->no_surat; // Ubah sesuai kebutuhan jika nomor surat bukan atribut langsung dari $cuti
    // $barcode = $this->generateBarcode($barcodeContent);

    $pdf = Pdf::loadView('cuti.cetak', ['cuti' => $cuti, 'nama' => $nama]);
    $pdf->setPaper('letter', 'portrait');

    return $pdf->stream("surat cuti $nama.pdf");
}

public function laporan(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = Carbon::now()->year;
    $laporan = PengajuanCuti::with('pegawai.pangkat', 'pegawai.jabatan')
            ->whereYear('mulai', $tahun)
            ->whereMonth('mulai', $bulan)
            ->where('status', 'Diterima')
            ->get();


    $pdf =  Pdf::loadView('cuti.laporan', ['laporan' => $laporan, 'bulan' => $bulan]);
    $pdf->setPaper('legal', 'landscape');

    return $pdf->stream("Laporan Cuti");
}
public function filterscuti()
{
    return view('cuti.filters');
}

}