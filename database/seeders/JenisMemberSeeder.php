<?php

namespace Database\Seeders;

use App\Models\JenisMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class JenisMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        JenisMember::truncate();
        Schema::enableForeignKeyConstraints();
        $file = File::get('database/data/jenis_member.json');
        $data = json_decode($file);

        foreach ($data as $item) {
            JenisMember::create([
                'kode' => $item->kode,
                'nama' => $item->nama
            ]);
        }
    }
}
