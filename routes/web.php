<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaundryItemController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Halaman utama (Katalog Layanan & Transaksi Pelanggan / Kasir)
Route::get('/', [OrderController::class, 'index'])->name('customer.index');

// Dashboard utama (Dapat diakses oleh Admin & Kasir yang sudah login)
Route::get('/dashboard', [OrderController::class, 'adminDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route checkout / input transaksi
    Route::post('/checkout', [OrderController::class, 'store'])->name('customer.checkout');

    // Route profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route update status pengerjaan pesanan (KHUSUS ADMIN)
    Route::patch('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->middleware('admin')
        ->name('admin.orders.updateStatus');
    // Route update status pembayaran (Lunasi / Belum Lunas)
    Route::patch('/admin/orders/{id}/status-bayar', [OrderController::class, 'updateStatusBayar'])->name('admin.orders.updateStatusBayar');

    Route::get('/admin/dashboard', [OrderController::class, 'adminDashboard'])->name('admin.dashboard');

    // Route Hapus Transaksi (Khusus Admin)
    Route::delete('/admin/orders/{id}', [OrderController::class, 'destroy'])
        ->middleware('admin')
        ->name('admin.orders.destroy');

    // Route Khusus Admin (DILINDUNGI BACKEND MIDDLEWARE 'admin')
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::resource('laundry_items', LaundryItemController::class);
    });
});

require __DIR__.'/auth.php';
