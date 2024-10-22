<?php

namespace App\Http\Controllers;

use App\Models\Gapok;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GapokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $gapok = Gapok::with('pegawai')
        ->where('pegawai_id', auth()->user()->pegawai->id)->
        orderBy('jumlah_gapok')->
        filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $gapok = Gapok::with(['pegawai'])
            ->orderBy('jumlah_gapok')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('gapok.index',[
            'title' => 'Gapok',
            'gapok' => $gapok
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gapok.create',[
            'title' => 'Gapok',
            'pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData =$request->validate([
            'pegawai_id' => 'required',
            'jumlah_gapok' => 'required|integer',
            'no_sk' => 'required',
            'tanggal_sk' => 'required',
             'pejabat_sk' => 'required',
             'tmt' => 'required|date'
        ]);

        Gapok::create($validatedData);
        return redirect('/petugas/gapok')->with('success','Data Gapok Berhasil ditambahkan');
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
    public function edit(Gapok $gapok)
    {
          return view('gapok.edit',[
            'title' => 'Gapok',
            'gapok' => $gapok,
            'pegawai' => Pegawai::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gapok $gapok)
    {
         $validatedData =$request->validate([
            'pegawai_id' => 'required',
            'jumlah_gapok' => 'required|integer',
            'no_sk' => 'required',
            'tanggal_sk' => 'required',
             'pejabat_sk' => 'required',
             'tmt' => 'required|date'
        ]);

        Gapok::where('id', $gapok->id)->update($validatedData);
        return redirect('/petugas/gapok')->with('edit', 'Data Gaji Pokok Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gapok $gapok)
    {
        if ($gapok->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($gapok->file);
    }
        Gapok::destroy($gapok->id);
        return redirect('/petugas/gapok')->with('delete', 'Data Riwayat Gaji Pokok Berhasil dihapus');
    }

     public function upload(Request $request, Gapok $id)
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
        return redirect($level.'gapok')->with('success','Berkas berhasil diunggah');
        // return response()->json(['message' => 'Berkas berhasil diunggah']);
    }
}
