<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasok extends Model
{
    /** @use HasFactory<\Database\Factories\PemasokFactory> */
    use HasFactory;

    protected $table = 'pemasok';

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'alamat',
    ];

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'pemasok_id', 'id');
    }
}
