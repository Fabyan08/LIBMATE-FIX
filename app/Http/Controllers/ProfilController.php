<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
    public function index()
    {
        $mahasiswa = auth()->user();

        $mahasiswa->load(['peminjamans' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'peminjamans.ruangan']);

        return view('profil', compact('mahasiswa'));
    }

    public function show($id)
    {
        $mahasiswa = User::findOrFail($id);

        return view('profil', compact('mahasiswa'));
    }
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'     => 'required|string|max:255',
            'nim'      => 'nullable|string|max:20',
            'fakultas' => 'nullable|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $user->name     = $request->name;
        $user->nim      = $request->nim;
        $user->fakultas = $request->fakultas;
        $user->email    = $request->email;

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomName = Str::random(20) . '.' . $extension;

            $path = $request->file('foto')->storeAs('profil', $randomName, 'public');

            $user->foto = $path;
        }

        $user->save();

        return redirect()->back()->with('status', 'Data profil Anda berhasil diperbarui!');
    }
}
