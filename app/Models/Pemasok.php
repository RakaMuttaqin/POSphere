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
        'email',
        'no_hp',
        'alamat',
    ];

    public function barang()
    {
        return $this->hasMany(Barang::class, 'pemasok_id', 'id');
    }
}
