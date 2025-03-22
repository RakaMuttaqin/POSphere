<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JenisBarang>
 */
class JenisBarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kode' => 'JB' . sprintF('%08d', fake()->unique()->numberBetween(1, 99999999)),
            'nama' => fake()->unique()->randomElement(['Minyak', 'Mie', 'Bumbu', 'Minuman', 'Makanan Bayi'])
        ];
    }
}
