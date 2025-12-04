<?php

namespace App\Http\Controllers;

use App\Models\Clearance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClearanceController extends Controller
{
    public function index()
    {
        // 1. Ambil data user yang login
        $user = Auth::user();
        
        // 2. Cari data pengajuan terakhir
        $myClearance = Clearance::where('user_id', $user->id)->latest()->first();

        // 3. Logic Status Tambahan (untuk Expired)
        $state = 'new';
        
        if ($myClearance) {
            // Cek apakah status approved TAPI sudah kadaluarsa
            if ($myClearance->status == 'approved' && $myClearance->expired_at && now()->greaterThan($myClearance->expired_at)) {
                $state = 'expired';
            } 
            else {
                // Jika belum expired atau statusnya pending/rejected
                $state = $myClearance->status; 
            }
        }

        // 4. Perhatikan nama view-nya!
        // Jika file blade Anda ada di folder: resources/views/student/dashboard.blade.php
        // Gunakan: return view('student.dashboard', ...);
        
        // Jika file blade Anda ada di folder: resources/views/dashboard.blade.php (Standar Breeze)
        // Gunakan: return view('dashboard', ...);
        
        return view('student.dashboard', compact('myClearance', 'state'));
    }

    public function store(Request $request)
    {
        // Cek dulu, jangan sampai orang yang suratnya masih aktif malah upload lagi
        $lastClearance = Clearance::where('user_id', Auth::id())->latest()->first();
        
        if ($lastClearance && $lastClearance->status == 'approved') {
            if (now()->lessThan($lastClearance->expired_at)) {
                return back()->with('error', 'Surat Anda masih berlaku. Tidak perlu mengajukan ulang.');
            }
        }
        // Validasi Ketat
        $request->validate([
            'file_lab'     => 'required|mimes:pdf,jpg,jpeg,png|max:5120', // Max 5MB
            'file_library' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
            'file_finance' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            // Pesan Error Bahasa Indonesia
            'file_lab.required'     => 'Bukti Bebas Laboratorium wajib diisi.',
            'file_library.required' => 'Bukti Bebas Perpustakaan wajib diisi.',
            'file_finance.required' => 'Bukti Lunas UKT wajib diisi.',
            'file_lab.max'          => 'Ukuran file Lab terlalu besar (Maks 5MB).',
        ]);

        // Simpan File
        $pathLab = $request->file('file_lab')->store('clearance/lab', 'public');
        $pathLib = $request->file('file_library')->store('clearance/library', 'public');
        $pathFin = $request->file('file_finance')->store('clearance/finance', 'public');

        // Logic: Jika ada data lama yang ditolak, kita buat baru saja agar history tercatat
        // Atau update status yang lama. Di sini kita create baru (revisi).
        Clearance::create([
            'user_id' => Auth::id(),
            'file_lab' => $pathLab,
            'file_library' => $pathLib,
            'file_finance' => $pathFin,
            'status' => 'pending', // Reset jadi pending
            'admin_note' => null,  // Reset catatan
        ]);

        return back()->with('success', 'Berkas berhasil dikirim! Menunggu verifikasi Fakultas.');
    }

    public function download(Clearance $clearance)
    {
        if($clearance->user_id != Auth::id() || !$clearance->official_letter) {
            abort(403);
        }
        
        $path = Storage::disk('public')->path($clearance->official_letter);
        return response()->download($path, 'Surat_Bebas_Tanggungan_Fakultas.pdf');
    }
}