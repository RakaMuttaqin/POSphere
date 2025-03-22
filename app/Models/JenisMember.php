<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMember extends Model
{
    /** @use HasFactory<\Database\Factories\JenisMemberFactory> */
    use HasFactory;

    protected $table = 'jenis_member';

    protected $primaryKey = 'kode';

    public $incrementing = false;

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function member()
    {
        return $this->hasMany(Member::class, 'kode_jenis_member', 'kode');
    }
}
