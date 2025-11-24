<?php

namespace App\Filament\Resources\KonsultasiResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use App\Filament\Resources\KonsultasiResource;
use App\Filament\Resources\KonsultasiResource\Widgets\KalenderKonsultasi;

class ListKonsultasis extends ListRecords
{
    protected static string $resource = KonsultasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua'),

            'hari_ini' => Tab::make('Hari Ini')
                ->icon('heroicon-m-calendar-days')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('jadwal', fn($q) => $q->whereDate('tanggal', now())))
                ->badge(\App\Models\Konsultasi::whereHas('jadwal', fn($q) => $q->whereDate('tanggal', now()))->count()),

            'perlu_konfirmasi' => Tab::make('Perlu Konfirmasi')
                ->icon('heroicon-m-exclamation-circle')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('jadwal', fn($q) => $q->where('status', 'pending')))
                ->badge(\App\Models\Konsultasi::whereHas('jadwal', fn($q) => $q->where('status', 'pending'))->count())
                ->badgeColor('danger'),

            'terjadwal' => Tab::make('Terjadwal')
                ->icon('heroicon-m-check-circle')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('jadwal', fn($q) => $q->where('status', 'confirmed')))
                ->badge(\App\Models\Konsultasi::whereHas('jadwal', fn($q) => $q->where('status', 'confirmed'))->count())
                ->badgeColor('success'),

            'visit' => Tab::make('Visit Lokasi')
                ->icon('heroicon-m-home')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('jadwal', fn($q) => $q->where('tipe_konsultasi', 'visit')))
                ->badge(\App\Models\Konsultasi::whereHas('jadwal', fn($q) => $q->where('tipe_konsultasi', 'visit'))->count()),

            'online' => Tab::make('Online')
                ->icon('heroicon-m-video-camera')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereHas('jadwal', fn($q) => $q->where('tipe_konsultasi', 'online')))
                ->badge(\App\Models\Konsultasi::whereHas('jadwal', fn($q) => $q->where('tipe_konsultasi', 'online'))->count()),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [
            KalenderKonsultasi::class,
        ];
    }
}
