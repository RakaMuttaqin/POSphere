<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /** @use HasFactory<\Database\Factories\BarangFactory> */
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kode',
        'jenis_barang_id',
        'nama',
        'gambar',
        'stok',
        'harga_beli',
        'harga_jual',
        'tanggal_exp',
    ];

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id', 'id');
    }

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'kode_barang', 'kode');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'kode_barang', 'kode');
    }
}
