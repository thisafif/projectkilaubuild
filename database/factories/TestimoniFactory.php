<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimoni>
 */
class TestimoniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'teks' => fake()->text(50),
            'rating' => fake()->numberBetween(1, 5),
            'nama' => fake()->name(),
            'kegseharihari' => mb_substr(fake()->sentence(fake()->numberBetween(3, 8)), 0, 50),
        ];
    }
}
