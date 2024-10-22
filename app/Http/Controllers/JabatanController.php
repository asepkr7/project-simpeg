<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $jabatan = Jabatan::with('pegawai')->where('pegawai_id', auth()->user()->pegawai->id)->orderBy('jabatan')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $jabatan = Jabatan::with(['pegawai'])->orderBy('jabatan')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }
        return view('jabatan.index',[
            'title' => 'Jabatan',
            'jabatan' => $jabatan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create',[
            'title' => 'Jabatan',
            'pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
        'pegawai_id' => 'required',
        'jabatan' => 'required|string',
        'eselon' => 'required',
        'jenis_jabatan' => 'required',
        'tmt_jabatan' => 'required',
        'no_sk' => 'required',
        'tanggal_sk' => 'required',
        'pejabat_sk' => 'required'
    ]);

    $jabatan = new Jabatan;
    $jabatan->pegawai_id = $validateData['pegawai_id'];
    $jabatan->jabatan = $validateData['jabatan'];
    $jabatan->eselon = $validateData['eselon'];
    $jabatan->jenis_jabatan = $validateData['jenis_jabatan'];
    $jabatan->tmt_jabatan = $validateData['tmt_jabatan'];
    $jabatan->no_sk = $validateData['no_sk'];
    $jabatan->tanggal_sk = $validateData['tanggal_sk'];
    $jabatan->pejabat_sk  = $validateData['pejabat_sk'];

    // Pemeriksaan apakah sudah ada jabatan sebelumnya
   // Menonaktifkan jabatan sebelumnya jika ada
    Jabatan::where('pegawai_id', $jabatan->pegawai_id)->update(['status' => false]);

    // Menentukan status aktif untuk jabatan baru
    $jabatan->status = true;
    $jabatan->save();

    return redirect('/petugas/jabatan')->with('success', 'Riwayat Jabatan Berhasil ditambahkan');
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
    public function edit(Jabatan $jabatan)
    {

        return view('jabatan.edit',[
            'title' => 'Jabatan',
            'pegawai' => Pegawai::all(),
            'jabatan' => $jabatan,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $jabatan)
    {
         $validateData = $request->validate([
        'pegawai_id' => 'required',
        'jabatan' => 'required|string',
        'eselon' => 'required',
        'jenis_jabatan' => 'required',
        'tmt_jabatan' => 'required',
        'no_sk' => 'required',
        'tanggal_sk' => 'required',
        'pejabat_sk' => 'required',
    ]);

    $jabatan = Jabatan::findOrFail($jabatan);
    $jabatan->fill($validateData);
    $jabatan->save();

     return redirect('/petugas/jabatan')->with('edit', 'Riwayat Jabatan Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(Jabatan $jabatan)
    {
        if ($jabatan->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($jabatan->file);
    }
        Jabatan::destroy($jabatan->id);
        return redirect('/petugas/jabatan')->with('delete', ' Riwayat Jabatan berhasil dihapus');
    }

     public function upload(Request $request, Jabatan $id)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048', // Contoh: Menerima file dengan ekstensi pdf, doc, docx, maksimal 2 MB
        ]);
      // Cek apakah sudah ada file sebelumnya
    if ($id->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($id->file);
    }

    // Simpan file yang diunggah ke storage atau lokasi yang diinginkan
    $path = $request->file('file')->store('berkas');

        // Update kolom 'file' pada databerkas diklat dengan path file yang baru diunggah
        $id->update(['file' => $path]);

         $level = Auth::user()->level ='Petugas' ? '/petugas/' : '/pegawai/';

        return redirect($level.'jabatan')->with('success','Berkas berhasil diunggah');
        // return response()->json(['message' => 'Berkas berhasil diunggah']);
    }

}
