<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangans';
    protected $fillable = [
        'nama_ruang',
        'lantai',
        'kapasitas',
        'kategori',
        'gambar'
    ];
}
