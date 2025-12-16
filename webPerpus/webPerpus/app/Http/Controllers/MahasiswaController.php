<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Tanggungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class MahasiswaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil semua tanggungan user
        $tanggungan = $user->tanggungan; 
        
        // Cek apakah user punya tanggungan yang BELUM lunas
        $hasActiveDebt = $user->hasActiveDebts(); // Pastikan fungsi ini ada di Model User

        // Cek apakah sudah pernah dapat surat bebas (approved)
        $historySurat = $user->permohonan()->where('status', 'approved')->latest()->first();

        return view('mahasiswa.dashboard', compact('user', 'tanggungan', 'hasActiveDebt', 'historySurat'));
    }

    // Fungsi 1: Upload Bukti Bayar per Item
    public function uploadBayar(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        $tanggungan = Tanggungan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Simpan File
        $path = $request->file('bukti_pembayaran')->store('bukti-bayar-alat', 'public');

        // Update Tanggungan
        $tanggungan->update([
            'bukti_pembayaran' => $path,
            'is_verifying' => true // Menandakan sedang menunggu admin
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Tunggu verifikasi admin.');
    }

    // Fungsi 2: Ajukan Surat (Skenario Auto-Approve jika bersih)
    public function ajukanSurat()
    {
        $user = Auth::user();
        // 1. Cek Tanggungan Aktif
        if ($user->hasActiveDebts()) {
            Permohonan::updateOrCreate(
                ['user_id' => $user->id],
                ['status' => 'has_debt']
            );
            return redirect()->back()->with('error', 'Gagal! Ditemukan tanggungan baru.');
        }

        // 2. Jika Bersih, Update Surat dengan Tanggal BARU (PERBAIKAN DISINI)
        // Kita pakai firstOrNew lalu save manual agar timestamp bisa dipaksa berubah
        $permohonan = Permohonan::firstOrNew(['user_id' => $user->id]);
        $permohonan->status = 'approved';
        $permohonan->created_at = now(); // <--- Paksa tanggal jadi SEKARANG
        $permohonan->updated_at = now();
        $permohonan->save();

        // 3. Generate PDF & Kirim Email (Sama seperti sebelumnya)
        try {
            $pdf = Pdf::loadView('surat.bebas-lab', ['user' => $user]);
            Mail::to($user->email)->send(
                new \App\Mail\SuratBebasLabMail($user, $pdf->output())
            );
            return redirect()->back()->with('success', 'Surat terbaru telah dikirim ke email & siap didownload.');
        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Surat diperbarui, tapi email gagal.');
        }
    }

    public function downloadSurat()
    {
        $user = Auth::user();
        
        // Cek apakah sudah approved
        $permohonan = $user->permohonan()->where('status', 'approved')->latest()->first();

        if (!$permohonan) {
            return redirect()->back()->with('error', 'Surat belum tersedia.');
        }

        // Generate PDF (Load View yang sama dengan email)
        $pdf = Pdf::loadView('surat.bebas-lab', ['user' => $user]);

        // Download file bernama 'Surat_Bebas_Lab_NIM.pdf'
        return $pdf->download('Surat_Bebas_Tanggungan_Perpus_' . $user->nim . '.pdf');
    }
}