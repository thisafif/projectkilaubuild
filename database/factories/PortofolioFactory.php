<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portofolio>
 */
class PortofolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->words(3, true),
            'deskripsi_singkat' => fake()->sentence(10),
            'deskripsi_lengkap' => fake()->paragraphs(3, true),
            'tipe' => fake()->randomElement(['bangun_baru', 'renovasi', 'interior']),
            'tanggal_proyek' => fake()->dateTimeBetween('-2 years', 'now'),
            'attachmentportofolio' => fake()->imageUrl(400, 300, 'architecture', true),
        ];
    }
}
