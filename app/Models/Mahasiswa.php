<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'nim',
        'fakultas',
        'email',
        'status',
    ];
}
