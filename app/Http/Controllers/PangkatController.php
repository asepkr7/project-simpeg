<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $pangkat = Pangkat::with('pegawai')->where('pegawai_id', auth()->user()->pegawai->id)->orderBy('pangkat')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $pangkat = Pangkat::with(['pegawai'])->orderBy('pangkat')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }
        return view('pangkat.index',[
            'title' => 'Pangkat',
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pangkat.create',[
            'title' => 'Pangkat',
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
        'pangkat' => 'required|string',
        'golongan' => 'required',
        'jenis_pangkat' => 'required',
        'tmt_pangkat' => 'required',
        'no_sk' => 'required',
        'tanggal_sk' => 'required',
        'pejabat_sk' => 'required'
    ]);

    $pangkat = new Pangkat;
    $pangkat->pegawai_id = $validateData['pegawai_id'];
    $pangkat->pangkat = $validateData['pangkat'];
    $pangkat->golongan = $validateData['golongan'];
    $pangkat->jenis_pangkat = $validateData['jenis_pangkat'];
    $pangkat->tmt_pangkat = $validateData['tmt_pangkat'];
    $pangkat->no_sk = $validateData['no_sk'];
    $pangkat->tanggal_sk = $validateData['tanggal_sk'];
    $pangkat->pejabat_sk = $validateData['pejabat_sk'];

    // Pemeriksaan apakah sudah ada pangkat sebelumnya
   // Menonaktifkan pangkat sebelumnya jika ada
    Pangkat::where('pegawai_id', $pangkat->pegawai_id)->update(['status' => false]);

    // Menentukan status aktif untuk pangkat baru
    $pangkat->status = true;
    $pangkat->save();

    return redirect('/petugas/pangkat')->with('success', 'Kenaikan Pangkat Berhasil diajukan');
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
    public function edit(Pangkat $pangkat)
    {
        return view('pangkat.edit',[
            'title' => 'Pangkat',
            'pegawai' => Pegawai::all(),
            'pangkat' => $pangkat
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $pangkat)
    {
        $validateData = $request->validate([
        'pegawai_id' => 'required',
        'pangkat' => 'required|string',
        'golongan' => 'required',
        'jenis_pangkat' => 'required',
        'tmt_pangkat' => 'required',
        'no_sk' => 'required',
        'tanggal_sk' => 'required',
        'pejabat_sk' => 'required'
    ]);

    $pangkat = Pangkat::findOrFail($pangkat);
    $pangkat->fill($validateData);
    $pangkat->save();

    return redirect('/petugas/pangkat')->with('edit', 'Kenaikan Pangkat berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pangkat $pangkat)
    {
         if ($pangkat->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($pangkat->file);
    }
        Pangkat::destroy($pangkat->id);

        return redirect('/petugas/pangkat')->with('delete', 'Riwayat Kenaikan Pangkat berhasil diHapus');
    }

    public function upload(Request $request, Pangkat $id)
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

        return redirect($level.'pangkat')->with('success','Berkas berhasil diunggah');
        // return response()->json(['message' => 'Berkas berhasil diunggah']);
    }
}