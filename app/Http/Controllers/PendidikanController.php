<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class PendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
          $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $pendidikan = Pendidikan::with('pegawai')->where('pegawai_id', auth()->user()->pegawai->id)->orderBy('pendidikan')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $pendidikan = Pendidikan::with(['pegawai'])
            ->orderBy('pendidikan')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('pendidikan.index',[
            'title' => 'Pendidikan',
            'pendidikan' => $pendidikan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendidikan.create',[
            'title' => 'Pendidikan',
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
        'pendidikan' => 'required',
        'jenjang' => 'required|string',
        'lokasi' => 'required',
        'jurusan' => 'required',
        'no_ijazah' => 'required',
        'tanggal_ijazah' => 'required',
        'nama_pimpinan' => 'required',
    ]);

    $pendidikan = new Pendidikan;
    $pendidikan->pegawai_id = $validateData['pegawai_id'];
    $pendidikan->pendidikan = $validateData['pendidikan'];
    $pendidikan->jenjang = $validateData['jenjang'];
    $pendidikan->lokasi = $validateData['lokasi'];
    $pendidikan->jurusan = $validateData['jurusan'];
    $pendidikan->no_ijazah = $validateData['no_ijazah'];
    $pendidikan->tanggal_ijazah = $validateData['tanggal_ijazah'];
    $pendidikan->nama_pimpinan = $validateData['nama_pimpinan'];
    // Menentukan status nonaktif

    $pendidikan->save();

    return redirect('/petugas/pendidikan')->with('success', 'Data Pendidikan Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pendidikan $pendidikan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendidikan $pendidikan)
    {
        return view('pendidikan.edit',[
            'title' => 'Pendidikan',
            'pegawai' => Pegawai::all(),
            'pendidikan' => $pendidikan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendidikan $pendidikan)
    {
     $validateData = $request->validate([
        'pegawai_id' => 'required',
        'pendidikan' => 'required',
        'jenjang' => 'required|string',
        'lokasi' => 'required',
        'jurusan' => 'required',
        'no_ijazah' => 'required',
        'tanggal_ijazah' => 'required',
        'nama_pimpinan' => 'required',
    ]);

    Pendidikan::where('id', $pendidikan->id)->update($validateData);

     return redirect('/petugas/pendidikan')->with('edit', 'Data Pendidikan Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendidikan $pendidikan)
    {
         if ($pendidikan->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($pendidikan->file);
    }
        Pendidikan::destroy($pendidikan->id);

    return redirect('/petugas/pendidikan')->with('delete', 'Data Pendidikan Berhasil dihapus');
    }

     public function upload(Request $request, Pendidikan $id)
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
        return redirect($level.'pendidikan')->with('success','Berkas berhasil diunggah');
        // return response()->json(['message' => 'Berkas berhasil diunggah']);
    }
}
