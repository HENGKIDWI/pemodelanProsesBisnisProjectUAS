<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuti Studi - Portal Akademik UTM</title>
    <style>
        /* --- CSS BAWAAN ANDA (TIDAK SAYA UBAH) --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e8ba3 100%); min-height: 100vh; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; background-color: #f5f5f5; border-radius: 10px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3); }
        .header { background: linear-gradient(to right, #4a4a4a, #2d2d2d); padding: 15px 25px; display: flex; align-items: center; gap: 15px; }
        .logo { width: 45px; height: 45px; }
        .header-title { color: #ffffff; font-size: 16px; font-weight: bold; }
        .main-content { display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 15px; padding: 20px; background-color: #ffffff; }
        .sidebar-left, .sidebar-right { background-color: #f9f9f9; }
        .section-title { background-color: #f0f0f0; padding: 10px 15px; font-size: 14px; font-weight: bold; color: #333; border-bottom: 2px solid #ddd; }
        .announcement-item { padding: 15px; border-bottom: 1px solid #e0e0e0; }
        .announcement-category { color: #666; font-size: 12px; margin-bottom: 5px; }
        .announcement-title { color: #d9534f; font-size: 13px; font-weight: bold; margin-bottom: 3px; }
        .center-content { background-color: #fff; }
        .user-info { padding: 15px; text-align: center; }
        .message-count { background-color: #fff; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
        .message-text { font-size: 12px; color: #333; }
        .message-link { color: #337ab7; text-decoration: none; font-weight: bold; }
        .user-photo { width: 120px; height: 160px; margin: 15px auto; border: 3px solid #ddd; border-radius: 5px; object-fit: cover; }
        .user-name { font-size: 14px; font-weight: bold; color: #333; margin: 10px 0 5px; }
        .user-nim, .user-major { font-size: 12px; color: #666; }
        .user-major { margin-bottom: 10px; }
        .logout-link { display: inline-block; margin-top: 10px; color: #337ab7; font-size: 12px; text-decoration: none; }
        .menu-section { margin-top: 15px; }
        .menu-category { background-color: #f0ad4e; color: #fff; padding: 8px 15px; font-size: 13px; font-weight: bold; }
        .menu-list { list-style: none; background-color: #fff; }
        .menu-list li { border-bottom: 1px solid #e0e0e0; }
        .menu-list a { display: block; padding: 10px 15px; color: #337ab7; text-decoration: none; font-size: 12px; transition: background-color 0.3s; }
        .menu-list a:hover { background-color: #f0f0f0; }
        .status-section { margin-top: 15px; background-color: #fff; padding: 15px; }
        .status-title { font-size: 13px; font-weight: bold; color: #333; margin-bottom: 10px; }
        .status-item { display: flex; align-items: center; gap: 5px; font-size: 12px; color: #333; }
        .status-icon { color: #5cb85c; font-weight: bold; }
        .footer { background-color: #2d2d2d; color: #ccc; padding: 15px; text-align: center; font-size: 12px; }
        .footer a { color: #f0ad4e; text-decoration: none; margin: 0 10px; }
        
        /* --- CSS TAMBAHAN UTK FITUR CUTI (AGAR RAPI) --- */
        .academic-box {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .academic-header {
            background-color: #e8f4f8;
            border-left: 4px solid #5bc0de;
            padding: 10px 15px;
            color: #31708f;
            font-weight: bold;
            font-size: 14px;
        }
        .academic-body {
            padding: 15px;
        }
        /* Styling Table */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .custom-table th, .custom-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .custom-table th {
            background-color: #f2f2f2;
            color: #333;
        }
        /* Styling Form */
        .form-group { margin-bottom: 15px; }
        .form-label { display: block; font-size: 13px; margin-bottom: 5px; color: #333; font-weight: bold; }
        .form-control {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-size: 13px;
        }
        .btn {
            padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-size: 13px; color: white;
        }
        .btn-success { background-color: #5cb85c; text-decoration: none; display: inline-block;}
        .btn-primary { background-color: #337ab7; }
        .alert { padding: 10px; margin-bottom: 15px; font-size: 13px; border-radius: 4px; }
        .alert-success { background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; }
        .alert-danger { background-color: #f2dede; color: #a94442; border: 1px solid #ebccd1; }
        .badge { padding: 3px 7px; border-radius: 10px; font-size: 11px; color: white;}
        .bg-warning { background-color: #f0ad4e; }
        .bg-success { background-color: #5cb85c; }
        .bg-danger { background-color: #d9534f; }

        @media (max-width: 992px) {
            .main-content { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="https://siakad.trunojoyo.ac.id/images/logo-utm-mini.png" alt="Logo UTM" class="logo">
            <div class="header-title">Portal Akademik | Universitas Trunojoyo Madura</div>
        </div>

        <div class="main-content">
            
            <div class="sidebar-left">
                <div class="section-title">Pengumuman</div>
                <div class="announcement-item">
                    <div class="announcement-category">Kategori : Informasi Akademik</div>
                    <div class="announcement-title">Belum ada informasi untuk kategori ini</div>
                </div>
                </div>

            <div class="center-content">
                
                {{-- Pesan Sukses / Error --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
                    </div>
                @endif

                <div class="academic-box">
                    <div class="academic-header">Langkah 1: Unduh Template Formulir</div>
                    <div class="academic-body">
                        <p style="font-size: 13px; color: #666; margin-bottom: 10px;">
                            Silakan unduh dokumen di bawah ini, isi dengan lengkap, dan mintalah tanda tangan yang diperlukan.
                        </p>
                        <table class="custom-table">
                            <thead>
                                <tr>
                                    <th>Nama Dokumen</th>
                                    <th>Keterangan</th>
                                    <th style="text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($templates as $template)
                                <tr>
                                    <td>{{ $template->title }}</td>
                                    <td>{{ $template->description }}</td>
                                    <td style="text-align: center;">
                                        <a href="{{ route('template.download', $template->id) }}" class="btn btn-success">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="text-align: center;">Tidak ada dokumen tersedia.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="academic-box">
                    <div class="academic-header">Langkah 2: Unggah Dokumen Terisi</div>
                    <div class="academic-body">
                        <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Jenis Dokumen</label>
                                <select name="document_template_id" class="form-control" required>
                                    <option value="">-- Pilih Jenis Dokumen --</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}">{{ $template->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">File Scan (PDF/DOCX)</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Kirim Pengajuan</button>
                        </form>
                    </div>
                </div>

                <div class="academic-box">
                    <div class="academic-header">Riwayat Pengajuan Saya</div>
                    <div class="academic-body">
                        <table class="custom-table">
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
                                            <span class="badge bg-warning">Menunggu</span>
                                        @elseif($submission->status == 'approved')
                                            <span class="badge bg-success">Disetujui</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
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

                    {{-- GAMBAR DINAMIS --}}
                    {{-- Pastikan user punya kolom 'photo' atau gunakan placeholder --}}
                    @if(Auth::user()->photo)
                        <img src="{{ Storage::url(Auth::user()->photo) }}" alt="User Photo" class="user-photo">
                    @else
                        {{-- Placeholder jika tidak ada foto --}}
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=cccccc&color=666666&size=160" alt="User Photo" class="user-photo">
                    @endif
                    
                    {{-- DATA USER DINAMIS --}}
                    <div class="user-name">{{ strtoupper(Auth::user()->name) }}</div>
                    <div class="user-nim">{{ Auth::user()->nim ?? 'NIM TIDAK DITEMUKAN' }}</div>
                    <div class="user-major">{{ Auth::user()->major ?? 'MAHASISWA' }}</div>
                    
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" style="background:none; border:none; color:#337ab7; cursor:pointer; font-size:12px;" class="logout-link">[ Logout ]</button>
                    </form>
                </div>

                <div class="menu-section">
                    <div class="menu-category">Academics</div>
                    <ul class="menu-list">
                        <li><a href="#">Halaman Depan</a></li>
                        {{-- ... menu lainnya ... --}}
                        <li><a href="{{ route('dashboard') }}" style="color: #d9534f; font-weight: bold;">Cuti Studi</a></li>
                        <li><a href="#">Ubah Password</a></li>
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
        </div>
    </div>
</body>
</html>