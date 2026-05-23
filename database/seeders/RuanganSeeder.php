<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_ruang' => 'Ruang Diskusi A1',
                'lantai'     => 1,
                'kapasitas'  => 6,
                'kategori'   => 'Diskusi Kelompok',
                'gambar'     => 'ruang-a1.jpg',
            ],
            [
                'nama_ruang' => 'Ruang Multimedia',
                'lantai'     => 1,
                'kapasitas'  => 12,
                'kategori'   => 'Fasilitas Digital',
                'gambar'     => 'multimedia.jpg',
            ],
            [
                'nama_ruang' => 'Ruang Literasi 1',
                'lantai'     => 2,
                'kapasitas'  => 4,
                'kategori'   => 'Ruang Tenang',
                'gambar'     => 'literasi-1.jpg',
            ],
            [
                'nama_ruang' => 'Ruang Kolaborasi B2',
                'lantai'     => 2,
                'kapasitas'  => 8,
                'kategori'   => 'Diskusi Kelompok',
                'gambar'     => 'kolaborasi-b2.jpg',
            ],
            [
                'nama_ruang' => 'Ruang Referensi VIP',
                'lantai'     => 3,
                'kapasitas'  => 2,
                'kategori'   => 'Privat',
                'gambar'     => 'vip-3.jpg',
            ],
            [
                'nama_ruang' => 'Corner Inovasi',
                'lantai'     => 3,
                'kapasitas'  => 15,
                'kategori'   => 'Workshop',
                'gambar'     => 'inovasi.jpg',
            ],
            [
                'nama_ruang' => 'Ruang Kajian Mandiri',
                'lantai'     => 2,
                'kapasitas'  => 1,
                'kategori'   => 'Individu',
                'gambar'     => 'mandiri.jpg',
            ],
        ];

        foreach ($data as $ruang) {
            Ruangan::create($ruang);
        }
    }
}
