<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajemenRuang extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');


        $query = Ruangan::with('fasilitas');


        if ($search) {
            $query->where('nama_ruang', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%")
                ->orWhere('lantai', 'like', "%{$search}%");
        }
        $daftar_ruang = $query->paginate(10)->withQueryString();


        $totalRuang = Ruangan::count();
        return view('dashboard.manajemen-ruang.index', compact('daftar_ruang', 'totalRuang'));
    }

    public function create()
    {
        $fasilitas = Fasilitas::all();
        return view('dashboard.manajemen-ruang.create', compact('fasilitas'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'nama_ruang' => 'required|string|max:255',
            'kategori'   => 'required|string',
            'lantai'     => 'required|integer|min:1',
            'kapasitas'  => 'required|integer|min:1',
            'gambar'     => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'fasilitas'  => 'array',
        ]);


        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');

            $gambarPath = $file->storeAs('ruangans', time() . '_' . $file->getClientOriginalName(), 'public');
        }


        $ruangan = Ruangan::create([
            'nama_ruang' => $request->nama_ruang,
            'kategori'   => $request->kategori,
            'lantai'     => $request->lantai,
            'kapasitas'  => $request->kapasitas,
            'gambar'     => $gambarPath,
        ]);


        if ($request->has('fasilitas')) {

            $ruangan->fasilitas()->attach($request->fasilitas);
        }

        return redirect()->route('manajemen-ruang')->with('status', 'Ruangan baru berhasil ditambahkan!');
    }

    public function getFasilitas()
    {
        $fasilitas = Fasilitas::orderBy('nama_fasilitas', 'asc')->get();
        return response()->json($fasilitas);
    }

    public function storeFasilitas(Request $request)
    {
        $request->validate([
            'nama_fasilitas' => 'required|string|max:255|unique:fasilitas,nama_fasilitas'
        ]);

        $fasilitas = Fasilitas::create([
            'nama_fasilitas' => $request->nama_fasilitas
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil ditambahkan',
            'data'    => $fasilitas
        ]);
    }

    public function destroyFasilitas($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $fasilitas->delete();

        return response()->json([
            'success' => true,
            'message' => 'Fasilitas berhasil dihapus'
        ]);
    }

    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);

        if ($ruangan->gambar) {
            Storage::disk('public')->delete($ruangan->gambar);
        }

        $ruangan->delete();

        return redirect()->route('manajemen-ruang')->with('status', 'Ruangan berhasil dihapus!');
    }

    public function edit($id)
    {

        $ruangan = Ruangan::with('fasilitas')->findOrFail($id);


        $fasilitas = Fasilitas::orderBy('nama_fasilitas', 'asc')->get();

        return view('dashboard.manajemen-ruang.edit', compact('ruangan', 'fasilitas'));
    }

    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::findOrFail($id);

        $request->validate([
            'nama_ruang' => 'required|string|max:255',
            'kategori'   => 'required|string',
            'lantai'     => 'required|integer|min:1',
            'kapasitas'  => 'required|integer|min:1',
            'gambar'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'fasilitas'  => 'array',
        ]);

        $dataRuangan = [
            'nama_ruang' => $request->nama_ruang,
            'kategori'   => $request->kategori,
            'lantai'     => $request->lantai,
            'kapasitas'  => $request->kapasitas,
        ];


        if ($request->hasFile('gambar')) {

            if ($ruangan->gambar && Storage::disk('public')->exists($ruangan->gambar)) {
                Storage::disk('public')->delete($ruangan->gambar);
            }


            $file = $request->file('gambar');
            $dataRuangan['gambar'] = $file->storeAs('ruangans', time() . '_' . $file->getClientOriginalName(), 'public');
        }


        $ruangan->update($dataRuangan);



        if ($request->has('fasilitas')) {
            $ruangan->fasilitas()->sync($request->fasilitas);
        } else {

            $ruangan->fasilitas()->detach();
        }

        return redirect()->route('manajemen-ruang')->with('status', 'Data ruangan berhasil diperbarui!');
    }
    public function show($id)
    {
        $ruangan = Ruangan::with('fasilitas')->findOrFail($id);

        return view('dashboard.manajemen-ruang.show', compact('ruangan'));
    }
}
