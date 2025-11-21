<?php

namespace App\Filament\Resources\Tims\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class TimForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('indeks')
                ->label('Indeks (Urutan Tampil)')
                ->required()
                ->numeric()
                ->unique(),

            TextInput::make('nama_lengkap')
                ->label('Nama Lengkap')
                ->required()
                ->maxLength(255),

            TextInput::make('posisi')
                ->required()
                ->maxLength(255),

            TextInput::make('linkedin')
                ->label('Link LinkedIn')
                ->url()
                ->maxLength(255),

            FileUpload::make('attechment_tim')
                ->label('Foto Profil')
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '1:1',
                    null,
                ])
                ->image()
                ->required(),
        ]);
    }
}
