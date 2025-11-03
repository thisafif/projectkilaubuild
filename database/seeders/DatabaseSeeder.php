<?php

namespace Database\Seeders;

use App\Models\Portofolio;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Laravolt Indonesia data dulu via command
        $this->command->call('laravolt:indonesia:seed');

        // Kemudian filter hanya provinsi yang diizinkan
        $this->call([
            IndonesiaSeeder::class,
        ]);

        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        // Create sample portfolios
        Portofolio::factory(9)->create();
    }
}
