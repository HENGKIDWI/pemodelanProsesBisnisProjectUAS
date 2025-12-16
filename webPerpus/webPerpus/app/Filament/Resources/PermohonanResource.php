<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanResource\Pages;
use App\Models\Permohonan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PermohonanResource extends Resource
{
    protected static ?string $model = Permohonan::class;

    // Ganti icon agar beda dengan tanggungan
    protected static ?string $navigationIcon = 'heroicon-o-document-check'; 
    protected static ?string $navigationLabel = 'Arsip Surat';
    protected static ?string $pluralModelLabel = 'Arsip Surat Bebas Perpustakaan';

    public static function form(Form $form): Form
    {
        return $form->schema([]); // Kosongkan, karena tidak ada edit manual
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Nama Mahasiswa
                TextColumn::make('user.name')
                    ->label('Mahasiswa')
                    ->searchable()
                    ->sortable(),

                // 2. NIM
                TextColumn::make('user.nim')
                    ->label('NIM')
                    ->searchable(),

                // 3. Status (Pasti Approved semua)
                TextColumn::make('status')
                    ->badge()
                    ->color('success')
                    ->label('Status'),

                // 4. Tanggal Terbit Surat
                TextColumn::make('created_at')
                    ->label('Tanggal Terbit')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // Hanya tombol hapus jika admin ingin membersihkan history
                Tables\Actions\DeleteAction::make(), 
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermohonans::route('/'),
        ];
    }
}