<!DOCTYPE html>
<html>
<head>
    <title>Surat Bebas Lab</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; line-height: 1.5; font-size: 12pt; }
        .header { text-align: center; border-bottom: 3px double black; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2 { margin: 0; font-size: 16pt; font-weight: bold; }
        .header h3 { margin: 0; font-size: 14pt; font-weight: bold; }
        .content { margin: 0 40px; }
        
        table { width: 100%; margin-top: 15px; margin-bottom: 15px; }
        td { padding: 4px; vertical-align: top; }
        
        .ttd { 
            text-align: right; 
            margin-top: 40px; 
            margin-right: 30px; 
        }
        
        .ttd-img {
            width: 120px;       
            height: auto;
            display: block;     
            margin-left: auto;  
            margin-right: 0;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        /* CSS Baru untuk Catatan agar lebih rapi */
        .catatan {
            margin-top: 40px;
            border-top: 1px solid #000;
            padding-top: 5px;
            font-size: 10pt; /* Font lebih kecil */
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</h2>
        <h2>UNIVERSITAS TRUNOJOYO MADURA</h2>
        <h3>LABORATORIUM TERPADU</h3>
        <small>Jl. Raya Telang, Kamal, Bangkalan - Jawa Timur</small>
    </div>

    <div class="content">
        <h3 style="text-align: center; text-decoration: underline;">SURAT KETERANGAN BEBAS LAB</h3>
        <p style="text-align: center;">Nomor: {{ date('Y') }}/LAB/SK/{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>

        <p>Kepala Laboratorium Terpadu Universitas Trunojoyo Madura menerangkan bahwa:</p>
        
        <table>
            <tr>
                <td width="130">Nama</td>
                <td width="10">:</td>
                <td><strong>{{ $user->name }}</strong></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>:</td>
                <td>{{ $user->nim }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>{{ $user->prodi ?? '-' }}</td>
            </tr>
        </table>

        <p align="justify">Mahasiswa tersebut di atas telah menyelesaikan segala administrasi peminjaman alat dan dinyatakan <strong>TIDAK MEMILIKI TANGGUNGAN</strong> di Laboratorium Terpadu.</p>
        
        <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
        
        <div class="ttd">
            <p>Bangkalan, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Koordinator Laboratorium,</p>
            
            <img src="{{ public_path('img/ttd_kepala.png') }}" class="ttd-img" alt="TTD">
            
            <p><strong style="text-decoration: underline;">( Devie Rosa Anamisa, S.Kom.M.Kom. )</strong></p>
            <p>NIP. 9841104200812</p>
        </div>

        <div class="catatan">
            <strong>Catatan:</strong>
            <p style="margin: 0;">Surat keterangan ini berlaku selama 1 (satu) bulan sejak tanggal diterbitkan. Surat otomatis tidak berlaku apabila di kemudian hari ditemukan peminjaman baru atas nama mahasiswa tersebut.</p>
        </div>
    </div>
</body>
</html>