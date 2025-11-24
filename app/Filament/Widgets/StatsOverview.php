<?php

namespace App\Filament\Widgets;

use App\Models\Konsultasi;
use App\Models\JadwalKonsultasi;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Konsultasi', Konsultasi::count())
                ->description('Semua konsultasi')
                ->descriptionIcon('heroicon-m-chat-bubble-oval-left-ellipsis')
                ->color('primary'),

            Stat::make('Jadwal Pending', JadwalKonsultasi::where('status', 'pending')->count())
                ->description('Perlu konfirmasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Jadwal Confirmed', JadwalKonsultasi::where('status', 'confirmed')->count())
                ->description('Sudah dikonfirmasi')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Jadwal Dibatalkan', JadwalKonsultasi::where('status', 'cancelled')->count())
                ->description('Sudah dibatalkan')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
