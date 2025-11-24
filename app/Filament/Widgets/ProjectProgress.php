<?php

namespace App\Filament\Widgets;

use App\Models\Ongoing;
use Filament\Widgets\ChartWidget;

class ProjectProgress extends ChartWidget
{
    protected ?string $heading = 'Progress Proyek';
    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = ['sm' => 'full', 'lg' => 6];

    protected function getData(): array
    {
        $projectsByStatus = Ongoing::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');

        return [
            'datasets' => [
                [
                    'label' => 'Proyek by Status',
                    'data' => [
                        $projectsByStatus->get('consultation', 0),
                        $projectsByStatus->get('planning', 0),
                        $projectsByStatus->get('in_progress', 0),
                        $projectsByStatus->get('done', 0),
                    ],
                    'backgroundColor' => ['#f59e0b', '#3b82f6', '#8b5cf6', '#10b981'],
                ],
            ],
            'labels' => ['Konsultasi', 'Perencanaan', 'Dalam Progres', 'Selesai'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
