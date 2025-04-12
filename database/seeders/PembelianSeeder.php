<?php

namespace Database\Seeders;

use App\Models\Pemasok;
use App\Models\Pembelian;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Pembelian::truncate();
        Schema::enableForeignKeyConstraints();

        $file = File::get('database/data/pembelian.json');
        $data = json_decode($file);

        $user = User::pluck('id')->toArray();
        $pemasok = Pemasok::pluck('id')->toArray();

        foreach ($data as $item) {
            Pembelian::create([
                'kode' => $item->kode,
                'user_id' => in_array($item->user_id, $user)
                    ? $item->user_id
                    : $user[array_rand($user)], // Pastikan ID user valid
                'pemasok_id' => in_array($item->pemasok_id, $pemasok)
                    ? $item->pemasok_id
                    : $pemasok[array_rand($pemasok)], // Pastikan ID pemasok valid
                'total' => $item->total,
                'tanggal_terima' => $item->tanggal_terima,
                'tanggal_masuk' => $item->tanggal_masuk,
                'keterangan' => $item->keterangan,
            ]);
        }
    }
}
