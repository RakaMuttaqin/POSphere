<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    /** @use HasFactory<\Database\Factories\PenjualanFactory> */
    use HasFactory;

    protected $table = 'penjualan';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'user_id',
        'kode_member',
        'total',
        'tanggal',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'kode_member', 'kode');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'kode_penjualan', 'kode');
    }

    public function detail_penjualan()
    {
        return $this->hasMany(DetailPenjualan::class, 'kode_penjualan', 'kode');
    }
}
