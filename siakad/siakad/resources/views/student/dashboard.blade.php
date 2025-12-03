<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Akademik - Universitas Trunojoyo Madura</title>
    <style>
        /* --- CSS ASLI DARI ANDA --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e8ba3 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background-color: #f5f5f5; border-radius: 10px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); }
        .header { background: linear-gradient(to right, #4a4a4a, #2d2d2d); padding: 15px 25px; display: flex; align-items: center; gap: 15px; }
        .logo { width: 45px; height: 45px; }
        .header-title { color: #ffffff; font-size: 16px; font-weight: bold; }
        .main-content { display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 15px; padding: 20px; background-color: #ffffff; }
        .sidebar-left { background-color: #f9f9f9; }
        .section-title { background-color: #f0f0f0; padding: 10px 15px; font-size: 14px; font-weight: bold; color: #333; border-bottom: 2px solid #ddd; }
        .announcement-item { padding: 15px; border-bottom: 1px solid #e0e0e0; }
        .announcement-category { color: #666; font-size: 12px; margin-bottom: 5px; }
        .announcement-title { color: #d9534f; font-size: 13px; font-weight: bold; margin-bottom: 3px; }
        .center-content { background-color: #fff; }
        /* Style Sidebar Kanan */
        .sidebar-right { background-color: #f9f9f9; }
        .user-info { padding: 15px; text-align: center; }
        .message-count { background-color: #fff; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
        .message-text { font-size: 12px; color: #333; }
        .message-link { color: #337ab7; text-decoration: none; font-weight: bold; }
        .user-photo { width: 120px; height: 160px; margin: 15px auto; border: 3px solid #ddd; border-radius: 5px; object-fit: cover; }
        .user-name { font-size: 14px; font-weight: bold; color: #333; margin: 10px 0 5px; text-transform: uppercase; }
        .user-nim, .user-major { font-size: 12px; color: #666; }
        .user-major { margin-bottom: 10px; }
        .logout-link { display: inline-block; margin-top: 10px; color: #337ab7; font-size: 12px; text-decoration: none; cursor: pointer; background: none; border: none; }
        .logout-link:hover { text-decoration: underline; }
        .menu-section { margin-top: 15px; }
        .menu-category { background-color: #f0ad4e; color: #fff; padding: 8px 15px; font-size: 13px; font-weight: bold; }
        .menu-list { list-style: none; background-color: #fff; }
        .menu-list li { border-bottom: 1px solid #e0e0e0; }
        .menu-list li:last-child { border-bottom: none; }
        .menu-list a { display: block; padding: 10px 15px; color: #337ab7; text-decoration: none; font-size: 12px; transition: background-color 0.3s; }
        .menu-list a:hover { background-color: #f0f0f0; }
        .status-section { margin-top: 15px; background-color: #fff; padding: 15px; }
        .status-title { font-size: 13px; font-weight: bold; color: #333; margin-bottom: 10px; }
        .status-item { display: flex; align-items: center; gap: 5px; font-size: 12px; color: #333; }
        .status-icon { color: #5cb85c; font-weight: bold; }
        .footer { background-color: #2d2d2d; color: #ccc; padding: 15px; text-align: center; font-size: 12px; }
        .footer a { color: #f0ad4e; text-decoration: none; margin: 0 10px; }
        .footer a:hover { text-decoration: underline; }

        @media (max-width: 992px) {
            .main-content { grid-template-columns: 1fr; }
        }

        /* --- TAMBAHAN CSS KHUSUS FORM CUTI (AGAR RAPI DI TENGAH) --- */
        .content-box {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .content-header {
            background-color: #e8f4f8;
            border-left: 4px solid #5bc0de;
            padding: 10px 15px;
            color: #31708f;
            font-weight: bold;
            font-size: 14px;
        }
        .content-body { padding: 15px; }
        
        /* Table Style */
        .academic-table { width: 100%; border-collapse: collapse; font-size: 12px; }
        .academic-table th, .academic-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .academic-table th { background-color: #f5f5f5; color: #333; }
        
        /* Form Style */
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 12px; font-weight: bold; margin-bottom: 5px; color: #555; }
        .form-control { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 3px; font-size: 12px; }
        .btn { padding: 6px 12px; border: none; border-radius: 3px; cursor: pointer; font-size: 12px; color: white; display: inline-block; text-decoration: none; }
        .btn-success { background-color: #5cb85c; }
        .btn-primary { background-color: #337ab7; width: 100%; }
        
        /* Alerts & Badges */
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 3px; font-size: 12px; }
        .alert-success { background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; }
        .alert-danger { background-color: #f2dede; color: #a94442; border: 1px solid #ebccd1; }
        .badge { padding: 3px 8px; border-radius: 10px; color: white; font-size: 10px; }
        .badge-warning { background-color: #f0ad4e; }
        .badge-success { background-color: #5cb85c; }
        .badge-danger { background-color: #d9534f; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="" alt="Logo UTM" class="logo">
            <div class="header-title">Portal Akademik | Universitas Trunojoyo Madura</div>
        </div>

        <div class="main-content">
            
            <div class="sidebar-left">
                <div class="section-title">Pengumuman</div>
                <div class="announcement-item">
                    <div class="announcement-category">Kategori : Informasi Akademik</div>
                    <div class="announcement-title">Belum ada informasi untuk kategori ini</div>
                </div>
                <div class="announcement-item">
                    <div class="announcement-category">Kategori : Kegiatan Mahasiswa</div>
                    <div class="announcement-title">Belum ada informasi untuk kategori ini</div>
                </div>
                <div class="announcement-item">
                    <div class="announcement-category">Kategori : Seputar Registrasi</div>
                    <div class="announcement-title">Belum ada informasi untuk kategori ini</div>
                </div>
            </div>

            <div class="center-content">
                
                {{-- Notifikasi Error / Sukses Laravel --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul style="padding-left: 20px;">
                            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Box 1: Download Template --}}
                <div class="content-box">
                    <div class="content-header">Langkah 1: Unduh Formulir Cuti</div>
                    <div class="content-body">
                        <p style="font-size: 12px; color: #666; margin-bottom: 10px;">
                            Silakan unduh dokumen di bawah ini, cetak, dan isi dengan lengkap.
                        </p>
                        <table class="academic-table">
                            <thead>
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Keterangan</th>
                                    <th style="text-align: center; width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $template)
                                <tr>
                                    <td>{{ $template->title }}</td>
                                    <td>{{ $template->description }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('template.download', $template->id) }}" class="btn btn-success">Download</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center;">Belum ada dokumen tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Box 2: Upload Pengajuan --}}
                <div class="content-box">
                    <div class="content-header">Langkah 2: Ajukan Permohonan (Upload Berkas)</div>
                    <div class="content-body">
                        
                        {{-- Peringatan Wajib --}}
                        <div class="alert alert-warning" style="font-size: 12px; border-left: 4px solid #f0ad4e;">
                            <strong>PENTING:</strong> Sesuai prosedur, Anda <u>WAJIB</u> mengunggah kedua file berikut:
                        </div>

            <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Input Hidden untuk ID Template (Otomatis ambil yang pertama) --}}
                @if($templates->count() > 0)
                    <input type="hidden" name="document_template_id" value="{{ $templates->first()->id }}">
                @endif

                {{-- FILE 1: SURAT PERMOHONAN --}}
                <div class="form-group">
                    <label class="form-label" style="color: #d9534f;">1. File Surat Permohonan (PDF) *</label>
                    <input type="file" name="file_utama" class="form-control" accept=".pdf,.docx,.doc" required>
                    <small class="text-muted">Wajib diisi. Format: PDF/Docx.</small>
                </div>

                {{-- FILE 2: DOKUMEN PENDUKUNG --}}
                <div class="form-group">
                    <label class="form-label" style="color: #d9534f;">2. File Pendukung / Tagihan (PDF/Gambar) *</label>
                    <input type="file" name="file_pendukung" class="form-control" accept=".pdf,.jpg,.jpeg,.png" required>
                    <small class="text-muted">Wajib diisi. Bukti tagihan atau dokumen pendukung.</small>
                </div>

                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">
                    <i class="fa fa-upload"></i> Kirim Berkas Lengkap
                </button>
            </form>
                    </div>
                </div>

                {{-- Box 3: Riwayat Pengajuan --}}
                <div class="content-box">
                    <div class="content-header">Riwayat Pengajuan Anda</div>
                    <div class="content-body">
                        <table class="academic-table">
                            <thead>
                                <tr>
                                    <th>Dokumen</th>
                                    <th>Tanggal Upload</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mySubmissions as $submission)
                                <tr>
                                    <td>{{ $submission->documentTemplate->title }}</td>
                                    <td>{{ $submission->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if($submission->status == 'pending')
                                            <span class="badge badge-warning">Menunggu</span>
                                        @elseif($submission->status == 'approved')
                                            <span class="badge badge-success">Disetujui</span>
                                        @else
                                            <span class="badge badge-danger">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center; color: #999;">Belum ada riwayat pengajuan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="sidebar-right">
                <div class="section-title">Informasi Pengguna</div>
                
                <div class="user-info">
                    <div class="message-count">
                        <div class="message-text">
                            Anda memiliki <a href="#" class="message-link">( 0 )</a> pesan <span style="font-weight: bold;">baru</span>
                        </div>
                    </div>
                    <div class="message-count">
                        <div class="message-text">
                            <a href="#" class="message-link">Masuk</a> | <a href="#" class="message-link">Terkirim</a>
                        </div>
                    </div>

                    {{-- Logic Menampilkan Foto --}}
                    @if(Auth::user()->photo)
                        {{-- Ambil dari storage public --}}
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="User Photo" class="user-photo">
                    @else
                        {{-- Placeholder jika error/kosong --}}
                        <img src="https://via.placeholder.com/120x160/cccccc/666666?text=No+Photo" alt="User Photo" class="user-photo">
                    @endif                    
                    {{-- Nama diambil dari Login, sisanya fallback karena tidak diubah di DB --}}
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    
                    {{-- Gunakan NIM/Prodi jika ada kolomnya, jika tidak tampilkan static/placeholder --}}
                    <div class="user-nim">{{ Auth::user()->nim ?? '230411100163' }}</div>
                    <div class="user-major">{{ Auth::user()->prodi ?? 'TEKNIK INFORMATIKA' }}</div>
                    
                    {{-- Tombol Logout Laravel --}}
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="logout-link">[ Logout ]</button>
                    </form>
                </div>

                <div class="menu-section">
                    <div class="menu-category">Academics</div>
                    <ul class="menu-list">
                        <li><a href="#">Halaman Depan</a></li>
                        <li><a href="#">Panduan</a></li>
                        <li><a href="#">Profil</a></li>
                        <li><a href="#">Informasi Matakuliah</a></li>
                        <li><a href="#">Kartu Rencana Studi</a></li>
                        <li><a href="#">Kartu Hasil Studi</a></li>
                        <li><a href="#">Transkrip Nilai</a></li>
                        <li><a href="#">Judul Tugas Akhir</a></li>
                        <li><a href="#">Hasil Kuisioner</a></li>
                        <li><a href="#">Informasi Akademik</a></li>
                        <li><a href="#" style="color: #d9534f; font-weight: bold;">Cuti Studi</a></li>
                        <li><a href="#">Ubah Password</a></li>
                    </ul>
                </div>

                <div class="menu-section">
                    <div class="menu-category" style="background-color: #5bc0de;">Pesan</div>
                    <ul class="menu-list">
                        <li><a href="#">Forum Diskusi</a></li>
                    </ul>
                </div>

                <div class="status-section">
                    <div class="status-title">Status Service</div>
                    <div class="status-item">
                        <span class="status-icon">➜</span>
                        <span>SIA</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            Portal Akademik Universitas Trunojoyo Madura<br>
            © 2016, All Right Reserved
            <div style="margin-top: 10px;">
                <a href="#">Disclaimer</a> | <a href="#">FAQ</a>
            </div>
        </div>
    </div>
</body>
</html>