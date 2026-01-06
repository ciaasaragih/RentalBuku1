<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use App\Models\RentLog;
use App\Models\PenaltySetting;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar user yang menunggu persetujuan
     */
    public function userList()
    {
        $users = User::where('role', 'penyewa')
            ->where('is_approved', false)
            ->get();

        return view('admin.books.users-approval', compact('users'));
    }

    /**
     * Menyetujui user
     */
    public function approveUser($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->update(['is_approved' => true]);

        return back()->with('success', 'User berhasil disetujui.');
    }

    /**
     * Menampilkan form tambah buku
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'categories' => 'required|array',
        ]);

        $book = Book::create([
            'title' => $request->title,
        ]);

        $book->categories()->sync($request->categories);

        return redirect()
            ->route('admin.books.create')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Menampilkan log peminjaman
     */
    public function rentalLog()
    {
        $logs = RentLog::with(['user', 'bookItem.book'])
            ->latest()
            ->get();

        $penaltyDetail = PenaltySetting::first();

        return view('admin.rental-logs', compact('logs', 'penaltyDetail'));
    }

    /**
     * Perpanjang peminjaman buku
     */
    public function extend($id)
    {
        $log = RentLog::findOrFail($id);

        // Perpanjang 7 hari
        $log->return_date = Carbon::parse($log->return_date)->addDays(7);
        $log->save();

        return back()->with('success', 'Peminjaman berhasil diperpanjang.');
    }

    /**
     * Daftar denda
     */
    public function fineList()
    {
        $fines = RentLog::with(['user', 'bookItem.book'])
            ->whereNull('actual_return_date')
            ->where('return_date', '<', now())
            ->get();

        return view('admin.fines', compact('fines'));
    }
}
