<?php

namespace App\Filament\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use App\Models\JadwalKonsultasi;
use App\Filament\Resources\KonsultasiResource;

class KalenderKonsultasiWidget extends FullCalendarWidget
{
    protected static ?int $sort = 2;

    protected static ?string $maxContentWidth = 'none';

    public function getColumnSpan(): int|string|array
    {
        return 'md:6';
    }

    public function fetchEvents(array $fetchInfo): array
    {
        return JadwalKonsultasi::query()
            ->where('tanggal', '>=', $fetchInfo['start'])
            ->where('tanggal', '<=', $fetchInfo['end'])
            ->with('konsultasi')
            ->get()
            ->map(function (JadwalKonsultasi $record) {
                return [
                    'id'    => $record->id,
                    'title' => ($record->konsultasi?->nama ?? 'Konsultasi') . ' - ' . $record->jam,
                    'start' => \Illuminate\Support\Carbon::parse($record->tanggal)->format('Y-m-d'),
                    'backgroundColor' => match ($record->tipe_konsultasi) {
                        'visit'  => '#eff6ff',
                        'online' => '#f0fdf4',
                        default  => '#f8fafc',
                    },
                    'borderColor' => match ($record->tipe_konsultasi) {
                        'visit'  => '#3b82f6',
                        'online' => '#22c55e',
                        default  => '#64748b',
                    },
                    'textColor' => match ($record->tipe_konsultasi) {
                        'visit'  => '#1e40af',
                        'online' => '#166534',
                        default  => '#334155',
                    },
                    'allDay' => true,
                    'url' => KonsultasiResource::getUrl('edit', ['record' => $record->konsultasi?->id]),
                ];
            })
            ->all();
    }

    public function config(): array
    {
        return [
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,listWeek',
            ],
            'initialView' => 'dayGridMonth',
            'dayMaxEvents' => 2,
            'navLinks' => true,
            'buttonText' => [
                'today' => 'Hari Ini',
                'month' => 'Kalender',
                'list' => 'Agenda',
            ],
            'eventTimeFormat' => [
                'hour' => '2-digit',
                'minute' => '2-digit',
                'meridiem' => false,
                'hour12' => false
            ],
        ];
    }

    protected function headerActions(): array
    {
        return [];
    }
}
