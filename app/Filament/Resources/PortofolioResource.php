<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Portofolio;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PortofolioResource\Pages;
use App\Filament\Resources\PortofolioResource\RelationManagers;
use App\Filament\Resources\PortofolioResource\Pages\EditPortofolio;
use App\Filament\Resources\PortofolioResource\Pages\ListPortofolios;
use App\Filament\Resources\PortofolioResource\Pages\CreatePortofolio;

class PortofolioResource extends Resource
{
    protected static ?string $model = Portofolio::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('judul')->required(),
                TextInput::make('deskripsi_singkat')->required(),
                TextInput::make('deskripsi_lengkap'),
                Select::make('tipe')
                    ->required()
                    ->options([
                        'bangun_baru' => 'Bangun Baru',
                        'renovasi' => 'Renovasi',
                        'interior' => 'Interior',
                    ]),
                DatePicker::make('tanggal_proyek')->required()->native(false),
                FileUpload::make('attachmentportofolio')
                    ->label('Foto Portofolio')
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '16:9',
                        '4:3',
                        '1:1',
                        '3:4',
                        '9:16',
                        null])
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
                ->label('Foto Porotofolio'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPortofolios::route('/'),
            'create' => Pages\CreatePortofolio::route('/create'),
            'edit' => Pages\EditPortofolio::route('/{record}/edit'),
        ];
    }
}
