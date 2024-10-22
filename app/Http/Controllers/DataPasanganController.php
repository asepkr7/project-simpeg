<?php

namespace App\Http\Controllers;

use App\Models\Pasangan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class DataPasanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
    {
        $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $pasangan = Pasangan::with('pegawai')
        ->where('pegawai_id', auth()->user()->pegawai->id)->
        orderBy('nama')->
        filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $pasangan = Pasangan::with(['pegawai'])
            ->orderBy('nama')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('pasangan.index',[
            'title' => 'Pasangan',
            'pasangan' => $pasangan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasangan.create',[
            'title' => 'Data Pasangan',
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
            'nama' => 'required|regex:/^[A-Za-z\'\s]+$/',
            'nik' => 'required|numeric|unique:pasangan',
            'gender' => 'required|in:l,p',
            'tempat_lahir' =>'required|alpha',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'pendidikan' => 'required',
            'pekerjaan'=> 'required',
            'status_pasangan' => 'nullable'
        ];
        $validatedData = $request->validate($rules);

        Pasangan::create($validatedData);
        return redirect('/petugas/data-pasangan')->with('success', 'Data Pasangan Berhasil ditambahkan');
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
    public function edit(Pasangan $data_pasangan)
    {
      return  view('pasangan.edit',[
            'title' => 'Data Pasangan',
            'data_pasangan' => $data_pasangan,
            'pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasangan $data_pasangan)
    {
        $rules = [
            'pegawai_id' => 'required',
            'nama' => ['required', 'regex:/^[A-Za-z\'\s]+$/'],
            'tempat_lahir' =>'required|alpha',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:l,p',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_pasangan' => 'nullable'
        ];
        if ($request->nik != $data_pasangan->nik) {
        $rules['nik'] = [
            'required',
            'numeric',
            Rule::unique('pasangan')->ignore($data_pasangan->id),
        ];
    }

        $validatedData = $request->validate($rules);

        Pasangan::where('id', $data_pasangan->id)->update($validatedData);
        return redirect('/petugas/data-pasangan')->with('edit', 'Data Pasangan Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasangan $data_pasangan)
    {
        Pasangan::destroy($data_pasangan->id);
        return redirect('/petugas/data-pasangan')->with('delete', 'Data Pasangan Berhasil dihapus');
    }
}