<?php

namespace App\Filament\Resources\SubmissionResource\Pages;

use App\Filament\Resources\SubmissionResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubmissionApproved;
use Filament\Notifications\Notification;

class EditSubmission extends EditRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }

    // FUNGSI UTAMA: Jalan otomatis saat tombol Save ditekan
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // 1. Simpan Status Lama
        $statusLama = $record->status;

        // 2. Update Data ke Database
        $record->update($data);

        // 3. LOGIC PENGIRIMAN EMAIL
        // Kirim HANYA jika:
        // A. Status berubah menjadi 'approved'
        // B. ATAU Admin sengaja save ulang status 'approved' (untuk kirim ulang email)
        if ($record->status === 'approved') {
            
            // Pastikan User punya email
            if ($record->user && $record->user->email) {
                try {
                    // Kirim Email
                    Mail::to($record->user->email)->send(new SubmissionApproved($record));

                    // Notifikasi Sukses ke Layar Admin
                    Notification::make()
                        ->title('✅ Email Notifikasi Terkirim')
                        ->body('Mahasiswa telah diinfokan untuk ke BAAK membawa berkas.')
                        ->success()
                        ->send();

                } catch (\Exception $e) {
                    // Notifikasi Jika Gagal (Misal internet putus)
                    Notification::make()
                        ->title('⚠️ Gagal Kirim Email')
                        ->body($e->getMessage())
                        ->warning()
                        ->persistent()
                        ->send();
                }
            } else {
                Notification::make()
                    ->title('⚠️ Email Mahasiswa Kosong')
                    ->body('Tidak bisa mengirim notifikasi karena data email user tidak ditemukan.')
                    ->danger()
                    ->send();
            }
        }

        return $record;
    }
}