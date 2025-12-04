<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MahasiswaController::class, 'index'])->name('dashboard');
    
    // Route baru untuk upload bukti bayar per item tanggungan
    Route::post('/tanggungan/{id}/bayar', [MahasiswaController::class, 'uploadBayar'])->name('tanggungan.bayar');
    
    // Route baru untuk ajukan surat (hanya bisa diakses kalau lunas)
    Route::post('/ajukan-surat', [MahasiswaController::class, 'ajukanSurat'])->name('permohonan.ajukan');

    
    Route::get('/surat/download', [MahasiswaController::class, 'downloadSurat'])->name('surat.download');Route::get('/surat/download', [MahasiswaController::class, 'downloadSurat'])->name('surat.download');
});

require __DIR__.'/auth.php'; // Biarkan baris ini, ini file route login/register dari Breeze

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
