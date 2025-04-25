<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    /** @use HasFactory<\Database\Factories\KaryawanFactory> */
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'user_id',
        'nama_depan',
        'nama_belakang',
        'no_hp',
        'email',
        'alamat',
        'tanggal',
    ];

    public function absensi_kerja()
    {
        return $this->hasMany(AbsensiKerja::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
