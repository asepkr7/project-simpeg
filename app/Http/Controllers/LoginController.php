<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Anhskohbo\NoCaptcha\Facades\NoCaptcha;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index',[
            'title' => 'login',

        ]);
    }

   public function attemptLogin(Request $request)
{
    $cacheDuration = 60; // Durasi cache dalam menit
    $email = $request->input('email');
    $password = $request->input('password');

    // Mengambil data email dari tabel pegawai untuk diperiksa dari form login
    $user = Cache::remember('user_' . $email, $cacheDuration, function () use ($email) {
        return User::whereHas('pegawai', function ($query) use ($email) {
            $query->where('email', $email);
        })->first();
    });

    // Cek login berdasarkan ID user
    if ($user && Hash::check($password, $user->password)) {
        if (Auth::loginUsingId($user->id, request()->filled('remember'))) {
            return true;
        }
    }

    return false;
}
    public function login(Request $request)
    {
         $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

    if ($this->attemptLogin($request)) {
         $request->session()->regenerate();

         if(Auth::user()->level == 'Petugas'){

        return redirect()->intended('/petugas');
         }elseif(Auth::user()->level == 'Pimpinan'){

            return redirect()->intended('/pimpinan');
         } elseif(Auth::user()->level == 'Pegawai'){

            return redirect()->intended('/pegawai');
         }
        }
        return redirect()->route('login')->with('loginError', 'Email atau Password Salah');

    }
// public function attemptLogin(Request $request)
// {
//     $cacheDuration = 60; // Durasi cache dalam menit
//     $email = $request->input('email');
//     $password = $request->input('password');

//     // Verifikasi reCAPTCHA
//     if ($this->isCaptchaEnabled() && !$this->isCaptchaValid($request)) {
//         throw ValidationException::withMessages(['captcha' => 'Captcha validation failed.']);
//     }

//     // Mengambil data email dari tabel yang sesuai untuk diperiksa dari form login
//     $user = Cache::remember('user_' . $email, $cacheDuration, function () use ($email) {
//         return User::whereHas('pegawai', function ($query) use ($email) {
//             $query->where('email', $email);
//         })->first();
//     });

//     // Cek login berdasarkan ID user
//     if ($user && Hash::check($password, $user->password)) {
//         if (Auth::loginUsingId($user->id, $request->filled('remember'))) {
//             return true;
//         }
//     }

//     return false;
// }

// public function login(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     $validator->sometimes('g-recaptcha-response', 'required', function ($input) {
//         return $this->isCaptchaEnabled();
//     });

//     if ($validator->fails()) {
//         throw new ValidationException($validator);
//     }

//     if ($this->attemptLogin($request)) {
//         $request->session()->regenerate();

//         if (Auth::user()->level == 'Petugas') {
//             return redirect()->intended('/petugas');
//         } elseif (Auth::user()->level == 'Pimpinan') {
//             return redirect()->intended('/pimpinan');
//         } elseif (Auth::user()->level == 'Pegawai') {
//             return redirect()->intended('/pegawai');
//         }
//     }

//     return redirect()->route('login')->with('loginError', 'Email atau Password Salah');
// }

private function isCaptchaEnabled()
{
    // Tambahkan logika untuk menentukan apakah captcha diaktifkan
    // Misalnya, dapat berdasarkan pengaturan di database atau pengaturan konfigurasi
    return true;
}

private function isCaptchaValid(Request $request)
{
    return NoCaptcha::verifyResponse($request->input('g-recaptcha-response'));
}
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}