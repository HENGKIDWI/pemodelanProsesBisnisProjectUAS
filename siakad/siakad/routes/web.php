<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentSubmissionController;
use Illuminate\Support\Facades\Mail;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // UBAH ROUTE DASHBOARD MENJADI SEPERTI INI:
    Route::get('/dashboard', [StudentSubmissionController::class, 'index'])->name('dashboard');

    // Route pendukung lainnya (jangan dihapus)
    Route::get('/template/{documentTemplate}/download', [StudentSubmissionController::class, 'downloadTemplate'])->name('template.download');
    Route::post('/submission', [StudentSubmissionController::class, 'store'])->name('submission.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/debug-email', function () {
    try {
        // Kirim email sederhana tanpa view
        Mail::raw('Ini adalah email tes. Jika Anda membaca ini, berarti konfigurasi SMTP sudah BENAR.', function ($message) {
            $message->to('hengkikur21@gmail.com') // Ganti dengan email tujuan Anda
                    ->subject('Tes Koneksi SMTP Laravel');
        });
        
        return 'BERHASIL! Email terkirim. Cek Inbox atau Spam.';
    } catch (\Exception $e) {
        // Tampilkan error lengkap ke layar
        return 'GAGAL! Error: ' . $e->getMessage();
    }
});

require __DIR__.'/auth.php';
