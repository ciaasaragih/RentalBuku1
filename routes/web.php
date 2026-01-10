<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\PenaltyController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PinjamanPenyewaController;
use Illuminate\Support\Facades\Route;

// 1. SETELAN AWAL
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. RUTE DASHBOARD (Sudah Diperbaiki)
// Menghapus middleware(['dashboard']) yang menyebabkan error
Route::get('/dashboard', [KatalogController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // --- ROUTE PROFILE ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- GRUP RUTE ADMIN (Hanya untuk Role Admin) ---
    Route::middleware(['auth', 'is_admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/dashboard', [AdminController::class, 'dashboard'])
                ->name('dashboard');

            // 1. Rute Persetujuan User
            Route::get('/users-approval', [AdminController::class, 'userList'])
                ->name('users.approval');
            Route::put('/users/{id}/approve', [AdminController::class, 'approveUser'])
                ->name('users.approve');

            // 2. Rute Kelola Buku
            Route::get('/books/create', [BookController::class, 'create'])
                ->name('books.create');
            Route::post('/books/store', [BookController::class, 'store'])
                ->name('books.store');
            Route::get('/books', [BookController::class, 'index'])
                ->name('books.index');

            // 3. Rute Log & Denda
            Route::get('/rental-logs', [AdminController::class, 'rentalLog'])
                ->name('rental-logs');
            Route::get('/fines', [AdminController::class, 'fineList'])
                ->name('fines');

            // 4. Perpanjangan Peminjaman
            Route::post('/rental-logs/{id}/extend', [AdminController::class, 'extend'])
                ->name('rental-logs.extend');
            Route::post('admin/rental-logs/{log}/return', [AdminController::class, 'returnBook'])
                ->name('rental-logs.return');


            // 5. Rute Pengaturan Denda
            Route::get('/penalty-settings', [PenaltyController::class, 'edit'])
                ->name('penalty.edit');
            Route::put('/penalty-settings', [PenaltyController::class, 'update'])
                ->name('penalty.update');
        });

    // --- ROUTE UNTUK USER BIASA (Katalog) ---
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');

    //pinjam
    Route::post('/peminjaman/{book}', [KatalogController::class, 'borrow'])
        ->name('peminjaman.store');
    // peminjaman saya
    Route::get('/peminjaman-saya', [PinjamanPenyewaController::class, 'index'])
        ->name('pinjaman.saya');
});

require __DIR__ . '/auth.php';
