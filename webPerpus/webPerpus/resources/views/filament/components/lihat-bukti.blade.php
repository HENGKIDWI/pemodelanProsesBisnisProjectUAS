<div class="flex flex-col items-center justify-center space-y-4">
    <p class="text-sm text-gray-500">Pastikan bukti pembayaran valid sebelum memverifikasi.</p>
    @if($record->bukti_pembayaran)
        <img src="{{ asset('storage/' . $record->bukti_pembayaran) }}" 
             alt="Bukti Bayar" 
             class="max-w-full h-auto rounded-lg shadow-md border" 
             style="max-height: 400px;">
        <a href="{{ asset('storage/' . $record->bukti_pembayaran) }}" 
           target="_blank" 
           class="text-blue-600 hover:underline text-sm">
           Buka ukuran penuh
        </a>
    @else
        <p class="text-red-500 font-bold">Tidak ada bukti pembayaran yang diupload.</p>
    @endif
</div>