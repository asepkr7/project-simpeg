<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class DataAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        if (Auth::user()->level == 'Pegawai') {
        $anak = Anak::with('pegawai')
        ->where('pegawai_id', auth()->user()->pegawai->id)->
        orderBy('nama')->
        filter(request(['search']))
            ->paginate($showEntries)->withQueryString();
        }else{
            $anak = Anak::with(['pegawai'])
            ->orderBy('nama')
            ->filter(request(['search']))
            ->paginate($showEntries)
            ->withQueryString();
        }
        return view('anak.index',[
            'title' => 'Anak',
            'anak' => $anak
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('anak.create',[
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
            'nik' => 'required|numeric|unique:anak',
            'gender' => 'required|in:l,p',
            'tempat_lahir' =>'required|alpha',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_anak' => 'nullable',
        ];
        $validatedData = $request->validate($rules);

        Anak::create($validatedData);
        return redirect('/petugas/data-anak')->with('success', 'Data Anak Berhasil ditambahkan');
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
    public function edit(Anak $data_anak)
    {
        return view('anak.edit',[
            'data_anak' => $data_anak,
            'pegawai' => Pegawai::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anak $data_anak)
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
            'status_anak' => 'nullable'
        ];
        if ($request->nik != $data_anak->nik) {
        $rules['nik'] = [
            'required',
            'numeric',
            Rule::unique('anak')->ignore($data_anak->id),
        ];
    }

        $validatedData = $request->validate($rules);

        Anak::where('id', $data_anak->id)->update($validatedData);
        return redirect('/petugas/data-anak')->with('edit', 'Data Anak Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $data_anak)
    {
        Anak::destroy($data_anak->id);
        return redirect('/petugas/data-anak')->with('delete', 'Data Anak Berhasil dihapus');
    }
}