<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClearanceResource\Pages;
use App\Models\Clearance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClearanceResource extends Resource
{
    protected static ?string $model = Clearance::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Validasi Fakultas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 1. PERBAIKAN: Menampilkan NIM & Prodi dengan Jelas
                Forms\Components\Section::make('Identitas Mahasiswa')
                    ->schema([
                        Forms\Components\Placeholder::make('nama_mhs')
                            ->label('Nama Lengkap')
                            ->content(fn (Clearance $record) => $record->user->name ?? '-'),

                        Forms\Components\Placeholder::make('nim_mhs')
                            ->label('NIM')
                            ->content(fn (Clearance $record) => $record->user->nim ?? '-'),

                        Forms\Components\Placeholder::make('prodi_mhs')
                            ->label('Program Studi')
                            ->content(fn (Clearance $record) => $record->user->prodi ?? '-'),
                    ])->columns(3),

                // ... (Bagian Verifikasi Berkas & Keputusan sama seperti sebelumnya) ...
                Forms\Components\Section::make('Verifikasi Berkas')
                    ->schema([
                        Forms\Components\FileUpload::make('file_lab')
                            ->label('1. Bebas Lab')->disk('public')->openable()->downloadable()->disabled()->dehydrated(false),
                        Forms\Components\FileUpload::make('file_library')
                            ->label('2. Bebas Perpus')->disk('public')->openable()->downloadable()->disabled()->dehydrated(false),
                        Forms\Components\FileUpload::make('file_finance')
                            ->label('3. Bukti UKT')->disk('public')->openable()->downloadable()->disabled()->dehydrated(false),
                    ])->columns(3),

                Forms\Components\Section::make('Keputusan Fakultas')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->required()->live()->native(false),

                        Forms\Components\Placeholder::make('info_surat')
                            ->label('Surat Keterangan')
                            ->content('Surat akan otomatis dibuat oleh sistem dan dikirim ke email saat Anda mengubah status menjadi "Disetujui".')
                            ->visible(fn (Forms\Get $get) => $get('status') !== 'approved'),

                        Forms\Components\Textarea::make('admin_note')
                            ->label('Catatan Penolakan')
                            ->visible(fn (Forms\Get $get) => $get('status') === 'rejected'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 2. PERBAIKAN: Menambah Kolom NIM & Prodi di Tabel Depan
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.nim')
                    ->label('NIM')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.prodi')
                    ->label('Prodi')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors(['warning' => 'pending', 'success' => 'approved', 'danger' => 'rejected']),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }
    
    // ... getPages() tetap sama ...
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClearances::route('/'),
            'create' => Pages\CreateClearance::route('/create'),
            'edit' => Pages\EditClearance::route('/{record}/edit'),
        ];
    }
}