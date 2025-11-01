<?php

namespace App\Filament\Resources\Testimonis;

use App\Filament\Resources\Testimonis\Pages\CreateTestimoni;
use App\Filament\Resources\Testimonis\Pages\EditTestimoni;
use App\Filament\Resources\Testimonis\Pages\ListTestimonis;
use App\Filament\Resources\Testimonis\Pages\ViewTestimoni;
use App\Filament\Resources\Testimonis\Schemas\TestimoniForm;
use App\Filament\Resources\Testimonis\Schemas\TestimoniInfolist;
use App\Filament\Resources\Testimonis\Tables\TestimonisTable;
use App\Models\Testimoni;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class TestimoniResource extends Resource
{
    protected static ?string $model = Testimoni::class;
    protected static ?string $title = 'Testimoni';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static ?string $navigationLabel = 'Kelola Testimoni';
    protected static string | UnitEnum | null $navigationGroup = 'Kelola Konten';
    public static function form(Schema $schema): Schema
    {
        return TestimoniForm::configure($schema);
    }
    public static function getPluralModelLabel(): string
    {
        return 'Kelola Testimoni'; 
    }
    public static function infolist(Schema $schema): Schema
    {
        return TestimoniInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TestimonisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTestimonis::route('/'),
            'create' => CreateTestimoni::route('/create'),
            'view' => ViewTestimoni::route('/{record}'),
            'edit' => EditTestimoni::route('/{record}/edit'),
        ];
    }
}
