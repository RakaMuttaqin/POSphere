<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\JenisBarang;
use App\Models\Satuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Barang::truncate();
        Schema::enableForeignKeyConstraints();

        // Ambil data dari file JSON
        $file = File::get('database/data/barang.json');
        $data = json_decode($file);

        // Ambil semua kode jenis barang & ID satuan yang tersedia
        $jenisBarang = JenisBarang::pluck('kode')->toArray();
        $satuan = Satuan::pluck('id')->toArray();

        foreach ($data as $item) {
            Barang::create([
                'kode' => $item->kode,
                'kode_jenis_barang' => in_array($item->kode_jenis_barang, $jenisBarang)
                    ? $item->kode_jenis_barang
                    : $jenisBarang[array_rand($jenisBarang)], // Pastikan kode valid
                'barcode' => $item->barcode,
                'nama' => $item->nama,
                'harga_beli' => $item->harga_beli,
                'harga_jual' => $item->harga_jual,
                'satuan_id' => in_array($item->satuan_id, $satuan)
                    ? $item->satuan_id
                    : $satuan[array_rand($satuan)], // Pastikan ID satuan valid
                'gambar' => $item->gambar,
            ]);
        }
    }
}
