<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    /** @use HasFactory<\Database\Factories\DetailPembelianFactory> */
    use HasFactory;

    protected $table = 'detail_pembelian';
    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kode_pembelian',
        'kode_barang',
        'harga_beli',
        'harga_jual',
        'jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode');
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'kode_pembelian', 'kode');
    }
}
