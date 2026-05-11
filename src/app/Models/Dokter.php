<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = [
        'nama',
        'spesialis',
        'no_hp',
    ];

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
