<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;

class ManajemenPeminjaman extends Controller
{
    public function index(Request $request)
    {

        $search = $request->input('search');
        $statusFilter = $request->input('status');


        $query = Peminjaman::with(['user', 'ruangan']);


        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }


        if ($statusFilter && in_array($statusFilter, ['Pending', 'Disetujui', 'Ditolak', 'Selesai'])) {
            $query->where('status', $statusFilter);
        }


        $peminjamans = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();


        $totalBooking = Peminjaman::count();
        $pendingBooking = Peminjaman::where('status', 'Pending')->count();
        $approvedBooking = Peminjaman::where('status', 'Disetujui')->count();


        return view('dashboard.manajemen-peminjaman.index', compact(
            'peminjamans',
            'totalBooking',
            'pendingBooking',
            'approvedBooking'
        ));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Disetujui,Ditolak,Selesai'
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('status', 'Status izin akses ruangan berhasil diperbarui!');
    }
}
