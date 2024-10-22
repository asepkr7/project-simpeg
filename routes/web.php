<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\DataOrtuController;
use App\Http\Controllers\DataPasanganController;
use App\Http\Controllers\DiklatController;
use App\Http\Controllers\GapokController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KGBController;
use App\Http\Controllers\LampiranController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\PengajuanCutiController;
use App\Http\Controllers\PenghargaanController;
use App\Http\Controllers\PensiunController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(fn()=>
Route::get('/login', [LoginController::class, 'index'])->name('login'),
Route::post('/login', [LoginController::class, 'login']),
);

Route::get('/home', fn()=> redirect('/'));

Route::get('/logout', [LoginController::class, 'logout']);
Route::get('/', function(){
 if (Auth::check()) {
    if (Auth::user()->level == 'Petugas') {
        return redirect()->route('pimpinan.dashboard');
    }elseif (Auth::user()->level == 'Pimpinan') {
        return redirect()->route('pimpinan.dashboard');
    }else{
        return redirect()->route('pegawai.dashboard');
    }
 }else {
    return redirect()->route('login');
 }
});

// Route SuperAdmin (Petugas)
Route::middleware(['auth'])->prefix('petugas')->group(fn()=>

Route::get('/dashboard',[DashboardController::class,'index'])->name('petugas.dashboard')->middleware('checkLevel:Petugas'),
Route::resource('/petugas/data-pegawai',PegawaiController::class)->middleware('checkLevel:Petugas'),
Route::get('/petugas/data-pegawai/cetak/{id}',[PegawaiController::class,'cetak'])->middleware('checkLevel:Petugas'),
Route::get('/petugas/data-pegawai/profil/{id}',[PegawaiController::class,'profil'])->middleware('checkLevel:Petugas'),

Route::resource('/petugas/data-anak', DataAnakController::class)->middleware('checkLevel:Petugas'),
Route::resource('/petugas/data-pasangan', DataPasanganController::class)->middleware('checkLevel:Petugas'),
Route::resource('/petugas/data-ortu', DataOrtuController::class)->middleware('checkLevel:Petugas'),
Route::resource('/petugas/users',UsersController::class)->middleware('checkLevel:Petugas'),
Route::resource('/petugas/pangkat',PangkatController::class)->middleware('checkLevel:Petugas'),
Route::put('/petugas/pangkat/{id}/upload',[PangkatController::class,'upload'])->name('petugas.upload')->middleware('checkLevel:Petugas'),

Route::resource('/petugas/jabatan',JabatanController::class)->middleware('checkLevel:Petugas'),
Route::resource('/petugas/diklat',DiklatController::class)->middleware('checkLevel:Petugas'),
Route::resource('/petugas/penghargaan',PenghargaanController::class)->middleware('checkLevel:Petugas'),
Route::resource('/petugas/gapok',GapokController::class)->middleware('checkLevel:Petugas'),
Route::get('/petugas/lampiran',[LampiranController::class,'index'])->middleware('checkLevel:Petugas'),
Route::resource('/petugas/kgb',KGBController::class)->middleware('checkLevel:Petugas'),
Route::get('/petugas/kgb/print/{id}',[KGBController::class,'print'])->middleware('checkLevel:Petugas'),
Route::resource('/petugas/pensiun',PensiunController::class)->middleware('checkLevel:Petugas'),
Route::get('/petugas/pensiun/create',[PensiunController::class,'create'])->middleware('checkLevel:Petugas'),
Route::get('/petugas/pensiun/print/{id}',[PensiunController::class,'print'])->middleware('checkLevel:Petugas'),

Route::get('/petugas/pensiun/{id}',[PensiunController::class,'print'])->middleware('checkLevel:Petugas'),
Route::get('/petugas/pensiun/{id}/notif',[PensiunController::class,'notif'])->middleware('checkLevel:Petugas'),

Route::resource('/petugas/pendidikan',PendidikanController::class)->middleware('checkLevel:Petugas'),
Route::put('/petugas/pendidikan/{id}/upload',[PendidikanController::class,'upload'])->name('petugas.upload')->middleware('checkLevel:Petugas'),

Route::get('/petugas/pengajuan-cuti',[PengajuanCutiController::class,'index'])->middleware('checkLevel:Petugas'),
Route::put('/petugas/pengajuan-cuti/{cuti}/approve',[PengajuanCutiController::class,'approve'])->middleware('checkLevel:Petugas'),
Route::put('/petugas/pengajuan-cuti/{cuti}/reject',[PengajuanCutiController::class,'reject'])->middleware('checkLevel:Petugas'),
Route::get('/petugas/pengajuan-cuti/print/{id}',[PengajuanCutiController::class,'print'])->middleware('checkLevel:Petugas'),

Route::put('/petugas/diklat/{id}/upload',[DiklatController::class,'upload'])->name('petugas.upload')->middleware('checkLevel:Petugas'),
Route::put('/petugas/penghargaan/{id}/upload',[PenghargaanController::class,'upload'])->name('petugas.upload')->middleware('checkLevel:Petugas'),

Route::put('/petugas/jabatan/{id}/upload',[JabatanController::class,'upload'])->name('petugas.upload')->middleware('checkLevel:Petugas'),
Route::put('/petugas/gapok/{id}/upload',[GapokController::class,'upload'])->name('petugas.upload')->middleware('checkLevel:Petugas'),
Route::get('/petugas', fn() =>redirect()->route('petugas.dashboard'))->name('petugas')->middleware('checkLevel:Petugas'),
);

