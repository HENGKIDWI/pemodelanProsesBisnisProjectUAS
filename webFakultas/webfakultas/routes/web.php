<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClearanceController; // <--- Pastikan ini ada
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// GROUP ROUTE (WAJIB LOGIN)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- PERBAIKAN DISINI ---
    // Jangan pakai closure function() {}, tapi pakai Controller
    Route::get('/dashboard', [ClearanceController::class, 'index'])->name('dashboard');

    // Route untuk Proses Upload
    Route::post('/clearance', [ClearanceController::class, 'store'])->name('clearance.store');
    
    // Route Download
    Route::get('/clearance/{clearance}/download', [ClearanceController::class, 'download'])->name('clearance.download');

    // Route Profile bawaan Breeze (Biarkan saja)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';