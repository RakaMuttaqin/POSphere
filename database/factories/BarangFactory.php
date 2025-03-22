<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jenisBarang = DB::table('jenis_barang')
            ->inRandomOrder()
            ->select('kode')
            ->first();

        $satuan = DB::table('satuan')->inRandomOrder()->select('id')->first();

        return [
            'kode' => 'BR' . sprintF('%08d', fake()->unique()->numberBetween(1, 99999999)),
            'kode_jenis_barang' => $jenisBarang->kode,
            'barcode' => fake()->unique()->numberBetween(1, 99999999),
            'nama' => fake()->word(),
            'satuan_id' => $satuan->id,
            'gambar' => null,
            'harga_beli' => fake()->randomNumber(8),
            'harga_jual' => fake()->randomNumber(8),
        ];
    }
}
