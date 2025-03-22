<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Batch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Batch::truncate();
        Schema::enableForeignKeyConstraints();

        $file = File::get('database/data/batch.json');
        $data = json_decode($file);

        $barang = Barang::pluck('kode')->toArray();

        foreach ($data as $item) {
            Batch::create([
                'kode' => $item->kode,
                'kode_barang' => in_array($item->kode_barang, $barang)
                    ? $item->kode_barang
                    : $barang[array_rand($barang)],
                'stok' => $item->stok,
                'tanggal_produksi' => $item->tanggal_produksi,
                'tanggal_expired' => $item->tanggal_expired,
            ]);
        }
    }
}
