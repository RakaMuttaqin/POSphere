<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    protected $table = 'member';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'kode_jenis_member',
        'nama',
        'no_hp',
        'email',
        'alamat',
        'tanggal_bergabung',
    ];

    public function jenis_member()
    {
        return $this->belongsTo(JenisMember::class, 'kode_jenis_member', 'kode');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'kode_member', 'kode');
    }

    public function pengajuan_barang()
    {
        return $this->hasMany(PengajuanBarang::class, 'kode_member', 'kode');
    }
}
