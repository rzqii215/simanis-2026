<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'tanggal_lahir',
    ];

    public function pemeriksaan()
    {
        return $this->hasMany(Pemeriksaan::class);
    }
}
