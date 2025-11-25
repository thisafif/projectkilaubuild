<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArtikelResource\Pages;
use App\Models\Artikel;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class ArtikelResource extends Resource
{
    protected static ?string $model = Artikel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::Newspaper;

    protected static ?string $navigationLabel = 'Kelola Artikel';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('judul')->required(),
            RichEditor::make('isi')->required()
                ->toolbarButtons([
                    ['bold', 'italic', 'underline', 'strike', 'link'],
                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                    ['undo', 'redo'],
                ]),
            TextInput::make('penulis')->required(),
            DatePicker::make('tanggal_publikasi')
                ->required()
                ->native(false),
            FileUpload::make('attachmentartikel')
                ->label('Foto Artikel')
                ->imageEditor()
                ->imageEditorAspectRatios([
                    '16:9',
                    '4:3',
                    '1:1',
                    '3:4',
                    '9:16',
                    null,
                ])
                ->image(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul'),
                TextColumn::make('isi'),
                TextColumn::make('penulis'),
                TextColumn::make('tanggal_publikasi')
                    ->date(),
                ImageColumn::make('attachmentartikel')
                    ->label('Foto Artikel'),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArtikels::route('/'),
            'create' => Pages\CreateArtikel::route('/create'),
            'edit' => Pages\EditArtikel::route('/{record}/edit'),
        ];
    }
}
