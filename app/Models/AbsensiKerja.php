<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiKerja extends Model
{
    /** @use HasFactory<\Database\Factories\AbsensiKerjaFactory> */
    use HasFactory;

    protected $table = 'tbl_absensi_kerja';

    protected $fillable = [
        // 'id',
        'karyawan_id',
        'tanggal_masuk',
        'waktu_masuk',
        'status',
        'waktu_selesai_kerja'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
