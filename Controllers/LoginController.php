<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginBackend()
    {
        return view('backend.v_login.login', [
            'judul' => 'Login',
        ]);
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', 
        ]);

        return redirect()->route('backend.login')->with('success', 'Registrasi berhasil, silakan login.');
    }


    public function authenticateBackend(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Harap masukkan email.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Harap masukkan password.',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Cek apakah email ditemukan
        if (!$user) {
            return back()->withErrors(['email' => 'Email Salah.'])->withInput();
        }

        // Cek password cocok atau tidak
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password Salah.'])->withInput();
        }

        // Jika email & password cocok, login
        Auth::login($user);

        // Hapus session guest jika ada
        session()->forget('guest'); 

        if ($user->role === 'admin') {
            return redirect()->route('backend.dashboard');
        } else {
            return redirect()->route('backend.home');
        }
    }


    public function logoutBackend()
    {
        Auth::logout();

        request()->session()->forget('guest');

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect(route('backend.login'));
    }


    public function loginAsGuest()
    {
        session(['guest' => true]);
        return redirect()->route('backend.home');
    }

    public function register()
    {
        return view('backend.v_login.register', [
            'judul' => 'Register',
        ]);
    }
    public function showForgotPasswordForm()
    {
        return view('backend.v_login.lupa-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Kirim email reset (dalam contoh ini, hanya redirect ke halaman reset password)
        return redirect()->route('password.reset', ['email' => $user->email]);
    }

    public function showResetForm($email)
    {
        return view('backend.v_login.reset-password', ['email' => $email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('backend.login')->with('success', 'Password berhasil direset. Silakan login.');
    }

}
