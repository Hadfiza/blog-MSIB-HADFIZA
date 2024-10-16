<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Menampilkan form pendaftaran
    public function create()
    {
        return view('auth.register'); // Pastikan view ini ada
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Daftar email admin
        $adminEmails = ['admin1@gmail.com', 'admin2@gmail.com']; // Ganti dengan email admin yang valid

        // Cek apakah email yang didaftarkan termasuk dalam daftar admin
        $isAdmin = in_array($request->email, $adminEmails) ? 1 : 0;

        // Menyimpan pengguna baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $isAdmin, // Setel sebagai admin atau user biasa
        ]);

        // Otomatis login setelah pendaftaran
        Auth::login($user);

        return redirect()->route($isAdmin ? 'admin.dashboard' : 'user.dashboard')
            ->with('success', 'Pendaftaran berhasil. Selamat datang!');
    }
}
