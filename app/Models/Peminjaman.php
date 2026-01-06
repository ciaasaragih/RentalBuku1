<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\User;

class Peminjaman extends Model
{
    use HasFactory;

    // Menentukan nama tabel (jika berbeda dengan nama model)
    protected $table = 'peminjamans';

    // Kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_pinjam',
        'tanggal_kembali_seharusnya',
        'tanggal_dikembalikan',
        'denda',
        'status',
    ];

    /**
     * Relasi ke Model Buku
     * Satu data peminjaman memiliki/milik satu buku
     */
    public function buku()
    {
        // Sesuaikan 'Buku' dengan nama model buku kamu yang sebenarnya
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Relasi ke Model User
     * Satu data peminjaman milik satu user/penyewa
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}