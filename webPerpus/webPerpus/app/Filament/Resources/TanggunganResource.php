<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TanggunganResource\Pages;
use App\Filament\Resources\TanggunganResource\RelationManagers;
use App\Models\Tanggungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn; 
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Notifications\Notification; // Import Notifikasi

class TanggunganResource extends Resource
{
    protected static ?string $model = Tanggungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open'; 
    protected static ?string $navigationLabel = 'Tanggungan';
    protected static ?string $pluralModelLabel = 'Tanggungan Perpustakaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Input 1: Pilih Mahasiswa
                Select::make('user_id')
                    ->label('Mahasiswa')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query) => $query->whereNotNull('nim')
                    ),

                // Input 2: Judul Buku
                TextInput::make('judul_buku')
                    ->required()
                    ->maxLength(255)
                    ->label('Judul Buku'),

                // Input 3: Nominal Denda (Auto-calculated from late days)
                TextInput::make('nominal_denda')
                    ->label('Nominal Denda (Rp 5.000/hari terlambat)')
                    ->disabled() // Readonly, dihitung otomatis
                    ->dehydrated(false),

                // Input 4: Durasi Peminjaman (hari)
                TextInput::make('durasi_peminjaman')
                    ->label('Durasi Peminjaman (hari)')
                    ->numeric()
                    ->minValue(1),

                // Input 4: Status Lunas (Toggle Switch)
                Toggle::make('is_paid')
                    ->label('Status Lunas')
                    ->default(false) // Default belum lunas
                    ->onColor('success')
                    ->offColor('danger'),

                // Input 5: Tanggal peminjaman (Full Width di bawah)
                TextInput::make('tanggal_peminjaman')
                    ->label('Tanggal Peminjaman')
                    ->type('date')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordUrl(null)
            ->columns([
                TextColumn::make('user.name')->label('Mahasiswa')->searchable(),
                TextColumn::make('judul_buku')->label('Judul Buku'),
                TextColumn::make('tanggal_peminjaman')->label('Tanggal Peminjaman')->date('d M Y'),
                TextColumn::make('durasi_peminjaman')->label('Durasi (hari)'),
                TextColumn::make('hari_keterlambatan')->label('Hari Terlambat')
                    ->formatStateUsing(fn ($state) => $state > 0 ? "$state hari" : '-'),
                TextColumn::make('nominal_denda')->money('IDR')->label('Denda (Rp 5.000/hari)'),
                
                // Kolom Bukti Pembayaran (Bisa diklik)
                ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti Penyelesaian')
                    ->square()
                    ->disk('public')
                    ->visibility('public')
                    // Menambahkan URL tujuan agar bisa diklik
                    ->url(fn ($record) => $record->bukti_pembayaran ? asset('storage/' . $record->bukti_pembayaran) : null)
                    ->openUrlInNewTab(),

                // Status Lunas/Belum
                IconColumn::make('is_paid')
                    ->boolean()
                    ->label('Lunas?'),
            ])
            ->actions([
                            // Action Verifikasi Pembayaran dengan POPUP GAMBAR
                            Tables\Actions\Action::make('verifikasi_bayar')
                                ->label('Verifikasi Lunas')
                                ->icon('heroicon-o-check')
                                ->color('success')
                                ->requiresConfirmation()
                                
                                // 1. Tambahkan Judul Popup
                                ->modalHeading('Cek Bukti Pembayaran')
                                ->modalSubheading('Pastikan bukti transfer valid sebelum melunaskan denda.')

                                // 2. INI KUNCINYA: Tampilkan View Gambar di dalam Popup
                                // (Menggunakan view yang sama dengan Permohonan sebelumnya)
                                ->modalContent(fn ($record) => view('filament.components.lihat-bukti', ['record' => $record]))

                                // Kondisi muncul tombol
                                ->visible(fn ($record) => $record->bukti_pembayaran && !$record->is_paid)
                                
                                ->action(function ($record) {
                                    $record->update([
                                        'is_paid' => true,
                                        'is_verifying' => false
                                    ]);
                                    
                                    Notification::make()->title('Pembayaran Diverifikasi')->success()->send();
                                }),

                            // Tombol Edit (Tetap ada untuk koreksi data jika perlu)
                            Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListTanggungans::route('/'),
            'create' => Pages\CreateTanggungan::route('/create'),
            'edit' => Pages\EditTanggungan::route('/{record}/edit'),
        ];
    }
}
