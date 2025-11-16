<?php

namespace App\Filament\Resources;

use BackedEnum;
use Filament\Forms;
use Filament\Tables;
use App\Models\Konsultasi;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Illuminate\Support\Carbon;
use App\Models\JadwalKonsultasi;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
// use Filament\Forms\Components\Group;
// use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Schemas\Components\Section;
use App\Filament\Resources\KonsultasiResource\Pages;


class KonsultasiResource extends Resource
{
    protected static ?string $model = Konsultasi::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chat-bubble-left';

    protected static ?string $navigationLabel = 'Kelola Konsultasi';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('nama')
                ->label('Nama Lengkap')
                ->required(),

            Forms\Components\TextInput::make('no_wa')
                ->label('Nomor WhatsApp')
                ->required()
                ->prefix('62')
                ->tel(),

            Forms\Components\Select::make('provinsi')
                ->label('Provinsi')
                ->required()
                ->options(
                    fn() => DB::table('indonesia_provinces')
                        ->pluck('name', 'name')
                        ->toArray()
                )
                ->searchable()
                ->live(),

            Forms\Components\Select::make('kabupatenkota')
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

            Forms\Components\Select::make('kecamatan')
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

            Forms\Components\Select::make('jenis_konsultasi')
                ->label('Jenis Konsultasi')
                ->required()
                ->options([
                    'bgnrumah_renovasi' => 'Bangun Rumah & Renovasi',
                    'maintenance' => 'Maintenance Rumah',
                    'desain_interior' => 'Desain Arsitektural & Interior',
                    'lainnya' => 'Lainnya',
                ]),

            Forms\Components\Textarea::make('detil_konsultasi')
                ->label('Detail Konsultasi')
                ->required(),

            Section::make('Jadwal Konsultasi')
                ->relationship('jadwal')
                ->schema([
                    Forms\Components\Select::make('tipe_konsultasi')
                        ->label('Tipe Konsultasi')
                        ->required()
                        ->options([
                            'visit' => 'Kunjungan Lokasi',
                            'online' => 'Konsultasi Online',
                        ]),

                    Forms\Components\DatePicker::make('tanggal')
                        ->label('Tanggal Konsultasi')
                        ->required()
                        ->minDate(now()->addDay()),

                    Forms\Components\TextInput::make('jam')
                        ->label('Sesi')
                        ->placeholder('Contoh: Sesi 1')
                        ->required()
                        ->regex('/^Sesi \d+$/')
                        ->helperText('Format: Sesi X (contoh: Sesi 1, Sesi 2)'),

                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->required()
                        ->native(false)
                        ->options([
                            JadwalKonsultasi::STATUS_PENDING => 'Pending',
                            JadwalKonsultasi::STATUS_CONFIRMED => 'Confirmed',
                            JadwalKonsultasi::STATUS_CANCELLED => 'Cancelled',
                        ]),

                    Forms\Components\Textarea::make('catatan_admin')
                        ->label('Catatan Admin')
                        ->rows(3),
                ])
                ->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('no_wa')
                    ->label('No. WhatsApp')
                    ->searchable(),

                Tables\Columns\TextColumn::make('provinsi')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kabupatenkota')
                    ->label('Kabupaten/Kota')
                    ->searchable(),

                Tables\Columns\TextColumn::make('jenis_konsultasi')
                    ->label('Jenis')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jadwal.tanggal')
                    ->label('Tanggal Konsultasi')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jadwal.tipe_konsultasi')
                    ->label('Tipe')
                    ->badge()
                    ->formatStateUsing(
                        fn($state) => $state === 'visit'
                            ? 'Kunjungan Lokasi'
                            : 'Konsultasi Online'
                    )
                    ->color(
                        fn($state) => $state === 'visit' ? 'info' : 'primary'
                    )
                    ->sortable(),

                Tables\Columns\TextColumn::make('jadwal.jam')
                    ->label('Sesi')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jadwal.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(?string $state): string => match ($state) {
                        JadwalKonsultasi::STATUS_CONFIRMED => 'success',
                        JadwalKonsultasi::STATUS_CANCELLED => 'danger',
                        default => 'warning',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_konsultasi')
                    ->label('Jenis Konsultasi')
                    ->options([
                        'bgnrumah_renovasi' => 'Bangun Rumah & Renovasi',
                        'maintenance' => 'Maintenance Rumah',
                        'desain_interior' => 'Desain Arsitektural & Interior',
                        'lainnya' => 'Lainnya',
                    ]),

                Tables\Filters\SelectFilter::make('jadwal_status')
                    ->label('Status Jadwal')
                    ->relationship('jadwal', 'status')
                    ->options([
                        JadwalKonsultasi::STATUS_PENDING => 'Pending',
                        JadwalKonsultasi::STATUS_CONFIRMED => 'Confirmed',
                        JadwalKonsultasi::STATUS_CANCELLED => 'Cancelled',
                    ]),
            ])
            ->recordActions([
                Action::make('whatsapp')
                    ->label('WhatsApp')
                    ->icon('heroicon-m-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->button()
                    ->url(
                        fn(Konsultasi $record) =>
                        self::buatWhatsappUrl($record)
                    )
                    ->openUrlInNewTab()
                    ->visible(
                        fn(Konsultasi $record) =>
                        filled($record->no_wa)
                    ),

                EditAction::make(),
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
