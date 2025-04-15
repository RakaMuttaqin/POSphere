<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    /** @use HasFactory<\Database\Factories\PembayaranFactory> */
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kode_penjualan',
        'total_bayar',
        'kembalian',
        'metode_pembayaran',
        'tanggal_bayar',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'kode_penjualan', 'kode');
    }
}
