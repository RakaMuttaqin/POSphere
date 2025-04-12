<?php

namespace Tests\Feature;

use App\Models\JenisBarang;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class JenisBarangControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testStoreSuccessfully()
    {
        $data = [
            'kode' => 'JB001',
            'nama' => 'Minyak'
        ];

        JenisBarang::create($data);

        $response = $this->post('jenis-barang', $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('jenis_barang', $data);
    }

    public function testUpdateSuccessfully()
    {
        $jenisBarang = JenisBarang::create([
            'kode' => 'JB001',
            'nama' => 'Minyak'
        ]);

        $updatedData = [
            'nama' => 'Minyak Goreng'
        ];

        $response = $this->put("jenis-barang/edit/{$jenisBarang->kode}", $updatedData);

        $response->assertStatus(302);

        $this->assertDatabaseHas('jenis_barang');
    }

    public function testDeleteSuccessfully()
    {
        $jenisBarang = JenisBarang::create([
            'kode' => 'JB001',
            'nama' => 'Minyak'
        ]);

        $response = $this->delete("jenis-barang/delete/{$jenisBarang->kode}");

        $response->assertStatus(302);

        $this->assertDatabaseHas('jenis_barang');
    }
}
