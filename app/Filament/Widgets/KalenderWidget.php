<?php

namespace App\Filament\Widgets;

use App\Models\JadwalKonsultasi;
use App\Filament\Resources\KonsultasiResource;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class KalenderWidget extends FullCalendarWidget
{
    public Model | string | int | null $record = null;
    public Model | string | null $model = JadwalKonsultasi::class;

    protected static ?int $sort = 5;

    public function fetchEvents(array $fetchInfo): array
    {
        try {
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
        } catch (\Exception $e) {
            return [];
        }
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

    protected function modalActions(): array
    {
        return [];
    }
}
