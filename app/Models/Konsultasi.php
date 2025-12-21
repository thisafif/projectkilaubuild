<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property-read JadwalKonsultasi|null $jadwal
 */
class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_wa',
        'provinsi',
        'kabupatenkota',
        'kecamatan',
        'jenis_konsultasi',
        'detil_konsultasi',
        'user_id'
    ];

    public function jadwal(): HasOne
    {
        return $this->hasOne(JadwalKonsultasi::class);
    }

        public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
