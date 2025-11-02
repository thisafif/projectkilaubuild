<?php

namespace App\Filament\Resources\Testimonis\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TestimoniForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Lengkap')
                    ->required()
                    ->placeholder('Masukkan nama lengkap'),
                TextInput::make('teks')
                    ->label('Teks Testimoni Client')
                    ->required()
                    ->placeholder('Masukkan testimoni dari client')
                    ->columnSpan('full'),
                Select::make('rating')
                    ->label('Rating dari Client')
                    ->options([
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ])
                    ->native(false)
                    ->placeholder('Pilih 1-5')
                    ->required(),
                TextInput::make('kegseharihari')
                    ->label('Keseharian/Pekerjaan Client')
                    ->placeholder('Contoh: Ibu Rumah Tangga, Pekerja Kantoran')
                    ->required()
                    ->maxLength(50),
            ]);
    }
}
