<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Debugging untuk melihat pengguna yang login
        $user = auth()->user();
        logger('User logged in:', [$user]);

        // Cek apakah pengguna adalah admin
        if (!$user || $user->is_admin !== 1) {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        return view('admin.dashboard');
    }
}
