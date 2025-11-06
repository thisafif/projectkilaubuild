<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class JadwalKonsultasi extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'konsultasi_id',
        'tanggal',
        'tipe_konsultasi',
        'jam',
        'status',
        'catatan_admin',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public function konsultasi(): BelongsTo
    {
        return $this->belongsTo(Konsultasi::class);
    }

    public static function isTanggalTersedia(string $tanggal): bool
    {
        return ! static::query()
            ->whereDate('tanggal', $tanggal)
            ->whereNotIn('status', [self::STATUS_CANCELLED])
            ->exists();
    }

    public static function daftarTanggalTerbooking(?Carbon $awal = null, ?Carbon $akhir = null): array
    {
        $awal = $awal ?? now()->startOfMonth();
        $akhir = $akhir ?? now()->copy()->addMonthsNoOverflow(1)->endOfMonth();

        return static::query()
            ->whereBetween('tanggal', [$awal->toDateString(), $akhir->toDateString()])
            ->whereNotIn('status', [self::STATUS_CANCELLED])
            ->pluck('tanggal')
            ->map(fn ($date) => Carbon::parse($date)->format('Y-m-d'))
            ->unique()
            ->values()
            ->all();
    }
}
