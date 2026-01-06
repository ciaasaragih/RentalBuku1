<?php

namespace App\Http\Controllers;

use App\Models\Book; 
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // Fitur Pencarian
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('author', 'like', '%' . $searchTerm . '%');
            });
        }

        // Ambil data terbaru
        $books = $query->latest()->get(); 
        
        // SESUAIKAN DISINI: Pakai 'dashboard' agar tampil di halaman utama penyewa
        return view('dashboard', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('katalog.show', compact('book'));
    }
}