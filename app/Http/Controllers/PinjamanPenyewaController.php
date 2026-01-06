<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanPenyewaController extends Controller
{
    public function index()
    {
        // 1. Ambil ID user yang sedang login
        $userId = Auth::id();

        // 2. Ambil data pinjaman milik user tersebut
        // Kita gunakan 'with' agar data buku otomatis terbawa
        $pinjamanSaya = Peminjaman::with('buku')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        // 3. Kirim data ke file view (nanti kita buat file view-nya)
        return view('penyewa.pinjaman.index', compact('pinjamanSaya'));
    }
}