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
        // Kode provinsi yang dicakup KilauBuild (Jakarta, Banten, Jawa Barat, Jawa Tengah, DI Yogyakarta, Jawa Timur, Bali):
        // 31 = DKI Jakarta
        // 36 = Banten
        // 32 = Jawa Barat
        // 33 = Jawa Tengah
        // 34 = DI Yogyakarta
        // 35 = Jawa Timur (termasuk Madura)
        // 51 = Bali

        $allowedProvinceCodes = ['31', '32', '33', '34', '35', '36', '51'];

        // cakupan target projek kilaubuild
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
