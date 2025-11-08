<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OngoingProyekSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan data sebelumnya dihapus biar gak duplikat kalau dijalankan berkali-kali
        // DB::table('ongoingproyeks')->truncate(); // Hati-hati pakai truncate kalau di production!

        DB::table('ongoingproyeks')->insert([
            [
                'judul' => 'Rumah Mewah Modern PIK 2',
                'tipe' => 'bangun_baru',
                'deskripsi_singkat' => 'Pembangunan rumah tinggal 3 lantai dengan konsep modern tropis dan kolam renang.',
                'tanggal_proyek' => Carbon::create(2024, 2, 10),
                'provinsi_proyek' => 'DKI Jakarta',
                'attachmentproyek' => null, // Bisa diisi path gambar nanti, misal: 'proyek/rumah-pik.jpg'
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Renovasi Fasad Ruko Kelapa Gading',
                'tipe' => 'renovasi',
                'deskripsi_singkat' => 'Peremajaan tampilan depan ruko lama menjadi lebih kekinian untuk menarik penyewa.',
                'tanggal_proyek' => Carbon::create(2023, 8, 15),
                'provinsi_proyek' => 'DKI Jakarta',
                'attachmentproyek' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Interior Apartemen Studio BSD',
                'tipe' => 'interior',
                'deskripsi_singkat' => 'Desain interior compact dan fungsional untuk memaksimalkan ruang apartemen tipe studio.',
                'tanggal_proyek' => Carbon::create(2024, 4, 5),
                'provinsi_proyek' => 'Banten',
                'attachmentproyek' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Villa Kayu Puncak',
                'tipe' => 'bangun_baru',
                'deskripsi_singkat' => 'Konstruksi villa peristirahatan dengan dominasi material kayu ulin tahan cuaca.',
                'tanggal_proyek' => Carbon::create(2023, 12, 1),
                'provinsi_proyek' => 'Jawa Barat',
                'attachmentproyek' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             [
                'judul' => 'Renovasi Dapur & Ruang Makan',
                'tipe' => 'renovasi',
                'deskripsi_singkat' => 'Menggabungkan area dapur dan ruang makan dengan konsep open space agar terasa lebih luas.',
                'tanggal_proyek' => Carbon::create(2024, 1, 20),
                'provinsi_proyek' => 'Jawa Tengah',
                'attachmentproyek' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}