<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = DB::table('users')->insert([
            [
                'name' => 'rynaar',
                'email' => 'rynaar@example.com',
                'role' => 'SuperAdmin',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'role' => 'Admin',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'kasir',
                'email' => 'kasir@example.com',
                'role' => 'Kasir',
                'password' => Hash::make('password')
            ],
            [
                'name' => 'owner',
                'email' => 'owner@example.com',
                'role' => 'Owner',
                'password' => Hash::make('password')
            ]
        ]);

        $this->call([
            JenisBarangSeeder::class,
            SatuanSeeder::class,
            PemasokSeeder::class,
            JenisMemberSeeder::class,
            MemberSeeder::class,
            BarangSeeder::class,
            PembelianSeeder::class,
            DetailPembelianSeeder::class,
            BatchSeeder::class,
            PenjualanSeeder::class,
            DetailPenjualanSeeder::class
        ]);
    }
}
