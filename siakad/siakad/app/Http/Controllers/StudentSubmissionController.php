<?php
namespace App\Http\Controllers;

use App\Models\DocumentTemplate;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini ada
use Illuminate\Support\Facades\Auth;


class StudentSubmissionController extends Controller
{
    public function index()
    {
        $templates = DocumentTemplate::where('is_active', true)->get();
        $mySubmissions = Submission::where('user_id', Auth::id())
                            ->with('documentTemplate')
                            ->latest()
                            ->get();

        return view('student.dashboard', compact('templates', 'mySubmissions'));
    }

    // --- REVISI 1: DOWNLOAD FIX ---
    public function downloadTemplate(DocumentTemplate $documentTemplate)
    {
        // 1. Cek apakah file ada di disk public
        if (!Storage::disk('public')->exists($documentTemplate->file_path)) {
            return back()->with('error', 'File fisik tidak ditemukan di server.');
        }

        // 2. Ambil "Full Path" (Lokasi absolut di harddisk, misal: C:\xampp\htdocs\project\storage\...)
        $fullPath = Storage::disk('public')->path($documentTemplate->file_path);

        // 3. Gunakan response()->download() bawaan Laravel
        // Parameter: (Lokasi File Asli, Nama File Baru saat didownload)
        return response()->download($fullPath, $documentTemplate->title . '.pdf');
    }

    // --- REVISI 2: UPLOAD 2 FILE SEKALIGUS ---
    public function store(Request $request)
    {
        // 1. VALIDASI KETAT: Kedua file WAJIB ada
        $request->validate([
            'document_template_id' => 'required', // ID dari input hidden
            'file_utama' => 'required|mimes:pdf,doc,docx|max:5120', // Maks 5MB
            'file_pendukung' => 'required|mimes:pdf,jpg,jpeg,png|max:5120', // Maks 5MB
        ], [
            'file_utama.required' => 'Anda wajib mengupload File Surat Permohonan.',
            'file_pendukung.required' => 'Anda wajib mengupload File Pendukung / Tagihan.',
        ]);

        // 2. Simpan Kedua File ke Storage Public
        $path1 = $request->file('file_utama')->store('submissions', 'public');
        $path2 = $request->file('file_pendukung')->store('submissions', 'public');

        // 3. Simpan ke Database (Termasuk Data Pengaju via Auth::id())
        Submission::create([
            'user_id' => Auth::id(), // <--- Ini Data Pengaju
            'document_template_id' => $request->document_template_id,
            'submitted_file_path' => $path1, // File 1
            'submitted_file_2' => $path2,    // File 2
            'status' => 'pending',
        ]);

        return back()->with('success', 'Berkas lengkap berhasil dikirim! Menunggu verifikasi.');
    }
}