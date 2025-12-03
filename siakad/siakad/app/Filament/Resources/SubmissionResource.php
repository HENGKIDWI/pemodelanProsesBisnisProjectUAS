<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Filament\Resources\SubmissionResource\RelationManagers;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Mail; 
use App\Mail\SubmissionApproved;
use Illuminate\Database\Eloquent\Model;


class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // BAGIAN 1: DATA MAHASISWA (Gunakan Placeholder agar pasti muncul)
                Forms\Components\Section::make('Data Mahasiswa')
                    ->schema([
                        Forms\Components\Placeholder::make('nama_mahasiswa')
                            ->label('Nama Mahasiswa')
                            // Ambil data langsung dari record -> user -> name
                            ->content(fn (Submission $record) => $record->user->name ?? 'Tidak Diketahui'),

                        Forms\Components\Placeholder::make('nim_mahasiswa')
                            ->label('NIM')
                            ->content(fn (Submission $record) => $record->user->nim ?? '-'),

                        Forms\Components\Placeholder::make('prodi_mahasiswa')
                            ->label('Program Studi')
                            ->content(fn (Submission $record) => $record->user->prodi ?? '-'),
                    ])->columns(3),

                // BAGIAN 2: BERKAS (Tampilkan 2 File)
                Forms\Components\Section::make('Berkas Pengajuan')
                    ->schema([
                        // File 1
                        Forms\Components\FileUpload::make('submitted_file_path')
                            ->label('1. Surat Permohonan')
                            ->disk('public') // Pastikan disk public
                            ->directory('submissions')
                            ->downloadable()
                            ->openable()
                            ->disabled()
                            ->dehydrated(false),

                        // File 2
                        Forms\Components\FileUpload::make('submitted_file_2')
                            ->label('2. Dokumen Pendukung')
                            ->disk('public') 
                            ->directory('submissions')
                            ->downloadable()
                            ->openable()
                            ->disabled()
                            ->dehydrated(false),
                    ])->columns(2),

                // BAGIAN 3: EKSEKUSI
                Forms\Components\Section::make('Status Verifikasi')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Disetujui (ACC)',
                                'rejected' => 'Ditolak',
                            ])
                            ->label('Status Pengajuan')
                            ->native(false)
                            ->required(),

                        Forms\Components\Textarea::make('admin_note')
                            ->label('Catatan Admin')
                            ->placeholder('Berikan alasan jika ditolak, atau catatan tambahan jika diterima...')
                            ->rows(3),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Mahasiswa')
                    ->description(fn ($record) => $record->user->nim) // Tampilkan NIM dibawah nama
                    ->searchable(),

                Tables\Columns\TextColumn::make('documentTemplate.title')
                    ->label('Dokumen')
                    ->limit(20),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Masuk')
                    ->dateTime('d M Y H:i'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()->label('Proses'),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmission::route('/create'),
            'edit' => Pages\EditSubmission::route('/{record}/edit'),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // 1. Cek status SEBELUM di-update
        $statusSebelumnya = $record->status;

        // 2. Lakukan Update Data (Simpan ke DB)
        $record->update($data);

        // 3. Cek status SETELAH di-update
        // Logika: Jika sebelumnya BUKAN approved, dan sekarang JADI approved
        if ($statusSebelumnya !== 'approved' && $record->status === 'approved') {
            
            // Kirim Email ke Mahasiswa
            // Pastikan user punya email yang valid
            if ($record->user && $record->user->email) {
                try {
                    Mail::to($record->user->email)->send(new SubmissionApproved($record));
                    
                    // (Opsional) Beri notifikasi ke Admin bahwa email terkirim
                    \Filament\Notifications\Notification::make()
                        ->title('Email notifikasi berhasil dikirim ke mahasiswa')
                        ->success()
                        ->send();
                        
                } catch (\Exception $e) {
                    // Jika gagal kirim email (misal koneksi internet mati), jangan error-kan aplikasinya
                    \Filament\Notifications\Notification::make()
                        ->title('Gagal mengirim email: ' . $e->getMessage())
                        ->warning()
                        ->send();
                }
            }
        }

        return $record;
    }

}
