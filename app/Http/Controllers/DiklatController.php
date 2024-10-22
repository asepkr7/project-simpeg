<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DiklatController extends Controller
{

    public function index(Request $request)
    {
         $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
         if (Auth::user()->level == 'Pegawai') {
            $diklat = Diklat::with('pegawai')->where('pegawai_id', auth()->user()->pegawai->id)->orderBy('diklat')->filter(request(['search']))
               ->paginate($showEntries)->withQueryString();
         }else{
            $diklat = Diklat::with('pegawai')->orderBy('diklat')->filter(request(['search']))
               ->paginate($showEntries)->withQueryString();
         }
        return view('diklat.index',[
            'title' => 'Diklat',
            'diklat' => $diklat
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('diklat.create',[
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
            'diklat' => 'string|required',
            'jumlah_jam' => 'required',
            'penyelenggara' => 'required',
            'tempat' => 'required',
            'tahun' => 'required',
            'angkatan' => 'required',
            'no_sttpp' => 'required',
            'tanggal_sttpp' => 'date|required'
        ];

        $validatedData = $request->validate($rules);
        Diklat::create($validatedData);

         return redirect('/petugas/diklat')->with('success', 'Data Riwayat Diklat Berhasil ditambahkan');
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
    public function edit(Diklat $diklat)
    {

        return view('diklat.edit',[
            'title' => 'Diklat',
            'pegawai' => Pegawai::all(),
            'diklat' => $diklat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diklat $diklat)
    {
         $rules = [
            'pegawai_id' => 'required',
            'diklat' => 'string|required',
            'jumlah_jam' => 'required',
            'penyelenggara' => 'required',
            'tempat' => 'required',
            'tahun' => 'required',
            'angkatan' => 'required',
            'no_sttpp' => 'required',
            'tanggal_sttpp' => 'date|required',
        ];

        $validatedData = $request->validate($rules);
        Diklat::where('id', $diklat->id)->update($validatedData);

         return redirect('/petugas/diklat')->with('edit', 'Data Riwayat Diklat Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diklat $diklat)
    {
         if ($diklat->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($diklat->file);
    }
        Diklat::destroy($diklat->id);
        return redirect('/petugas/diklat')->with('delete', 'Data Riwayat Diklat Berhasil dihapus');
    }

    public function upload(Request $request, Diklat $id)
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

        return redirect($level.'diklat')->with('success','Berkas berhasil diunggah');
        // return response()->json(['message' => 'Berkas berhasil diunggah']);
    }

    }