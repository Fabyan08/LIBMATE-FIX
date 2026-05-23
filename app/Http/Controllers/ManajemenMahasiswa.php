<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManajemenMahasiswa extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mahasiswa = User::query()->where('role', 'mahasiswa')
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                        ->orWhere('nim', 'like', "%{$search}%");
                });
            })->paginate(10);

        $mahasiswa->appends(['search' => $search]);

        if ($request->ajax()) {
            return view('dashboard.manajemen-mahasiswa.partials.rows', compact('mahasiswa'))->render();
        }

        return view('dashboard.manajemen-mahasiswa.index', compact('mahasiswa', 'search'));
    }
    public function create()
    {
        return view('dashboard.manajemen-mahasiswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'nim' => 'required|string|max:20|min:10|unique:mahasiswa,nim',
            'fakultas' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:mahasiswa,email',
            'status' => 'required|in:Aktif,Suspended,Cuti,Lulus',
            'foto' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $validated['user_id'] = auth()->id();
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('mahasiswa', 'public');
        }
        User::create($validated);

        return redirect()->route('manajemen-mahasiswa')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function show(User $mahasiswa)
    {
        return view('dashboard.manajemen-mahasiswa.show', compact('mahasiswa'));
    }

    public function edit(User $mahasiswa)
    {
        return view('dashboard.manajemen-mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, User $mahasiswa) // $mahasiswa di sini sebenarnya adalah instance dari model User
    {
        $validated = $request->validate([
            'status' => 'required|in:Aktif,Suspended,Cuti,Lulus',
        ], [
            'status.required' => 'Status keanggotaan wajib dipilih.',
            'status.in'       => 'Status yang dipilih tidak valid.',
        ]);

        $mahasiswa->update($validated);

        return redirect()->route('manajemen-mahasiswa')
            ->with('success', 'Status keanggotaan mahasiswa berhasil diperbarui.');
    }
    public function destroy(User $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('manajemen-mahasiswa')
            ->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
