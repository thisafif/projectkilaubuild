<?php

namespace App\Filament\Resources\Tims\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class TimsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('indeks')
                    ->label('Indeks (Urutan Tampil)')
                    ->sortable(),
                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->sortable(),
                TextColumn::make('posisi')
                    ->sortable(),
                TextColumn::make('linkedin')
                    ->label('Link LinkedIn'),
                ImageColumn::make('attechment_tim')
                    ->label('Foto Profil')
                    ->imageSize(70)
                    ->circular(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
