<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fasilitas extends Model
{
    protected $fillable = ['nama_fasilitas'];


    public function ruangans(): BelongsToMany
    {
        return $this->belongsToMany(Ruangan::class, 'fasilitas_ruangan', 'fasilitas_id', 'ruangan_id')
            ->withTimestamps();
    }
}
