<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisBarang extends Model
{
    /** @use HasFactory<\Database\Factories\JenisBarangFactory> */
    use HasFactory;

    protected $table = 'jenis_barang';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'kode_jenis_barang', 'kode');
    }
}
