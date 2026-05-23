<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class KatalogRuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruangan::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama_ruang', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori', $request->kategori);
        }

        $ruangans = $query->latest()->paginate(9)->withQueryString();

        $kategoris = Ruangan::select('kategori')->distinct()->pluck('kategori');

        return view('ruangan', compact('ruangans', 'kategoris'));
    }
    public function show($lantai, $id)
    {
        $ruangan = Ruangan::where('lantai', $lantai)->where('id', $id)->firstOrFail();
        $query = Peminjaman::where('ruangan_id', $ruangan->id)->whereIn('status', ['pending', 'disetujui'])->with('user');
        $peminjaman = $query->latest()->paginate(5)->withQueryString();

        return view('detail', compact('ruangan', 'peminjaman'));
    }
}
