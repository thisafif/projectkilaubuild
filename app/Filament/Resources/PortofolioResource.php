<?php

namespace App\Filament\Resources;

use App\Models\Portofolio;
use BackedEnum;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\PortofolioResource\Pages;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;

class PortofolioResource extends Resource
{
    protected static ?string $model = Portofolio::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('judul')
                ->required(),

            TextInput::make('deskripsi_singkat')
                ->required(),

            TextInput::make('deskripsi_lengkap'),

            Select::make('tipe')
                ->required()
                ->options([
                    'bangun_baru' => 'Bangun Baru',
                    'renovasi'    => 'Renovasi',
                    'interior'    => 'Interior',
                ]),

            DatePicker::make('tanggal_proyek')
                ->required()
                ->native(false),

            FileUpload::make('attachmentportofolio')
                ->label('Foto Portofolio')
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

                TextColumn::make('deskripsi_singkat'),

                TextColumn::make('deskripsi_lengkap'),

                TextColumn::make('tipe'),

                TextColumn::make('tanggal_proyek')
                    ->date(),

                ImageColumn::make('attachmentportofolio')
                    ->label('Foto Portofolio'),
            ])
            ->filters([])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPortofolios::route('/'),
            'create' => Pages\CreatePortofolio::route('/create'),
            'edit'   => Pages\EditPortofolio::route('/{record}/edit'),
        ];
    }
}
