<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    /** @use HasFactory<\Database\Factories\PembelianFactory> */
    use HasFactory;

    protected $table = 'pembelian';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'user_id',
        'pemasok_id',
        'total',
        'tanggal_terima',
        'tanggal_masuk',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id', 'id');
    }

    public function detail_pembelian()
    {
        return $this->hasMany(DetailPembelian::class, 'kode_pembelian', 'kode');
    }
}
