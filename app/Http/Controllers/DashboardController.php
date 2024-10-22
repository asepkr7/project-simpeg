<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\KGB;
use App\Models\Pasangan;
use App\Models\Pegawai;
use App\Models\PengajuanCuti;
use App\Models\Pensiun;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all()->count();
        $pria = Pegawai::where('gender', 'l')->count();
        $wanita = Pegawai::where('gender', 'p')->count();
        $users = User::all()->count();
        $cuti = PengajuanCuti::where('status', 'Pending')->count();
        $anak =  Anak::with('pegawai')->where('pegawai_id',auth()->user()->pegawai->id)->count();
        $istri = Pasangan::with('pegawai')->where('pegawai_id',auth()->user()->pegawai->id)->count();
        $total = $anak + $istri;
        $kgb = KGB::all()->count();
        $pensiun = Pensiun::all()->count();
        $pns = Pegawai::where('status_kepegawaian', 'PNS')->count();
        $pppk = Pegawai::where('status_kepegawaian', 'PPPK')->count();
        $tkk = Pegawai::where('status_kepegawaian', 'TKK')->count();
        $cpns = Pegawai::where('status_kepegawaian', 'CPNS')->count();
        $honorer = Pegawai::where('status_kepegawaian', 'HONORER')->count();
        $magang = Pegawai::where('status_kepegawaian', 'Magang')->count();
        $total_cuti = PengajuanCuti::with('pegawai')->where('pegawai_id',auth()->user()->pegawai->id)->count();

        // dd($tgl);
        return view('dashboard', compact('pegawai','users', 'pria', 'wanita', 'cuti','anak', 'total', 'pns', 'pppk', 'tkk', 'honorer', 'cpns', 'magang', 'pensiun', 'kgb',
                    'total_cuti'));
    }
}