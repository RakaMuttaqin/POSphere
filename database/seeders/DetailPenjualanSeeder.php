<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Batch;
use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class DetailPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DetailPenjualan::truncate();
        Schema::enableForeignKeyConstraints();

        $file = File::get('database/data/detail_penjualan.json');
        $data = json_decode($file);

        // Pastikan file JSON tidak kosong
        if (!$data) {
            echo "File JSON kosong atau tidak bisa dibaca!\n";
            return;
        }

        $penjualan = Penjualan::pluck('kode')->toArray();
        $barang = Barang::pluck('kode')->toArray();

        // Pastikan data penjualan & barang tidak kosong
        if (empty($penjualan)) {
            echo "Data penjualan kosong!\n";
            return;
        }

        if (empty($barang)) {
            echo "Data barang kosong!\n";
            return;
        }

        foreach ($data as $items) {
            // Cek apakah barang ada dalam array
            if (!in_array($items->kode_barang, $barang)) {
                echo "Barang {$items->kode_barang} tidak ditemukan!\n";
                continue;
            }

            // Ambil batch berdasarkan kode_barang
            $batches = Batch::where('kode_barang', $items->kode_barang)
                ->orderBy('created_at', 'asc')
                ->pluck('kode')
                ->toArray();

            // Jika tidak ada batch, skip
            if (empty($batches)) {
                echo "Batch untuk barang {$items->kode_barang} tidak ditemukan!\n";
                continue;
            }

            $kode_batch = in_array($items->kode_batch, $batches)
                ? $items->kode_batch
                : $batches[array_rand($batches)];

            $kode_penjualan = in_array($items->kode_penjualan, $penjualan)
                ? $items->kode_penjualan
                : $penjualan[array_rand($penjualan)];

            $kode_barang = in_array($items->kode_barang, $barang)
                ? $items->kode_barang
                : $barang[array_rand($barang)];

            // Buat DetailPenjualan
            DetailPenjualan::create([
                'kode' => $items->kode,
                'kode_penjualan' => $kode_penjualan,
                'kode_barang' => $kode_barang,
                'kode_batch' => $kode_batch,
                'harga_beli' => $items->harga_beli,
                'harga_jual' => $items->harga_jual,
                'jumlah' => $items->jumlah,
                'subtotal' => $items->subtotal,
            ]);

            // Update stok batch
            $batch = Batch::where('kode', $kode_batch)->first();
            if ($batch) {
                $stok_baru = max(0, $batch->stok - $items->jumlah);
                $batch->update(['stok' => $stok_baru]);
                echo "Batch {$kode_batch} stok dikurangi {$items->jumlah}, stok baru: {$stok_baru}\n";
            } else {
                echo "Batch {$kode_batch} tidak ditemukan!\n";
            }

            // Update total penjualan
            $penjualanData = Penjualan::where('kode', $kode_penjualan)->first();
            if ($penjualanData) {
                $total_baru = $penjualanData->total + $items->subtotal;
                $penjualanData->update(['total' => $total_baru]);
                echo "Penjualan {$kode_penjualan} total ditambah {$items->subtotal}, total baru: {$total_baru}\n";
            } else {
                echo "Penjualan {$kode_penjualan} tidak ditemukan!\n";
            }
        }
    }
}
