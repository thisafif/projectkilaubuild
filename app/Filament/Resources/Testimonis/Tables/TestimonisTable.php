<?php

namespace App\Filament\Resources\Testimonis\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class TestimonisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->searchable()
                    ->label('Nama Lengkap'),
                TextColumn::make('teks')
                    ->searchable()
                    ->label('Testimoni'),
                TextColumn::make('rating')
                    ->searchable()
                    ->label('Rating (1-5)'),
                TextColumn::make('kegseharihari')
                    ->searchable()
                    ->label('Pekerjaan Client'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])
            ])
            ->emptyStateActions([
                Action::make('create')
                    ->label('Tambah Testimoni')
                    ->url(\App\Filament\Resources\Testimonis\TestimoniResource::getUrl('create'))
                    ->icon('heroicon-m-plus')
                    ->button(),
            ])
            ->emptyStateHeading('Belum ada Testimoni')
            ->emptyStateDescription('Ayo tambah testimoni untuk menambahkan kepercayaan customer!');
    }
}
