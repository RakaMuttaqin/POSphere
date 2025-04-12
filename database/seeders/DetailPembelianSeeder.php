<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Batch;
use App\Models\DetailPembelian;
use App\Models\Pembelian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class DetailPembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DetailPembelian::truncate();
        Schema::enableForeignKeyConstraints();

        $file = File::get('database/data/detail_pembelian.json');
        $data = json_decode($file);

        $pembelian = Pembelian::pluck('kode')->toArray();
        $barang = Barang::pluck('kode')->toArray();

        $batches = Batch::pluck('kode')->toArray();

        foreach ($data as $item) {
            DetailPembelian::create([
                'kode' => $item->kode,
                'kode_pembelian' => in_array($item->kode_pembelian, $pembelian)
                    ? $item->kode_pembelian
                    : $pembelian[array_rand($pembelian)], // Pastikan ID pembelian valid
                'kode_barang' => in_array($item->kode_barang, $barang)
                    ? $item->kode_barang
                    : $barang[array_rand($barang)], // Pastikan ID barang valid
                'jumlah' => $item->jumlah,
                'harga_beli' => $item->harga_beli,
                'harga_jual' => $item->harga_jual,
                'subtotal' => $item->subtotal,
            ]);

            // Update stok batch
            $batch = Batch::where('kode', $item->kode_batch)->first();
            if ($batch) {
                $batch->create([
                    'kode' => $item->kode_batch,
                    'kode_barang' => $item->kode_barang,
                    'stok' => $item->jumlah,
                    'tanggal_produksi' => $item->tanggal_produksi,
                    'tanggal_expired' => $item->tanggal_expired,
                ]);
            }
        }
    }
}
