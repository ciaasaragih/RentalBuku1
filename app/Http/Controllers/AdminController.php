<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\RentLog;
use App\Models\PenaltySetting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        // Ringkasan
        $totalBuku = Book::count();

        $dipinjam = RentLog::whereNull('actual_return_date')
            ->count();

        $memberAktif = User::where('role', 'penyewa')
            ->where('is_approved', true)
            ->count();

        // Buku terbaru
        $books = Book::latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'books',
            'totalBuku',
            'dipinjam',
            'memberAktif'
        ));
    }

    /**
     * Daftar user menunggu persetujuan
     */
    public function userList()
    {
        $users = User::where('role', 'penyewa')
            ->where('is_approved', false)
            ->get();

        return view('admin.users-approval', compact('users'));
    }

    /**
     * Setujui user
     */
    public function approveUser($id): RedirectResponse
    {
        User::findOrFail($id)->update([
            'is_approved' => true
        ]);

        return back()->with('success', 'User berhasil disetujui.');
    }

    /**
     * Log peminjaman
     */
    public function rentalLog()
    {
        $logs = RentLog::with(['user', 'book'])
            ->latest()
            ->get();

        $penaltyDetail = PenaltySetting::first();

        return view('admin.rental-logs', compact('logs', 'penaltyDetail'));
    }

    /**
     * Perpanjang peminjaman
     */
    public function extend($id)
    {
        $log = RentLog::findOrFail($id);

        $log->update([
            'return_date' => Carbon::parse($log->return_date)->addDays(7)
        ]);

        return back()->with('success', 'Peminjaman berhasil diperpanjang.');
    }

    /**
     * Daftar denda
     */
    public function fineList()
    {
        // $fines = RentLog::with(['user', 'bookItem.book'])
        //     ->whereNull('actual_return_date')
        //     ->where('return_date', '<', now())
        //     ->get();

        // return view('admin.fines', compact('fines'));

        return abort(404, 'View fines belum tersedia');
    }

    public function returnBook($id)
    {
        $log = RentLog::findOrFail($id);

        if ($log->actual_return_date) {
            return back()->with('error', 'Buku sudah dikembalikan.');
        }

        DB::transaction(function () use ($log) {
            // 1. Update actual_return_date & status
            $log->update([
                'actual_return_date' => now(),
                'status' => 'dikembalikan', // jika ada kolom status
            ]);

            // 2. Tambah stok buku
            $log->book->increment('stock');
        });

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
