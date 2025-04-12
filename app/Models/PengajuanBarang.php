<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanBarang extends Model
{
    /** @use HasFactory<\Database\Factories\PengajuanBarangFactory> */
    use HasFactory;

    protected $table = 'pengajuan_barang';

    protected $primaryKey = 'kode_pengajuan';

    public $incrementing = false;
    protected $fillable = [
        'kode_pengajuan',
        'kode_member',
        'nama_barang',
        'tanggal_pengajuan',
        'qty',
        'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'kode_member');
    }
}
