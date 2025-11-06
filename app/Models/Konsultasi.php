<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    ];

    public function jadwal(): HasOne
    {
        return $this->hasOne(JadwalKonsultasi::class);
    }
}
