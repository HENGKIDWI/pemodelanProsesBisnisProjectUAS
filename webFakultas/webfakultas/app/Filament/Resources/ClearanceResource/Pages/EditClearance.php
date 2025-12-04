<?php

namespace App\Filament\Resources\ClearanceResource\Pages;

use App\Filament\Resources\ClearanceResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Mail\ClearanceApproved;
use Filament\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf; // Import DomPDF

class EditClearance extends EditRecord
{
    protected static string $resource = ClearanceResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $statusLama = $record->status;

        // 1. Update Data dasar dulu (Status jadi approved, dll)
        $record->update($data);

        // 2. LOGIC GENERATE PDF & EMAIL
        // Hanya jalankan jika Status berubah jadi 'approved'
        if ($record->status === 'approved' && $statusLama !== 'approved') {
            // SET EXPIRATION DATE (Contoh: 6 Bulan dari sekarang)
            $record->expired_at = now()->addMonths(6);
            $record->save();
            
            try {
                // A. GENERATE PDF MENGGUNAKAN DOMPDF
                // Kita load view yang tadi dibuat
                $pdf = Pdf::loadView('pdf.clearance_letter', ['clearance' => $record]);
                
                // Set ukuran kertas (Opsional)
                $pdf->setPaper('a4', 'portrait');

                // Ambil output binary PDF
                $pdfContent = $pdf->output();

                // B. SIMPAN FILE KE STORAGE (Agar bisa didownload di dashboard)
                $fileName = 'surat_bebas_' . $record->user->nim . '_' . time() . '.pdf';
                $filePath = 'clearance/official/' . $fileName;
                
                // Simpan ke disk public
                Storage::disk('public')->put($filePath, $pdfContent);

                // Update database kolom 'official_letter' otomatis
                $record->official_letter = $filePath;
                $record->save(); // Simpan path file baru

                // C. KIRIM EMAIL DENGAN LAMPIRAN
                if ($record->user && $record->user->email) {
                    Mail::to($record->user->email)->send(new ClearanceApproved($record, $pdfContent));
                    
                    Notification::make()
                        ->title('Sukses!')
                        ->body('Surat otomatis dibuat & dikirim ke email mahasiswa.')
                        ->success()
                        ->send();
                }

            } catch (\Exception $e) {
                Notification::make()
                    ->title('Error Generate/Kirim')
                    ->body($e->getMessage())
                    ->danger()
                    ->persistent()
                    ->send();
            }
        }

        return $record;
    }
}