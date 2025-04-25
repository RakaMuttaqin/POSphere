<?php

namespace Tests\Feature;

use App\Models\AbsensiKerja;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AbsensiKerjaControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testStoreSuccessfully(): void
    {
        $data = [
            'nama_karyawan' => 'John Doe',
            'tanggal_masuk' => '2023-06-01',
            'waktu_masuk' => '08:00:00',
            'status' => 'masuk',
            'waktu_keluar' => '17:00:00'
        ];

        // AbsensiKerja::truncate();
        AbsensiKerja::create($data);

        $response = $this->post('/absensi-kerja', $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('absensi_kerja', $data);
    }
}
