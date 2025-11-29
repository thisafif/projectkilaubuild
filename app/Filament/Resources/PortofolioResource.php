<?php

namespace App\Filament\Resources;

use UnitEnum;
use BackedEnum;
use App\Models\Portofolio;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Actions\DeleteAction;
use Filament\Support\Icons\Heroicon;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\PortofolioResource\Pages;

class PortofolioResource extends Resource
{
    protected static ?string $model = Portofolio::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::HomeModern;

    protected static ?string $navigationLabel = 'Kelola Portofolio';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Dasar')
                ->description('Judul, deskripsi singkat, dan deskripsi lengkap portofolio')
                ->columns(1)
                ->columnSpanFull()
                ->schema([
                    TextInput::make('judul')
                        ->required()
                        ->columnSpanFull(),

                    TextInput::make('deskripsi_singkat')
                        ->required()
                        ->columnSpanFull(),

                    RichEditor::make('deskripsi_lengkap')
                        ->label('Deskripsi Lengkap')
                        ->columnSpanFull()
                        ->toolbarButtons([
                            ['bold', 'italic', 'underline', 'strike', 'link'],
                            ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                            ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                            ['undo', 'redo'],
                        ]),

                    Section::make('Detail Proyek')
                        ->description('Tipe, tanggal, dan media proyek')
                        ->columns(2)
                        ->columnSpanFull()
                        ->schema([
                            Select::make('tipe')
                                ->required()
                                ->options([
                                    'bangun_baru' => 'Bangun Baru',
                                    'renovasi' => 'Renovasi',
                                    'interior' => 'Interior',
                                ])
                                ->native(false),

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
                                ->image()
                                ->columnSpanFull()
                                ->visibility('public'),
                        ]),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('attachmentportofolio')
                    ->label('Foto')
                    ->square()
                    ->size(60),

                TextColumn::make('judul')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Portofolio $record) => $record->deskripsi_singkat),

                TextColumn::make('tipe')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'bangun_baru' => 'info',
                        'renovasi' => 'warning',
                        'interior' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('tanggal_proyek')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
            ])
            ->filters([])
            ->defaultSort('tanggal_proyek', 'desc')

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
            'index' => Pages\ListPortofolios::route('/'),
            'create' => Pages\CreatePortofolio::route('/create'),
            'edit' => Pages\EditPortofolio::route('/{record}/edit'),
        ];
    }
}
