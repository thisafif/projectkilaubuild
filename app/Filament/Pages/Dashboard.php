<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\RecentConsultations;
use App\Filament\Widgets\ProjectProgress;
use App\Filament\Widgets\OngoingMapWidget;
use App\Filament\Widgets\KalenderWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            OngoingMapWidget::class,
            StatsOverview::class,
            ProjectProgress::class,
            RecentConsultations::class,
            KalenderWidget::class,
        ];
    }
}
