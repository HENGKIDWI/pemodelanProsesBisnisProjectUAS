<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bebas Tanggungan Fakultas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(!$myClearance)
                    {{-- FORM UPLOAD --}}
                    <h3 class="text-lg font-bold mb-4">Upload Persyaratan</h3>
                    <form action="{{ route('clearance.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block font-medium">1. Bukti Bebas Lab</label>
                                <input type="file" name="file_lab" class="w-full border p-2 rounded" required>
                            </div>
                            <div>
                                <label class="block font-medium">2. Bukti Bebas Perpus</label>
                                <input type="file" name="file_library" class="w-full border p-2 rounded" required>
                            </div>
                            <div>
                                <label class="block font-medium">3. Bukti Lunas UKT</label>
                                <input type="file" name="file_finance" class="w-full border p-2 rounded" required>
                            </div>
                        </div>
                        <button type="submit" class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Kirim Pengajuan
                        </button>
                    </form>

                @else
                    {{-- STATUS --}}
                    <div class="text-center">
                        <h3 class="text-lg font-bold">Status Pengajuan Anda</h3>
                        
                        @if($myClearance->status == 'pending')
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-bold mt-2">
                                SEDANG DIPERIKSA ADMIN
                            </span>
                        @elseif($myClearance->status == 'rejected')
                            <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-bold mt-2">
                                DITOLAK
                            </span>
                            <p class="mt-2 text-red-600">Catatan: {{ $myClearance->admin_note }}</p>
                        @elseif($myClearance->status == 'approved')
                            <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-bold mt-2">
                                DISETUJUI
                            </span>
                            <div class="mt-6">
                                <p class="mb-2">Surat Keterangan Bebas Tanggungan Anda sudah terbit.</p>
                                <a href="{{ route('clearance.download', $myClearance->id) }}" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                                    Download Surat (FY-04)
                                </a>
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>