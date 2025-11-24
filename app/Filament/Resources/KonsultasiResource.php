<?php

namespace App\Filament\Resources;

use UnitEnum;
use BackedEnum;
use Filament\Tables;
use App\Models\Konsultasi;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use App\Models\JadwalKonsultasi;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
// use Filament\Forms\Components\Group;
// use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\DB;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\KonsultasiResource\Pages;

class KonsultasiResource extends Resource
{
    protected static ?string $model = Konsultasi::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeftEllipsis;

    protected static string|BackedEnum|null $activeNavigationIcon = Heroicon::ChatBubbleLeftEllipsis;

    protected static ?string $navigationLabel = 'Kelola Konsultasi';

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Pelanggan';

    protected static ?string $modelLabel = 'Konsultasi';

    protected static ?string $pluralModelLabel = 'Kelola Konsultasi';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereHas('jadwal', function ($query) {
            $query->where('status', JadwalKonsultasi::STATUS_PENDING);
        })->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Konsultasi Pending';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Informasi Pemohon')
                ->description('Informasi singkat pemohon konsultasi.')
                ->schema([
                    TextInput::make('nama')
                        ->label('Nama Lengkap')
                        ->required(),

                    TextInput::make('no_wa')
                        ->label('Nomor WhatsApp')
                        ->required()
                        ->prefix('62')
                        ->tel(),
                ])
                ->columnSpanFull(),

            Section::make('Lokasi & Jenis Konsultasi')
                ->schema([
                    Select::make('provinsi')
                        ->label('Provinsi')
                        ->required()
                        ->options(
                            fn() => DB::table('indonesia_provinces')
                                ->pluck('name', 'name')
                                ->toArray()
                        )
                        ->searchable()
                        ->live(),

                    Select::make('kabupatenkota')
                        ->label('Kabupaten/Kota')
                        ->required()
                        ->options(function ($get) {
                            $provinsi = $get('provinsi');
                            if (! $provinsi) {
                                return [];
                            }

                            return DB::table('indonesia_cities')
                                ->whereIn('province_code', DB::table('indonesia_provinces')
                                    ->where('name', $provinsi)
                                    ->pluck('code'))
                                ->pluck('name', 'name')
                                ->toArray();
                        })
                        ->searchable()
                        ->live(),

                    Select::make('kecamatan')
                        ->label('Kecamatan')
                        ->required()
                        ->options(function ($get) {
                            $kabupaten = $get('kabupatenkota');
                            if (! $kabupaten) {
                                return [];
                            }

                            return DB::table('indonesia_districts')
                                ->whereIn('city_code', DB::table('indonesia_cities')
                                    ->where('name', $kabupaten)
                                    ->pluck('code'))
                                ->pluck('name', 'name')
                                ->toArray();
                        })
                        ->searchable(),

                    Select::make('jenis_konsultasi')
                        ->label('Jenis Konsultasi')
                        ->required()
                        ->options([
                            'bgnrumah_renovasi' => 'Bangun Rumah & Renovasi',
                            'maintenance' => 'Maintenance Rumah',
                            'desain_interior' => 'Desain Arsitektural & Interior',
                            'lainnya' => 'Lainnya',
                        ])
                        ->native(false),

                    Textarea::make('detil_konsultasi')
                        ->label('Detail Konsultasi')
                        ->required()
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Jadwal Konsultasi')
                ->relationship('jadwal')
                ->schema([
                    Select::make('tipe_konsultasi')
                        ->label('Tipe Konsultasi')
                        ->required()
                        ->options([
                            'visit' => 'Kunjungan Lokasi',
                            'online' => 'Konsultasi Online',
                        ])
                        ->native(false),

                    DatePicker::make('tanggal')
                        ->label('Tanggal Konsultasi')
                        ->required()
                        // ->minDate(now()->addDay())
                        ->native(false),

                    TextInput::make('jam')
                        ->label('Sesi')
                        ->placeholder('Contoh: Sesi 1')
                        ->required()
                        ->regex('/^Sesi \d+$/')
                        ->helperText('Format: Sesi X (contoh: Sesi 1, Sesi 2)'),

                    Select::make('status')
                        ->label('Status')
                        ->required()
                        ->native(false)
                        ->options([
                            JadwalKonsultasi::STATUS_PENDING => 'Pending',
                            JadwalKonsultasi::STATUS_CONFIRMED => 'Confirmed',
                            JadwalKonsultasi::STATUS_CANCELLED => 'Cancelled',
                        ])
                        ->native(false),

                    Textarea::make('catatan_admin')
                        ->label('Catatan Admin')
                        ->rows(3)
                        ->columnSpanFull(),
                ])
                ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Konsultasi $record) => $record->no_wa),

                TextColumn::make('jenis_konsultasi')
                    ->label('Jenis')
                    ->badge()
                    ->formatStateUsing(fn($state) => match($state) {
                        'bgnrumah_renovasi' => 'Bangun & Renovasi',
                        'maintenance' => 'Maintenance',
                        'desain_interior' => 'Interior',
                        default => 'Lainnya'
                    })
                    ->color(fn($state) => match($state) {
                        'bgnrumah_renovasi' => 'info',
                        'maintenance' => 'warning',
                        'desain_interior' => 'success',
                        default => 'gray'
                    })
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jadwal.tipe_konsultasi')
                    ->label('Tipe Konsultasi')
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => $state === 'visit'
                            ? 'Kunjungan Lokasi'
                            : 'Online'
                    )
                    ->color(
                        fn($state) => $state === 'visit' ? 'info' : 'success'
                    )
                    ->sortable(),

                TextColumn::make('jadwal.tanggal')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),

                TextColumn::make('jadwal.jam')
                    ->label('Sesi')
                    ->sortable(),

                TextColumn::make('jadwal.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(?string $state): string => match ($state) {
                        JadwalKonsultasi::STATUS_CONFIRMED => 'success',
                        JadwalKonsultasi::STATUS_CANCELLED => 'warning',
                        default => 'danger',
                    })
                    ->sortable(),

                TextColumn::make('kabupatenkota')
                    ->label('Lokasi')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Pengajuan')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('jenis_konsultasi')
                    ->label('Jenis Konsultasi')
                    ->options([
                        'bgnrumah_renovasi' => 'Bangun Rumah & Renovasi',
                        'maintenance' => 'Maintenance Rumah',
                        'desain_interior' => 'Desain Arsitektural & Interior',
                        'lainnya' => 'Lainnya',
                    ]),

                SelectFilter::make('jadwal_status')
                    ->label('Status Jadwal')
                    ->relationship('jadwal', 'status')
                    ->options([
                        JadwalKonsultasi::STATUS_PENDING => 'Pending',
                        JadwalKonsultasi::STATUS_CONFIRMED => 'Confirmed',
                        JadwalKonsultasi::STATUS_CANCELLED => 'Cancelled',
                    ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-chat-bubble-oval-left-ellipsis')
                    ->color('success')
                    ->button()
                    ->url(
                        fn(Konsultasi $record) => self::buatWhatsappUrl($record)
                    )
                    ->openUrlInNewTab()
                    ->visible(
                        fn(Konsultasi $record) => filled($record->no_wa)
                    ),

                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKonsultasis::route('/'),
            'create' => Pages\CreateKonsultasi::route('/create'),
            'edit' => Pages\EditKonsultasi::route('/{record}/edit'),
        ];
    }

    protected static function buatWhatsappUrl(Konsultasi $record): string
    {
        $jadwal = $record->jadwal;

        $tanggalFormatted =
            $jadwal && $jadwal->tanggal
            ? Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y')
            : '-';

        $sesi = $jadwal?->jam ?? '-';
        $status = $jadwal?->status ?? JadwalKonsultasi::STATUS_PENDING;

        $pesan =
            "Halo {$record->nama},\n\n" .
            "Saya dari Kilau Build.\n" .
            'Status konsultasi Anda: ' . ucfirst($status) . "\n" .
            "Tanggal konsultasi: {$tanggalFormatted}\n" .
            "Sesi: {$sesi}\n" .
            "Lokasi tercatat: {$record->kecamatan}, {$record->kabupatenkota}, {$record->provinsi}.\n\n" .
            'Silakan balas pesan ini jika ada penyesuaian. Terima kasih.';

        $nomor = preg_replace('/[^0-9]/', '', $record->no_wa);

        return 'https://wa.me/' . $nomor . '?text=' . urlencode($pesan);
    }
}
