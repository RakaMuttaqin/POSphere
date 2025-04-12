<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Penjualan::truncate();
        Schema::enableForeignKeyConstraints();

        $file = File::get('database/data/penjualan.json');
        $data = json_decode($file);

        $user = User::pluck('id')->toArray();
        $pelanggan = Member::pluck('kode')->toArray();

        foreach ($data as $item) {
            Penjualan::create([
                'kode' => $item->kode,
                'user_id' => in_array($item->user_id, $user)
                    ? $item->user_id
                    : $user[array_rand($user)], // Pastikan ID user valid
                'kode_member' => in_array($item->kode_member, $pelanggan)
                    ? $item->kode_member
                    : $pelanggan[array_rand($pelanggan)], // Pastikan ID pelanggan valid
                'total' => $item->total,
                'tanggal' => $item->tanggal,
            ]);
        }
    }
}
