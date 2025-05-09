<?php

namespace Database\Seeders;

use App\Models\JenisBarang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class JenisBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        JenisBarang::truncate();
        Schema::enableForeignKeyConstraints();
        $file = File::get('database/data/jenis_barang.json');
        $data = json_decode($file);

        foreach ($data as $item) {
            JenisBarang::create([
                'kode' => $item->kode,
                'nama' => $item->nama
            ]);
        }
        // JenisBarang::factory()->count(5)->create();
    }
}
