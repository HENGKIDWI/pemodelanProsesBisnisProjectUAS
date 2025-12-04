<!DOCTYPE html>
<html>
<head>
    <title>Surat Bebas Tanggungan</title>
    <style>
        body { font-family: 'Times New Roman', serif; font-size: 12pt; line-height: 1.5; }
        .header { 
                text-align: center; 
                border-bottom: 3px double black; 
                padding-bottom: 10px; 
                margin-bottom: 20px; 
                position: relative; /* Penting agar logo absolute bisa diatur */
            }

            .logo { 
                width: 90px; /* Atur lebar logo sesuai keinginan */
                height: auto; 
                position: absolute; 
                left: 0; 
                top: 0; 
            }
        .title { font-weight: bold; text-decoration: underline; text-align: center; margin-bottom: 20px; font-size: 14pt; }
        .content { margin-left: 30px; }
        .table-info { width: 100%; margin-top: 10px; margin-bottom: 20px; }
        .table-info td { vertical-align: top; padding: 2px; }
        .footer { margin-top: 50px; text-align: right; margin-right: 50px; }
        .signature-box { margin-top: 20px; text-align: right; }
        .ttd-img { width: 150px; height: auto; } /* Tempat TTD Digital */
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo Kampus">
        
        <div style="margin-left: 20px;">
            <span style="font-size: 14pt;">KEMENTERIAN PENDIDIKAN TINGGI, SAINS, DAN TEKNOLOGI</span><br>
            <span style="font-size: 14pt; font-weight: bold;">UNIVERSITAS TRUNOJOYO MADURA</span><br>
            <span style="font-size: 16pt; font-weight: bold;">FAKULTAS TEKNIK</span><br>
            <span style="font-size: 10pt; font-style: italic;">Jl. Raya Telang, PO.Box. 2 Kamal, Bangkalan - Madura Telp. (031) 3011146</span>
        </div>
    </div>

    <div class="title">
        SURAT KETERANGAN BEBAS TANGGUNGAN<br>
        <span style="font-size: 12pt; font-weight: normal; text-decoration: none;">Nomor: {{ $clearance->id }}/UN46.1.6/KM/{{ date('Y') }}</span>
    </div>

    <p>Yang bertanda tangan di bawah ini, Wakil Dekan II Fakultas Teknik Universitas Trunojoyo Madura, menerangkan bahwa mahasiswa:</p>

    <div class="content">
        <table class="table-info">
            <tr>
                <td style="width: 150px;">Nama</td>
                <td style="width: 10px;">:</td>
                <td style="font-weight: bold;">{{ strtoupper($clearance->user->name) }}</td>
            </tr>
            <tr>
                <td>NIM / NPM</td>
                <td>:</td>
                <td>{{ $clearance->user->nim }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>:</td>
                <td>{{ $clearance->user->prodi }}</td>
            </tr>
        </table>

        <p>Telah memenuhi persyaratan administrasi bebas tanggungan pada unit-unit berikut:</p>
        
        <ol>
            <li>Laboratorium Fakultas Teknik (Bebas Pinjam Alat).</li>
            <li>Perpustakaan (Bebas Pinjam Buku/Tanggungan).</li>
            <li>Keuangan (Lunas UKT/SPP Semester Berjalan).</li>
        </ol>

        <p>Demikian surat keterangan ini dibuat untuk dipergunakan sebagai syarat <strong>Yudisium / Cuti Akademik</strong>.</p>
    </div>

    <div class="footer">
        <p>Bangkalan, {{ date('d F Y') }}<br>a.n. Dekan<br>Wakil Dekan II</p>
        
        <div class="signature-box">
            <br><br><br> <p style="font-weight: bold; text-decoration: underline;">Ir. Hanifudin Sukri, S.Kom., M.Kom.</p>
            <p>NIP. 198703272018031001</p>
        </div>
    </div>

</body>
</html>