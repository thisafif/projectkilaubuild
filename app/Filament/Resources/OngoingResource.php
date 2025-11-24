<?php

namespace App\Filament\Resources;

use App\Filament\Forms\Components\GmapLocation;
use App\Filament\Resources\OngoingResource\Pages;
use App\Models\Ongoing;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class OngoingResource extends Resource
{
    protected static ?string $model = Ongoing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::Truck;

    protected static ?string $modelLabel = 'Proyek';

    protected static ?string $pluralModelLabel = 'Kelola Proyek';

    protected static ?string $navigationLabel = 'Kelola Proyek';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Pelanggan';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. RINGKASAN CLIENT
                Section::make('Ringkasan Client')
                    ->description('Informasi singkat klien dan status terbaru proyek.')
                    ->schema([
                        TextInput::make('client_name')
                            ->label('Nama Klien')
                            ->placeholder('cth: Bagus Setiawan Ankawijaya')
                            ->required()
                            ->maxLength(255)
                            ->columnSpan(1),

                        // TextInput::make('summary_location')
                        //     ->label('Lokasi Singkat Proyek')
                        //     ->placeholder('cth: Citayam, Bogor')
                        //     ->helperText('Ringkasan lokasi: nama komplek, kecamatan, atau kota.')
                        //     ->columnSpan(1),

                        Select::make('status')
                            ->label('Status Proyek')
                            ->placeholder('Pilih status')
                            ->options([
                                'consultation' => 'Konsultasi',
                                'planning' => 'Perencanaan',
                                'in_progress' => 'Dalam Progres',
                                'done' => 'Selesai',
                            ])
                            ->native(false)
                            ->required()
                            ->helperText('Gunakan status yang mewakilkan kondisi proyek saat ini.')
                            ->columnSpan(1),

                        TextInput::make('progress_percentage')
                            ->label('Persentase Progress')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100)
                            ->suffix('%')
                            ->default(1)
                            // ->required()
                            ->helperText('Estimasikan antara 1-100%.')
                            ->columnSpan(1),

                        FileUpload::make('images')
                            ->label('Dokumentasi / Gambar Proyek')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('ongoing-projects')
                            ->helperText('Upload beberapa gambar yang mewakili kondisi atau progres proyek.')
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->columnSpanFull()
                // ->collapsible()
                ,

                // 2. LOKASI PROYEK
                Section::make('Lokasi Proyek (Peta)')
                    ->description('Pilih lokasi proyek lewat peta dengan pencarian alamat, klik pada peta, dan geolokasi.')
                    ->schema([
                        GmapLocation::make('location')
                            ->hiddenLabel()
                            ->helperText(null)
                            ->label('')
                            ->helperText('')
                            ->default([
                                'lat' => -6.444968849424258,
                                'lng' => 106.80404899634287,
                                'formatted_address' => null,
                            ])
                            ->live()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                // ->collapsible()
                ,

                // 2. DESKRIPSI PROYEK
                Section::make('Deskripsi Proyek')
                    ->description('Penjelasan detail mengenai scope, kebutuhan, dan catatan khusus proyek.')
                    ->schema([
                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Tuliskan deskripsi proyek, ruang lingkup pekerjaan, kebutuhan klien, dan catatan lapangan...')
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'link'],
                                ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['undo', 'redo'],
                            ])
                            ->helperText('Gunakan heading (H2/H3) untuk memisahkan bagian seperti "Ruang Lingkup" atau "Catatan Lapangan".')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->collapsible(),

                // 3. TIMELINE & ANGGARAN
                Section::make('[OPSIONAL] Timeline & Anggaran')
                    ->description('Atur jadwal pelaksanaan dan estimasi anggaran proyek.')
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->native(false)
                            // ->required()
                            ->helperText('Tanggal mulai pekerjaan atau awal perencanaan teknis.')
                            ->columnSpan(1),

                        DatePicker::make('expected_end_date')
                            ->label('Target Selesai')
                            ->native(false)
                            // ->required()
                            ->helperText('Tanggal target penyelesaian proyek secara keseluruhan.')
                            ->columnSpan(1),

                        TextInput::make('budget')
                            ->label('Estimasi Budget')
                            ->numeric()
                            ->prefix('Rp')
                            ->helperText('Estimasi total anggaran proyek (boleh berupa kisaran).')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    // ->columnSpanFull()
                    ->collapsible()
                    ->collapsed(),

                // 4. KONTAK & KOLABORASI VENDOR
                Section::make('[OPSIONAL] Kontak & Kolaborasi Vendor')
                    ->description('Data PIC utama dan vendor / subkon yang terlibat.')
                    ->schema([
                        TextInput::make('pic_name')
                            ->label('Nama PIC')
                            ->placeholder('cth: Bapak Andi Pratama')
                            ->maxLength(255)
                            ->columnSpan(1),

                        TextInput::make('pic_phone')
                            ->label('Nomor Kontak PIC')
                            ->placeholder('cth: 0812xxxxxxx')
                            ->tel()
                            ->maxLength(20)
                            ->helperText('Isi nomor yang aktif, idealnya yang terhubung ke WhatsApp.')
                            ->columnSpan(1),

                        Textarea::make('vendors')
                            ->label('Vendor / Kolaborator')
                            ->placeholder('cth: Vendor baja ringan, subkon struktur, konsultan MEP, dsb.')
                            ->rows(3)
                            ->helperText('Opsional. Diisi bila ada pihak ketiga penting yang perlu dicatat.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    // ->columnSpanFull()
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('client_name')
                    ->label('Nama Klien')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'consultation' => 'Konsultasi',
                        'planning' => 'Perencanaan',
                        'in_progress' => 'Dalam Progres',
                        'done' => 'Selesai',
                        default => $state,
                    })
                    ->sortable(),

                TextColumn::make('progress_percentage')
                    ->label('Progress')
                    ->suffix('%')
                    ->sortable(),

                TextColumn::make('summary_location')
                    ->label('Lokasi')
                    ->searchable(),

                TextColumn::make('start_date')
                    ->label('Mulai')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('expected_end_date')
                    ->label('Target Selesai')
                    ->date('d M Y')
                    ->sortable(),
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
            ])
            ->defaultSort('start_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOngoings::route('/'),
            'create' => Pages\CreateOngoing::route('/create'),
            'edit' => Pages\EditOngoing::route('/{record}/edit'),
        ];
    }
}
