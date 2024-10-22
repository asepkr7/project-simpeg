<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PegawaiController extends Controller
{
   public function index(Request $request)
    {
        // $user = User::with('pegawai')->find('pegawai_id');
        $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        return view('pegawai.index',[
            'title' => 'Pegawai',
            // 'user' => $user,
            'pegawai' => Pegawai::with(['user','anak'])->orderBy('nama')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'regex:/^[A-Za-z\'\s]+$/'],
            'nip' => 'required|numeric|unique:pegawai,nip',
            'gelar_depan' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'gelar_belakang' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'tempat_lahir' => 'required|alpha',
            'tanggal_lahir' =>'required|date',
            'gender' => 'required|in:l,p',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'gol_darah' => 'required|string',
            'status_pernikahan' => 'required',
            'nik' => 'required|numeric|unique:pegawai,nik',
            'telp' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{11}$/',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'npwp' => 'nullable|string',
            'bpjs' => 'nullable|string',
            'karpeg' =>'nullable',
            'status_kepegawaian' => 'required|in:PNS,PPPK,TKK,Honorer,CPNS,Magang',
            'no_sk_cpns' => 'nullable',
            'tmt_sk_cpns' => 'nullable',
            'no_sk_pns' =>'nullable',
            'tmt_sk_pns' => 'nullable',
            'masuk_kerja'   => 'date|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
         if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('images');
        }
        Pegawai::create($validatedData);
        return redirect('/petugas/data-pegawai')->with('success', 'Data Pegawai Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pegawai $data_pegawai)
    {
        $pegawai = Pegawai::with(['pangkat', 'jabatan', 'diklat', 'pendidikan','anak','pasangan','ortu'])->find($data_pegawai);
        return view('profile.index', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(Pegawai $data_pegawai)
    {
        $encodedNip = urlencode($data_pegawai->nip);

        return view('pegawai.edit', [
            'data_pegawai' => $data_pegawai,
            'encoded_nip' => $encodedNip,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pegawai $data_pegawai)
    {
         $validatedData = $request->validate([
            'nama' => ['required', 'regex:/^[A-Za-z\'\s]+$/'],
            'nip' => 'required|numeric',
            'gelar_depan' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'gelar_belakang' => 'nullable|regex:/^[a-zA-Z.,\s]+$/',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' =>'required|date',
            'gender' => 'required|in:l,p',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'gol_darah' => 'required|string',
            'status_pernikahan' => 'nullable|required',
            'nik' => 'required|numeric',
            'telp' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{11}$/',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'npwp' => 'nullable|string',
            'bpjs' => 'nullable|string',
            'karpeg' =>'nullable',
            'status_kepegawaian' => 'required',
            'no_sk_cpns' => 'nullable',
            'tmt_sk_cpns' => 'nullable',
            'no_sk_pns' =>'nullable',
            'tmt_sk_pns' => 'nullable',
            'masuk_kerja'   => 'date|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
         if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }
        Pegawai::where('id',$data_pegawai->id)
        ->update($validatedData);

        return redirect('/petugas/data-pegawai')->with('edit', 'Data Pegawai Berhasil diupdate');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pegawai $data_pegawai)
    {
        if ($data_pegawai->image) {
                Storage::delete($data_pegawai->image);
            }
            Pegawai::destroy($data_pegawai->id);
            return redirect('/petugas/data-pegawai')->with('delete', 'Data Pegawai Berhasil dihapus');
    }

    public function duk()
    {
        $duk = Pegawai::with(['pangkat', 'jabatan', 'diklat', 'pendidikan'])->get();

        $pdf = Pdf::loadView('pegawai.duk',['duk' => $duk]);
        $pdf->setPaper('legal', 'landscape');

        return $pdf->stream('Laporan DUK');
    }
    public function cetak($id)
    {
        $profil = Pegawai::with(['pangkat', 'jabatan', 'diklat', 'pendidikan', 'pasangan', 'anak'])->findOrFail($id);

         $nama = $profil->nama;
        $pdf = Pdf::loadView('profile.cetak',['profil' => $profil, 'nama'=> $nama]);
        $pdf->setPaper('legal', 'potrait');

        return $pdf->stream("Profil $nama.pdf");
    }

    public function profil($id)
    {
         $pegawai = Pegawai::with(['pangkat', 'jabatan', 'diklat', 'pendidikan','anak','pasangan','ortu'])->findOrFail($id);
        return view('profile.index', compact('pegawai'));
    }
}