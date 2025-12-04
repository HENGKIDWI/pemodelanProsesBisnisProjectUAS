<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bebas Tanggungan - Fakultas Teknik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen font-sans text-gray-800">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" class="h-10 w-10 object-contain" alt="Logo">
                    <span class="font-bold text-lg text-gray-900 hidden sm:block">Fakultas Teknik - UTM</span>
                    <span class="font-bold text-lg text-gray-900 sm:hidden">FT-UTM</span>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->nim }}</div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="text-red-500 hover:text-red-700 text-sm font-medium transition flex items-center gap-1">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold flex items-center gap-2"><i class="fa-solid fa-circle-exclamation"></i> Gagal Mengirim!</p>
                <ul class="list-disc ml-5 text-sm mt-1">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif
        
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
                <div>
                    <p class="font-bold">Berhasil!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
                <i class="fa-solid fa-check-circle text-2xl"></i>
            </div>
        @endif


        @if(!$myClearance || $myClearance->status == 'rejected' || ($state ?? '') == 'expired')
            
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg border border-gray-100">
                <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center flex-wrap gap-2">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Form Pengajuan Surat</h2>
                        <p class="text-xs text-gray-500 mt-1">Silakan unggah 3 dokumen prasyarat di bawah ini.</p>
                    </div>
                    
                    @if($myClearance && $myClearance->status == 'rejected')
                        <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full border border-red-200">
                            Status: Ditolak
                        </span>
                    @elseif(($state ?? '') == 'expired')
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full border border-yellow-200">
                            Status: Kadaluarsa
                        </span>
                    @endif
                </div>
                
                <div class="p-6 bg-white">
                    
                    @if($myClearance && $myClearance->status == 'rejected')
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-6 text-sm">
                            <strong class="font-bold block mb-1"><i class="fa-solid fa-triangle-exclamation"></i> Alasan Penolakan:</strong>
                            <span class="block bg-white p-2 rounded border border-red-100 text-gray-600 italic">
                                "{{ $myClearance->admin_note }}"
                            </span>
                            <p class="mt-2 text-xs">Silakan perbaiki dokumen yang salah dan upload ulang.</p>
                        </div>
                    @endif

                    @if(($state ?? '') == 'expired')
                        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded relative mb-6 text-sm">
                            <strong class="font-bold"><i class="fa-solid fa-clock"></i> Surat Lama Kadaluarsa</strong>
                            <p class="mt-1">Masa berlaku surat bebas tanggungan Anda sebelumnya telah habis. Silakan ajukan ulang untuk periode ini.</p>
                        </div>
                    @endif

                    <form action="{{ route('clearance.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                1. Surat Bebas Laboratorium <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="file_lab" accept=".pdf,.jpg,.png" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <p class="text-xs text-gray-400 mt-1">Diterbitkan oleh Kepala Lab / Teknisi Lab Jurusan.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                2. Surat Bebas Perpustakaan <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="file_library" accept=".pdf,.jpg,.png" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <p class="text-xs text-gray-400 mt-1">Diterbitkan oleh Pustakawan Pusat/Fakultas.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                3. Bukti Lunas UKT (Keuangan) <span class="text-red-500">*</span>
                            </label>
                            <input type="file" name="file_finance" accept=".pdf,.jpg,.png" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <p class="text-xs text-gray-400 mt-1">Slip pembayaran semester terakhir atau screenshot dari portal keuangan.</p>
                        </div>

                        <div class="pt-6 border-t border-gray-100">
                            <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition transform hover:-translate-y-0.5">
                                <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Pengajuan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        @elseif($myClearance->status == 'pending')

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center shadow-sm">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4 animate-pulse">
                    <i class="fa-solid fa-hourglass-half text-2xl text-yellow-600"></i>
                </div>
                <h3 class="text-xl font-bold text-yellow-900">Sedang Diverifikasi</h3>
                <p class="text-yellow-800 mt-2 mb-6 text-sm max-w-md mx-auto leading-relaxed">
                    Berkas Anda sedang diperiksa oleh Admin Fakultas. <br>
                    Mohon tunggu <strong>1x24 jam kerja</strong>. <br>
                    Jika disetujui, notifikasi dan surat akan dikirim ke email Anda.
                </p>
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full border border-yellow-200 text-xs text-gray-500 shadow-sm">
                    <i class="fa-regular fa-clock"></i> Diajukan pada: {{ $myClearance->created_at->format('d M Y, H:i') }}
                </div>
            </div>

        @elseif($myClearance->status == 'approved' && ($state ?? '') != 'expired')

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg border border-green-200">
                <div class="bg-green-50 p-8 text-center border-b border-green-100">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4 shadow-sm">
                        <i class="fa-solid fa-check text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-green-900">Selamat!</h3>
                    <p class="text-green-700 mt-2 font-medium">Anda telah dinyatakan Bebas Tanggungan Fakultas.</p>
                </div>

                <div class="p-8 bg-white text-center">
                    <p class="text-gray-600 text-sm mb-8 max-w-lg mx-auto">
                        Surat Keterangan Bebas Tanggungan (FY-04) Anda telah diterbitkan. Silakan unduh dokumen di bawah ini untuk keperluan Yudisium/Cuti.
                    </p>

                    @if($myClearance->official_letter)
                        <a href="{{ route('clearance.download', $myClearance->id) }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-green-600 hover:bg-green-700 md:py-4 md:text-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                            <i class="fa-solid fa-file-pdf mr-3"></i> Download Surat Resmi (PDF)
                        </a>
                    @else
                        <div class="inline-flex items-center gap-2 bg-yellow-50 text-yellow-800 px-6 py-3 rounded-lg border border-yellow-200 text-sm">
                            <i class="fa-solid fa-spinner fa-spin"></i> 
                            <span>Surat sedang digenerate oleh sistem. Harap refresh halaman dalam 1 menit.</span>
                        </div>
                    @endif
                </div>
                
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center text-xs text-gray-400 border-t border-gray-100">
                    <span>ID: #{{ $myClearance->id }}</span>
                    <span>Berlaku Hingga: 
                        <strong class="text-gray-600">
                            {{ \Carbon\Carbon::parse($myClearance->expired_at)->format('d M Y') }}
                        </strong>
                    </span>
                </div>
            </div>

        @endif

    </div>

    <footer class="mt-12 py-6 text-center text-gray-400 text-sm border-t border-gray-200 bg-white">
        &copy; {{ date('Y') }} Fakultas Teknik - Universitas Trunojoyo Madura
    </footer>

</body>
</html>