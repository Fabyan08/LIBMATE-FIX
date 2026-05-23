@extends('layouts.dashboard.app')

@section('title', 'Edit Data Mahasiswa')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
        <div class="p-6 md:p-8 lg:p-10 max-w-4xl mx-auto">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Edit Profil Mahasiswa
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">
                        Perbarui informasi keanggotaan untuk <strong>{{ $mahasiswa->nama }}</strong>.
                    </p>
                </div>

                <a href="{{ route('manajemen-mahasiswa') }}"
                    class="flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-full text-sm font-semibold transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </a>
            </header>
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <form action="{{ route('manajemen-mahasiswa.update', $mahasiswa->id) }}" method="POST"
                    class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Foto Profil (Read-Only) --}}
                        <div class="space-y-2 md:col-span-2">
                            <label class="text-sm font-semibold text-slate-700">Foto Profil</label>
                            <div
                                class="w-32 h-32 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 text-4xl font-bold border-4 border-white shadow-sm overflow-hidden">
                                @if ($mahasiswa->foto)
                                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Mahasiswa"
                                        class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}
                                @endif
                            </div>
                        </div>

                        {{-- Nama Lengkap (Read-Only dengan style disabled) --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-500">Nama Lengkap</label>
                            <input type="text" value="{{ $mahasiswa->name }}" disabled
                                class="w-full bg-slate-100 border border-slate-200 rounded-xl py-2.5 px-4 text-sm text-slate-500 cursor-not-allowed">
                        </div>

                        {{-- NIM (Read-Only) --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-500">NIM</label>
                            <input type="text" value="{{ $mahasiswa->nim }}" disabled
                                class="w-full bg-slate-100 border border-slate-200 rounded-xl py-2.5 px-4 text-sm text-slate-500 cursor-not-allowed">
                        </div>

                        {{-- Fakultas (Read-Only) --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-500">Fakultas</label>
                            <input type="text" value="{{ $mahasiswa->fakultas }}" disabled
                                class="w-full bg-slate-100 border border-slate-200 rounded-xl py-2.5 px-4 text-sm text-slate-500 cursor-not-allowed">
                        </div>

                        {{-- Email (Read-Only) --}}
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-slate-500">Email Institusi</label>
                            <input type="email" value="{{ $mahasiswa->email }}" disabled
                                class="w-full bg-slate-100 border border-slate-200 rounded-xl py-2.5 px-4 text-sm text-slate-500 cursor-not-allowed">
                        </div>

                        {{-- Status Keanggotaan (Satu-satunya yang BISA DIEDIT) --}}
                        <div class="space-y-2 md:col-span-2 bg-orange-50/50 p-6 rounded-2xl border border-orange-100">
                            <label class="text-sm font-bold text-orange-800">Ubah Status Keanggotaan</label>
                            <div class="flex flex-wrap gap-6 pt-2">
                                @foreach (['Aktif', 'Suspended', 'Lulus'] as $stat)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="status" value="{{ $stat }}"
                                            class="w-4 h-4 text-orange-500 border-slate-300 focus:ring-orange-200"
                                            {{ old('status', $mahasiswa->status) == $stat ? 'checked' : '' }}>
                                        <span
                                            class="text-sm text-slate-700 font-medium group-hover:text-orange-600 transition-colors">{{ $stat }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex justify-end gap-3">
                        <button type="submit"
                            class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full text-sm font-bold transition shadow-lg shadow-orange-200 active:scale-95">
                            <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                            Simpan Perubahan Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