//Route Admin (pimpinan)
Route::middleware(['auth'])->prefix('pimpinan')->group(fn()=>
Route::get('/dashboard',[DashboardController::class,'index'])->name('pimpinan.dashboard')->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/data-pegawai',[PegawaiController::class,'index'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/data-pegawai/profil/{id}',[PegawaiController::class,'profil'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/pangkat',[PangkatController::class,'index'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/jabatan',[JabatanController::class,'index'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/diklat',[DiklatController::class,'index'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/penghargaan',[PenghargaanController::class,'index'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/gapok',[GapokController::class,'index'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/duk',[PegawaiController::class,'duk'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/laporancuti',[PengajuanCutiController::class,'laporan'])->name('pimpinan.cetak.cuti')->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/laporankgb',[KGBController::class,'laporan'])->name('pimpinan.cetak.kgb')->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/laporanpensiun',[PensiunController::class,'laporan'])->name('pimpinan.cetak.pensiun')->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/filterscuti', [PengajuanCutiController::class,'filterscuti'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/filterskgb', [KGBController::class,'filterskgb'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan/filterspensiun', [PensiunController::class,'filterspensiun'])->middleware('checkLevel:Pimpinan'),
Route::get('/pimpinan', fn()=>redirect()->route('pimpinan.dashboard'))->middleware('checkLevel:Pimpinan'),
);

// Route Users (pegawai)
Route::middleware(['auth'])->prefix('pegawai')->group(fn()=>

Route::get('/dashboard',[DashboardController::class,'index'])->name('pegawai.dashboard')->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/profile/cetak/{id}',[PegawaiController::class,'cetak'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/pengajuan-cuti',[PengajuanCutiController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/pengajuan-cuti/create',[PengajuanCutiController::class,'create'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/data-pasangan',[DataPasanganController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/data-anak', [DataAnakController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/data-ortu', [DataOrtuController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::post('/pegawai/pengajuan-cuti/store',[PengajuanCutiController::class,'store'])->middleware('checkLevel:Pegawai'),
Route::delete('/pegawai/pengajuan-cuti/{cuti}/cancel',[PengajuanCutiController::class,'cancel'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/pengajuan-cuti/print/{id}',[PengajuanCutiController::class,'print'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/profile',[PegawaiController::class,'show'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai', fn()=>redirect()->route('pegawai.dashboard'))->middleware('checkLevel:Pegawai'),
Route::put('/pegawai/diklat/{id}/upload',[DiklatController::class,'upload'])->name('pegawai.upload')->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/diklat',[DiklatController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/jabatan',[JabatanController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/pangkat',[PangkatController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/gapok',[GapokController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::put('/pegawai/pangkat/{id}/upload',[PangkatController::class,'upload'])->name('pegawai.upload')->middleware('checkLevel:Pegawai'),
Route::put('/pegawai/jabatan/{id}/upload',[DiklatController::class,'upload'])->name('pegawai.upload')->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/penghargaan',[PenghargaanController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::put('/pegawai/pendidikan/{id}/upload',[PendidikanController::class,'upload'])->name('pegawai.upload')->middleware('checkLevel:Pegawai'),
Route::put('/pegawai/gapok/{id}/upload',[GapokController::class,'upload'])->name('pegawai.upload')->middleware('checkLevel:Pegawai'),
Route::put('/pegawai/penghargaan/{id}/upload',[PenghargaanController::class,'upload'])->name('pegawai.upload')->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/kgb',[KGBController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/kgb/print/{id}',[KGBController::class,'print'])->middleware('checkLevel:Pegawai'),
Route::resource('/pegawai/lampiran',LampiranController::class)->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/pensiun',[PensiunController::class,'index'])->middleware('checkLevel:Pegawai'),
Route::get('/pegawai/pensiun/print/{id}',[PensiunController::class,'print'])->middleware('checkLevel:Pegawai'),


);