<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    /** @use HasFactory<\Database\Factories\DetailPenjualanFactory> */
    use HasFactory;

    protected $table = 'detail_penjualan';

    protected $fillable = [
        'kode',
        'kode_penjualan',
        'kode_barang',
        'kode_batch',
        'harga_beli',
        'harga_jual',
        'jumlah',
        'subtotal',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'kode_penjualan', 'kode');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'kode_batch', 'kode');
    }
}
