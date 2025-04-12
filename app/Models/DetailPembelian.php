<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    /** @use HasFactory<\Database\Factories\DetailPembelianFactory> */
    use HasFactory;

    protected $table = 'detail_pembelian';

    public $timestamps = false;

    protected $primaryKey = 'kode';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kode_pembelian',
        'kode_barang',
        'jumlah',
        'harga_beli',
        'harga_jual',
        'subtotal'
    ];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'kode_pembelian');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang');
    }
}
