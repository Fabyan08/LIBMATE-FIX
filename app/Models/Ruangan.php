<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ruangan extends Model
{

    protected $fillable = [
        'nama_ruang',
        'lantai',
        'kapasitas',
        'kategori',
        'gambar'
    ];


    protected $casts = [
        'lantai' => 'integer',
        'kapasitas' => 'integer'
    ];


    public function scopeAktif(Builder $query): Builder
    {
        return $query->where('status', 'tersedia');
    }

    public function fasilitas(): BelongsToMany
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_ruangan', 'ruangan_id', 'fasilitas_id')
            ->withTimestamps();
    }
}
