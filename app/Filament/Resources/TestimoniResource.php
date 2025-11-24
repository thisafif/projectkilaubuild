<?php

namespace App\Filament\Resources;

use UnitEnum;
use BackedEnum;
use Filament\Forms;
use Filament\Tables;
use App\Models\Testimoni;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Tables\Grouping\Group;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\TestimoniResource\Pages;

class TestimoniResource extends Resource
{
    protected static ?string $model = Testimoni::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::Star;

    protected static ?string $navigationLabel = 'Kelola Testimoni';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('kegseharihari')
                ->label('Kegiatan/Pekerjaan Client')
                ->maxLength(255),

            Forms\Components\Textarea::make('teks')
                ->label('Testimoni')
                ->required(),

            Forms\Components\TextInput::make('rating')
                ->label('Rating')
                ->numeric()
                ->minValue(1)
                ->maxValue(5),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->weight('lg')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('rating')
                    ->badge() 
                    ->color(fn(string $state): string => match ($state) {
                        '5' => 'success', 
                        '4' => 'info',    
                        '3' => 'warning', 
                        default => 'danger',
                    })
                    ->icon('heroicon-m-star')
                    ->sortable(),

                TextColumn::make('teks')
                    ->label('Testimoni')
                    ->limit(30)
                    ->wrap(),

                TextColumn::make('kegseharihari')
                    ->label('Kegiatan/Pekerjaan Client')
                    ->limit(30)
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date('M d, Y') 
                    ->color('gray')
                    ->sortable(),
            ])

            // ->groups([
            //     Group::make('rating')
            //         ->label('Rating Bintang')
            //         ->collapsible(),
            //     Group::make('created_at')
            //         ->label('Tanggal Dibuat')
            //         ->date(),
            // ])
            // ->defaultGroup('rating')

            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListTestimonis::route('/'),
            // 'create' => Pages\CreateTestimoni::route('/create'),
            // 'view'   => Pages\ViewTestimoni::route('/{record}'),
            // 'edit'   => Pages\EditTestimoni::route('/{record}/edit'),
        ];
    }
}
