<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    /** @use HasFactory<\Database\Factories\BatchFactory> */
    use HasFactory;

    protected $table = 'batch';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kode_barang',
        'stok',
        'tanggal_produksi',
        'tanggal_expired',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'kode');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'kode_batch', 'kode');
    }
}
