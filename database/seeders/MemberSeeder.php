<?php

namespace Database\Seeders;

use App\Models\JenisMember;
use App\Models\Member;
use Faker\Core\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Schema;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Member::truncate();
        Schema::enableForeignKeyConstraints();
        $file = FacadesFile::get('database/data/member.json');
        $data = json_decode($file);

        $jenisMember = JenisMember::pluck('kode')->toArray();

        foreach ($data as $item) {
            Member::create([
                'kode' => $item->kode,
                'kode_jenis_member' => in_array($item->kode_jenis_member, $jenisMember)
                    ? $item->kode_jenis_member
                    : $jenisMember[array_rand($jenisMember)],
                'nama' => $item->nama,
                'alamat' => $item->alamat,
                'no_hp' => $item->no_hp,
                'email' => $item->email,
                'tanggal_bergabung' => $item->tanggal_bergabung
            ]);
        }
    }
}
