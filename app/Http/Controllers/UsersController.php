<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $showEntries = $request->input('show_entries',Session::get('show_entries', 10));
        return view('users.index',[
            'title' => 'Users',
            'users' => User::with('pegawai')->orderBy('username')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('users.create',[
        'users' => Pegawai::all()
       ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pegawai_id' => 'required|unique:users',
            'username' => 'required|unique:users|min:4',
            'level' => 'required',
            'password' => 'required|min:6|confirmed',[
                'password.confirmed' => 'Password dan konfirmasi password tidak cocok'
            ]
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

           User::create($validatedData);
           return redirect('/petugas/users')->with('success', 'Data User Berhasil ditambahkan');
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
    public function edit(User $user)
    {
      return  view('users.edit',[
            'user' => $user,
        'pegawai' => Pegawai::all()
       ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
       $rules=[
            'level' => 'required',
            'password' => 'nullable|min:6|confirmed',
        ];
        if ($request->pegawai_id != $user->pegawai_id) {
            $rules['pegawai_id'] = 'required|unique:users';
        }
        if ($request->username != $user->username) {
            $rules['username'] = 'required|unique:users|min:4';
        }
        $validatedData = $request->validate($rules, [
            'password.confirmed' => 'Password dan konfirmasi password tidak cocok'
            ]);

        if (!empty($validatedData['password'])) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }


        User::where('id',$user->id)->update( $validatedData);
         return redirect('/petugas/users')->with('edit', 'Data User Berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/petugas/users')->with('delete', 'Data User Berhasil dihapus');
    }
}
