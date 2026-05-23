<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function store(Request $request, $ruangan_id)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',
            'keperluan'      => 'required|string|min:10|max:255',
        ], [
            'tanggal_pinjam.required'       => 'Tanggal peminjaman wajib Anda pilih.',
            'tanggal_pinjam.after_or_equal' => 'Tanggal peminjaman tidak boleh di masa lalu.',
            'jam_mulai.required'            => 'Waktu jam mulai wajib ditentukan.',
            'jam_selesai.required'          => 'Waktu jam selesai wajib ditentukan.',
            'keperluan.required'            => 'Kolom keperluan pengisian wajib diisi.',
            'keperluan.min'                 => 'Berikan deskripsi keperluan minimal 10 karakter agar admin paham.',
        ]);

        $ruangan = Ruangan::findOrFail($ruangan_id);

        $jamMulai = Carbon::parse($request->jam_mulai);
        $jamSelesai = Carbon::parse($request->jam_selesai);
        $tanggalBooking = Carbon::parse($request->tanggal_pinjam)->format('Y-m-d');

        $jamBuka = Carbon::parse('08:00:00');
        $jamTutup = Carbon::parse('16:00:00');

        
        if ($jamMulai->lt($jamBuka) || $jamSelesai->gt($jamTutup)) {
            return redirect()->back()->withInput()->withErrors([
                'jam_mulai' => 'Pemesanan hanya bisa dilakukan pada jam operasional perpustakaan (08:00 - 16:00 WIB).'
            ]);
        }

        
        if ($jamSelesai->lte($jamMulai)) {
            return redirect()->back()->withInput()->withErrors([
                'jam_selesai' => 'Jam selesai peminjaman harus diatur setelah waktu jam mulai.'
            ]);
        }

        
        
        
        $durasiMenit = $jamMulai->diffInMinutes($jamSelesai);
        if ($durasiMenit > 180) { 
            return redirect()->back()->withInput()->withErrors([
                'jam_selesai' => 'Durasi peminjaman maksimal adalah 3 jam dalam satu kali pengajuan.'
            ]);
        }

        
        
        
        $jumlahPesanHariIni = Peminjaman::where('user_id', auth()->id())
            ->whereDate('tanggal_pinjam', $tanggalBooking)
            ->whereIn('status', ['Pending', 'Disetujui']) 
            ->count();

        if ($jumlahPesanHariIni >= 2) {
            return redirect()->back()->withInput()->withErrors([
                'tanggal_pinjam' => 'Anda sudah mencapai batas maksimal peminjaman (2 kali) untuk tanggal tersebut.'
            ]);
        }

        $jamMulaiStr = $jamMulai->format('H:i:s');
        $jamSelesaiStr = $jamSelesai->format('H:i:s');

        
        $jadwalBentrokan = Peminjaman::where('ruangan_id', $ruangan->id)
            ->whereDate('tanggal_pinjam', $tanggalBooking)
            ->whereIn('status', ['Disetujui', 'Pending'])
            ->where(function ($query) use ($jamMulaiStr, $jamSelesaiStr) {
                $query->where('jam_mulai', '<', $jamSelesaiStr)
                    ->where('jam_selesai', '>', $jamMulaiStr);
            })->exists();


        if ($jadwalBentrokan) {
            return redirect()->back()->withInput()->withErrors([
                'jam_mulai' => 'Maaf, ruangan ini sudah dibooking atau sedang dalam proses antrean (Pending) pada rentang jam tersebut. Silakan cari jam lain.'
            ]);
        } else {
            
            Peminjaman::create([
                'user_id'        => auth()->id(),
                'ruangan_id'     => $ruangan->id,
                'tanggal_pinjam' => $tanggalBooking,
                'jam_mulai'      => $jamMulaiStr,
                'jam_selesai'    => $jamSelesaiStr,
                'keperluan'      => $request->keperluan,
                'status'         => 'Pending'
            ]);

            return redirect()->back()->with('status', 'Pengajuan booking Anda untuk ' . $ruangan->nama_ruang . ' berhasil dikirim! Silakan pantau status persetujuan secara berkala.');
        }
    }
    public function batalBooking($id)
    {

        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('status', 'Pending')
            ->firstOrFail();


        $peminjaman->update(['status' => 'Dibatalkan']);

        return redirect()->back()->with('status', 'Pemesanan ruangan berhasil dibatalkan.');
    }
}
