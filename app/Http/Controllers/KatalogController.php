<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\RentLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil data terbaru
        $books = $query->latest()->get();

        // SESUAIKAN DISINI: Pakai 'dashboard' agar tampil di halaman utama penyewa
        return view('dashboard', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        // PASTIKAN FOLDER ADA
        Storage::makeDirectory('public/books');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('public/books', $filename);
            $data['image'] = $filename;
        }

        Book::create($data);

        return redirect()->route('dashboard')->with('success', 'Buku berhasil ditambahkan');
    }
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('katalog.show', compact('book'));
    }

    public function borrow(Request $request, Book $book)
    {
        // 1. Cek stok
        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku habis.');
        }

        // 2. Simpan log peminjaman (RentLog)
        $rentLog = RentLog::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'rent_date' => now(),
            'return_date' => Carbon::now()->addDays(7),
        ]);

        // 3. Kurangi stok buku
        $book->decrement('stock');

        // 4. Tambahkan record ke tabel peminjamans
        Peminjaman::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali_seharusnya' => Carbon::now()->addDays(7),
            'status' => 'dipinjam',
        ]);

        return back()->with('success', 'Peminjaman berhasil diajukan.');
    }
}
