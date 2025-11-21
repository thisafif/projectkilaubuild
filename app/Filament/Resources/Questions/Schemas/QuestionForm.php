<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('pertanyaan')
                    ->label('Pertanyaan')
                    ->autosize()
                    ->required(),
                Textarea::make('jawaban')
                    ->label('Jawaban')
                    ->autosize()
                    ->required(),
            ]);
    }
}
