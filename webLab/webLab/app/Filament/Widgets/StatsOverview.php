<?php

namespace App\Filament\Widgets;

use App\Models\Permohonan;
use App\Models\Tanggungan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat 1: Permohonan Perlu Verifikasi (Penting buat Admin)
            Stat::make('Verifikasi Pembayaran', Permohonan::where('status', 'payment_review')->count())
                ->description('Menunggu dicek')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            // Stat 2: Total Mahasiswa Bebas Lab
            Stat::make('Surat Diterbitkan', Permohonan::where('status', 'approved')->count())
                ->description('Mahasiswa bebas tanggungan')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            // Stat 3: Total Uang Denda Masuk (Opsional)
            Stat::make('Total Denda Lunas', 'Rp ' . number_format(Tanggungan::where('is_paid', true)->sum('nominal_denda'), 0, ',', '.'))
                ->description('Pemasukan denda alat')
                ->color('primary'),
        ];
    }
}