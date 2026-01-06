<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('peminjamans', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained(); // ID Penyewa
    $table->foreignId('book_id')->constrained(); // ID Buku (relasi ke tabel buku kamu)
    $table->date('tanggal_pinjam');
    $table->date('tanggal_kembali_seharusnya'); // Deadline
    $table->date('tanggal_dikembalikan')->nullable(); // Diisi saat buku balik
    $table->integer('denda')->default(0);
    $table->string('status'); // 'dipinjam', 'kembali', 'terlambat'
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
