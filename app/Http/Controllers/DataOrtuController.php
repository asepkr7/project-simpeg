<?php

namespace App\Http\Controllers;

use App\Models\Ortu;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class DataOrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $ortu = Ortu::with('pegawai')
        ->where('pegawai_id', auth()->user()->pegawai->id)->
        orderBy('nama')->
        filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $ortu = Ortu::with(['pegawai'])
            ->orderBy('nama')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('ortu.index',[
            'title' => 'Ortu',
            'ortu' => $ortu
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ortu.create',[
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
            'status_ortu' => 'nullable'
        ];
        $validatedData = $request->validate($rules);

        Ortu::create($validatedData);
        return redirect('/petugas/data-ortu')->with('success', 'Data OrangTua Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ortu $data_ortu)
    {
      return  view('ortu.edit',[
            'title' => 'Orang Tua',
            'data_ortu' => $data_ortu,
            'pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ortu $data_ortu)
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
            'status_ortu' => 'nullable'
        ];
        if ($request->nik != $data_ortu->nik) {
        $rules['nik'] = [
            'required',
            'numeric',
            Rule::unique('ortu')->ignore($data_ortu->id),
        ];
    }

        $validatedData = $request->validate($rules);

        Ortu::where('id', $data_ortu->id)->update($validatedData);
        return redirect('/petugas/data-ortu')->with('edit', 'Data Orang tua Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ortu $data_ortu)
    {
        Ortu::destroy($data_ortu->id);
        return redirect('/petugas/data-ortu')->with('delete', 'Data Orang tua Berhasil dihapus');
    }
}