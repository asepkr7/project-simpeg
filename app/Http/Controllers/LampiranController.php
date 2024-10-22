<?php

namespace App\Http\Controllers;

use App\Models\Lampiran;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class LampiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $lampiran = Lampiran::with('pegawai')
        ->where('pegawai_id', auth()->user()->pegawai->id)->
        orderBy('nama')->
        filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $lampiran = Lampiran::with(['pegawai'])
            ->orderBy('nama')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('lampiran.index',[
            'title' => 'Lampiran',
            'lampiran' => $lampiran
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('lampiran.create',[
            'title' => 'Lampiran',
            'pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate( [
            'pegawai_id' => 'required',
            'nama' => 'string|required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
            'keterangan' => 'required',
        ]);

        $validatedData['pegawai_id'] = $user->pegawai->id;

         if ($request->file('file')) {
            $validatedData['file'] = $request->file('file')->store('lampiran');

        Lampiran::create($validatedData);
         return redirect('/pegawai/lampiran')->with('success', 'Data Lampiran Berhasil ditambahkan');
    }
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
    public function edit(Lampiran $lampiran)
    {
         return view('lampiran.edit',[
            'title'=> 'Lampiran',
             'pegawai' => Pegawai::all(),
             'lampiran' => $lampiran
         ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lampiran $lampiran)
    {
         $user = Auth::user();
        $validatedData = $request->validate( [
            'pegawai_id' => 'required',
            'nama' => 'string|required',
            'file' => 'mimes:pdf,doc,docx|max:2048',
            'keterangan' => 'required',
        ]);

        $validatedData['pegawai_id'] = $user->pegawai->id;

         if ($request->file('file')) {
        // If a new file is provided, delete the old file and store the new one
        if ($request->oldFile) {
            Storage::delete($request->oldFile);
        }
        $validatedData['file'] = $request->file('file')->store('lampiran');
    } else {
        // If no new file is provided, keep the existing file
        $validatedData['file'] = $lampiran->file;
    }
        Lampiran::where('id', $lampiran->id)->update($validatedData);
        return redirect('/pegawai/lampiran')->with('edit', 'Data Lampiran Berhasil diedit');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lampiran $lampiran)
    {
       if ($lampiran->file) {
        // Hapus file sebelumnya dari storage
        Storage::delete($lampiran->file);
    }
        Lampiran::destroy($lampiran->id);

    return redirect('/pegawai/lampiran')->with('delete', 'Data Lampiran Berhasil dihapus');
    }
}