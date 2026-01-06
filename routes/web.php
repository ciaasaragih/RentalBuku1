<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\PenaltyController;
use App\Http\Controllers\KatalogController;
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
    Route::middleware(['is_admin'])->group(function () {
        
        // 1. Rute Persetujuan User
        Route::get('/admin/users-approval', [AdminController::class, 'userList'])->name('admin.users.approval');
        Route::put('/admin/users/{id}/approve', [AdminController::class, 'approveUser'])->name('admin.users.approve');

        // 2. Rute Kelola Buku
        Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/admin/books/store', [BookController::class, 'store'])->name('admin.books.store');

        // 3. Rute Log & Denda
        Route::get('/admin/rental-logs', [AdminController::class, 'rentalLog'])->name('admin.rental-logs');
        Route::get('/admin/fines', [AdminController::class, 'fineList'])->name('admin.fines');
        
        // 4. Perpanjangan Peminjaman
        Route::post('/admin/rental-logs/{id}/extend', [AdminController::class, 'extend'])->name('admin.rental-logs.extend');

        // 5. Rute Pengaturan Denda
        Route::get('/admin/penalty-settings', [PenaltyController::class, 'edit'])->name('penalty.edit');
        Route::put('/admin/penalty-settings', [PenaltyController::class, 'update'])->name('penalty.update');
    });

    // --- ROUTE UNTUK USER BIASA (Katalog) ---
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::get('/katalog/{id}', [KatalogController::class, 'show'])->name('katalog.show');
});

require __DIR__.'/auth.php';