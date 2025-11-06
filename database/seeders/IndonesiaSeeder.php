<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndonesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kode provinsi yang diizinkan:
        // 36 = Jawa Timur
        // 35 = Jawa Tengah
        // 34 = DI Yogyakarta
        // 33 = Jawa Barat
        // 32 = Jawa Tengah (duplikat? akan cek)
        // 31 = Banten
        // 51 = Bali

        $allowedProvinceCodes = ['31', '32', '33', '34', '35', '36', '51'];

        // Hapus data dari tabel terkait di luar provinsi target
        DB::statement("
            DELETE FROM indonesia_villages
            WHERE district_code IN (
                SELECT code FROM indonesia_districts
                WHERE city_code IN (
                    SELECT code FROM indonesia_cities
                    WHERE province_code NOT IN ('".implode("','", $allowedProvinceCodes)."')
                )
            )
        ");

        DB::statement("
            DELETE FROM indonesia_districts
            WHERE city_code IN (
                SELECT code FROM indonesia_cities
                WHERE province_code NOT IN ('".implode("','", $allowedProvinceCodes)."')
            )
        ");

        DB::statement("
            DELETE FROM indonesia_cities
            WHERE province_code NOT IN ('".implode("','", $allowedProvinceCodes)."')
        ");

        DB::statement("
            DELETE FROM indonesia_provinces
            WHERE code NOT IN ('".implode("','", $allowedProvinceCodes)."')
        ");
    }
}
