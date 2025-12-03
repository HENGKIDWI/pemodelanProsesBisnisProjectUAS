<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Disetujui</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .box-info { background: #e8f4f8; padding: 15px; border-left: 5px solid #5bc0de; margin-bottom: 20px; }
        .box-note { background: #fdf3d8; padding: 15px; border-left: 5px solid #f0ad4e; font-style: italic; }
        .list-syarat { margin-left: 20px; }
        .list-syarat li { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h3>Yth. {{ $submission->user->name }} ({{ $submission->user->nim }}),</h3>
    
    <div class="box-info">
        <p>Selamat! Pengajuan <strong>{{ $submission->documentTemplate->title }}</strong> Anda telah diverifikasi dan statusnya saat ini: <span style="color: green; font-weight: bold;">DISETUJUI (APPROVED)</span>.</p>
    </div>

    @if($submission->admin_note)
        <p><strong>Catatan dari Admin:</strong></p>
        <div class="box-note">
            "{{ $submission->admin_note }}"
        </div>
    @endif

    <hr>

    <h4>⚠️ LANGKAH SELANJUTNYA (WAJIB):</h4>
    <p>Silakan melanjutkan proses ke <strong>BAAK (Biro Administrasi Akademik Kemahasiswaan)</strong> untuk validasi akhir dengan membawa kelengkapan berkas fisik sebagai berikut:</p>
    
    {{-- DAFTAR DOKUMEN SESUAI GAMBAR PERSYARATAN --}}
    <ol class="list-syarat">
        <li><strong>Fotocopy Kartu Tanda Mahasiswa (KTM)</strong></li>
        <li><strong>Fotocopy Slip Pembayaran BSS (25% SPP)</strong></li>
        <li><strong>Surat Bebas Tanggungan dari Fakultas</strong></li>
        <li><strong>Surat Bebas Perpustakaan</strong></li>
        <li><strong>Surat Bebas Tanggungan Laboratorium</strong> (Jika ada)</li>
    </ol>

    <p style="font-size: 13px; color: #666;">
        <em>*Mohon pastikan semua dokumen di atas sudah lengkap sebelum datang ke loket BAAK agar proses berjalan lancar.</em>
    </p>

    <br>
    <p>Terima kasih,</p>
    <p><strong>Portal Akademik - Universitas Trunojoyo Madura</strong></p>
</body>
</html>