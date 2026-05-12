<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRegisterController extends Controller
{
    /**
     * Tampilkan form registrasi user.
     */
    public function showRegisterForm()
    {
        return view('user.auth.register');
    }

    /**
     * Proses registrasi user.
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'no_hp'    => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'no_hp'    => $request->input('no_hp'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Login otomatis setelah registrasi (opsional)
        Auth::login($user);

        // Redirect ke dashboard user atau halaman lain
        return redirect()->route('user.dashboard')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name);
    }
}
