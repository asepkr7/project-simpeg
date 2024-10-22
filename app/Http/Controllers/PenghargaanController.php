<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Penghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $penghargaan = Penghargaan::with('pegawai')->where('pegawai_id', auth()->user()->pegawai->id)->orderBy('penghargaan')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $penghargaan = Penghargaan::with(['pegawai'])->orderBy('penghargaan')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }
        return view('penghargaan.index',[
            'title' => 'Penghargaan',
            'penghargaan' => $penghargaan
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penghargaan.create',[
            'title' => 'Penghargaan',
            'pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $rules = [
            'pegawai_id' => 'required',
            'penghargaan' => 'string|required',
            'tingkat_kegiatan' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required|date',
            'tahun_penghargaan' => 'required|integer',
            'no_sertifikat' => 'required',

        ];

        $validatedData = $request->validate($rules);
        Penghargaan::create($validatedData);

         return redirect('/petugas/penghargaan')->with('success', 'Data Riwayat Penghargaan Berhasil ditambahkan');
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
    public function edit(Penghargaan $penghargaan)
    {
         return view('penghargaan.edit',[
            'title' => 'Penghargaan',
            'pegawai' => Pegawai::all(),
            'penghargaan' => $penghargaan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penghargaan $penghargaan)
    {
        $validateData = $request->validate([
            'pegawai_id' => 'required',
            'penghargaan' => 'string|required',
            'tingkat_kegiatan' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required|date',
            'tahun_penghargaan' => 'required|integer',
            'no_sertifikat' => 'required',
        ]);

        Penghargaan::where('id', $penghargaan->id)->update($validateData);

     return redirect('/petugas/penghargaan')->with('edit', 'Data Riwayat Penghargaan Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penghargaan $penghargaan)
    {
         if ($penghargaan->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($penghargaan->file);
    }
        Penghargaan::destroy($penghargaan->id);

    return redirect('/petugas/penghargaan')->with('delete', 'Data Riwayat Penghargaan Berhasil dihapus');
    }

     public function upload(Request $request, Penghargaan $id)
    {
        // Validasi file yang diunggah
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx', // Contoh: Menerima file dengan ekstensi pdf, doc, docx, maksimal 2 MB
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
        return redirect($level.'penghargaan')->with('success','Berkas berhasil diunggah');
        // return
}
}