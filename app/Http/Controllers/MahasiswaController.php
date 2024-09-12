<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Query mahasiswa dengan filter pencarian dan pagination
        $mahasiswa = Mahasiswa::where('nama', 'like', "%{$search}%")
            ->orWhere('nim', 'like', "%{$search}%")
            ->orWhere('fakultas', 'like', "%{$search}%")
            ->orWhere('prodi', 'like', "%{$search}%")
            ->orWhere('kelompok', 'like', "%{$search}%")
            ->paginate(10);

        return view('mahasiswa.index', compact('mahasiswa'));
    }
}
