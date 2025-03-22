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

    protected $fillable = [
        'kode',
        'kode_jenis_barang',
        'barcode',
        'nama',
        'satuan_id',
        'gambar',
        'harga_beli',
        'harga_jual',
    ];

    public function jenis_barang()
    {
        return $this->belongsTo(JenisBarang::class, 'kode_jenis_barang', 'kode');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }

    public function batch()
    {
        return $this->hasMany(Batch::class, 'kode_barang', 'kode');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'kode_barang', 'kode');
    }

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'kode_barang', 'kode');
    }
}
