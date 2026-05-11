<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'nama',
        'nim',
        'alamat',
        'no_hp',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}