<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book; 
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        // Mengambil data kategori untuk checkbox di form
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'categories' => 'required|array',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Proses Upload Gambar
        $imageName = null;
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            
            // Simpan ke folder public/storage/books
            $file->move(public_path('storage/books'), $imageName);
        }

        // 3. Simpan data ke tabel books
        $book = Book::create([
            'title' => $request->title,
            'image' => $imageName,
        ]);

        // 4. Simpan relasi kategori
        $book->categories()->sync($request->categories);

        return redirect()->back()->with('success', 'Buku berhasil disimpan!');
    }
}