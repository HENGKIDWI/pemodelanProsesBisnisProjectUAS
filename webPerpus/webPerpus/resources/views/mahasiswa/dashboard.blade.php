<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

    <nav class="bg-white shadow mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl font-bold text-blue-600">Perpustakaan UTM</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right mr-4">
                        <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        <div class="text-xs text-gray-500">{{ $user->nim }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-red-500 hover:text-red-700 text-sm font-medium">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Gagal!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        @if(session('warning'))
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold">Perhatian!</p>
                <p>{{ session('warning') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Status Bebas Tanggungan</h2>
                    
                    @if($historySurat)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-4">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-blue-900">Surat Bebas Tanggungan Aktif</h3>
                            <p class="text-blue-700 mt-2 mb-6">
                                Diterbitkan pada tanggal <strong>{{ $historySurat->created_at->format('d M Y') }}</strong>.
                            </p>
                            
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route('surat.download') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow transition flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Download PDF
                                </a>

                                <form action="{{ route('permohonan.ajukan') }}" method="POST" onsubmit="return confirm('Apakah Anda ingin memperbarui tanggal surat? Sistem akan mengecek ulang status tanggungan Anda.');">
                                    @csrf
                                    <button type="submit" class="w-full sm:w-auto bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 font-bold py-2 px-6 rounded shadow transition flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        Perbarui Tanggal
                                    </button>
                                </form>
                            </div>
                        </div>
                    
                    @elseif($hasActiveDebt)
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6 text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-red-900">Pengajuan Ditahan</h3>
                            <p class="text-red-700 mt-2">Sistem mendeteksi adanya tanggungan yang belum lunas (Lihat tabel di bawah).</p>
                            <button disabled class="mt-4 bg-gray-300 text-gray-500 px-6 py-2 rounded cursor-not-allowed font-medium">
                                Ajukan Surat Bebas Tanggungan
                            </button>
                        </div>

                    @else
                        <div class="bg-green-50 border border-green-200 rounded-lg p-6 text-center">
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h3 class="text-lg font-medium text-green-900">Status Aman</h3>
                            <p class="text-green-700 mt-2">Anda tidak memiliki tanggungan.</p>
                            
                            <form action="{{ route('permohonan.ajukan') }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow-lg transition transform hover:scale-105">
                                    Ajukan surat bebas tanggungan
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Rincian Peminjaman & Denda</h3>

                    @if($tanggungan->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left text-gray-500 border rounded-lg">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                        <tr>
                                        <th class="px-6 py-3">Judul Buku</th>
                                        <th class="px-6 py-3">Tanggal</th>
                                        <th class="px-6 py-3">Durasi</th>
                                        <th class="px-6 py-3">Nominal Denda</th>
                                        <th class="px-6 py-3">Status</th>
                                        <th class="px-6 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tanggungan as $item)
                                        <tr class="bg-white border-b hover:bg-gray-50">
                                            <td class="px-6 py-4 font-medium text-gray-900">{{ $item->judul_buku }}</td>
                                            <td class="px-6 py-4">{{ $item->tanggal_peminjaman ? $item->tanggal_peminjaman->format('d M Y') : '-' }}</td>
                                            <td class="px-6 py-4">{{ $item->durasi_peminjaman ? $item->durasi_peminjaman . ' hari' : '-' }}</td>
                                            <td class="px-6 py-4">
                                                <div>Rp {{ number_format($item->nominal_denda, 0, ',', '.') }}</div>
                                                @if($item->hari_keterlambatan > 0)
                                                    <div class="text-red-600 text-xs font-semibold">(+ {{ $item->hari_keterlambatan }} hari terlambat)</div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($item->is_paid)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Lunas</span>
                                                @elseif($item->is_verifying)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu Verifikasi</span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Belum Lunas</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if(!$item->is_paid && !$item->is_verifying)
                                                    <form action="{{ route('tanggungan.bayar', $item->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="flex items-center gap-2">
                                                            <label class="block cursor-pointer">
                                                                <span class="sr-only">Choose file</span>
                                                                <input type="file" name="bukti_pembayaran" required class="block w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
                                                            </label>
                                                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700">Upload</button>
                                                        </div>
                                                    </form>
                                                @elseif($item->is_verifying)
                                                    <span class="text-xs text-gray-400 italic">Sedang dicek admin...</span>
                                                @else
                                                    <span class="text-green-600 font-bold">✓ Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-400 border-2 border-dashed rounded-lg">
                            <p>Tidak ada riwayat tanggungan alat.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</body>
</html>