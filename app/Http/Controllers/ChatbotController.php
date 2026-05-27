<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $pesan = strtolower($request->input('pesan'));

        if (str_contains($pesan, 'ruang') && str_contains($pesan, 'kosong')) {
            $jamSekarang = Carbon::now()->format('H:i:s');
            $tanggalHariIni = Carbon::now()->format('Y-m-d');

            $tersedia = Ruangan::whereDoesntHave('peminjaman', function ($q) use ($jamSekarang, $tanggalHariIni) {
                $q->where('tanggal_pinjam', $tanggalHariIni)
                    ->where('jam_mulai', '<=', $jamSekarang)
                    ->where('jam_selesai', '>=', $jamSekarang)
                    ->whereIn('status', ['Disetujui', 'Pending']);
            })->get();

            return response()->json(['reply' => 'Ruangan yang tersedia saat ini: ' . $tersedia->pluck('nama_ruang')->implode(', ')]);
        }

        return response()->json(['reply' => 'Maaf, saya belum mengerti maksud Anda. Coba tanya "ruang kosong".']);
    }
}
