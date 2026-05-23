<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    // Kolom yang diizinkan untuk pengisian massal (mass assignment)
    protected $fillable = [
        'user_id',
        'ruangan_id',
        'tanggal_pinjam',
        'jam_mulai',
        'jam_selesai',
        'keperluan',
        'status',
    ];

    /**
     * Relasi Kebalikan (BelongsTo) ke model User / Mahasiswa
     * Menghubungkan user_id di tabel peminjamans ke id di tabel users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi Kebalikan (BelongsTo) ke model Ruangan
     * Menghubungkan ruangan_id di tabel peminjamans ke id di tabel ruangans
     */
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id');
    }
}
