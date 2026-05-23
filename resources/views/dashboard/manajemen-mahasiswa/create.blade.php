@extends('layouts.dashboard.app')

@section('title', 'Tambah Mahasiswa Baru')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
        <div class="p-6 md:p-8 lg:p-10 max-w-6xl mx-auto">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Tambah Mahasiswa Baru
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">
                        Lengkapi formulir di bawah untuk mendaftarkan mahasiswa ke sistem perpustakaan.
                    </p>
                </div>

                <a href="{{ route('manajemen-mahasiswa') }}"
                    class="flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-600 px-5 py-2.5 rounded-full text-sm font-semibold transition">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </a>
            </header>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <form action="{{ route('manajemen-mahasiswa.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8 space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Upload Foto --}}
                        <div class="space-y-2 md:col-span-2">
                            <label for="foto" class="text-sm font-semibold text-slate-700">Foto Profil</label>
                            <input type="file" name="foto" id="foto"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2 px-4 text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100 transition-all @error('foto') border-red-500 @enderror ">
                            <p class="text-[10px] text-slate-400">*Format: JPG, PNG. Maksimal 2MB.</p>
                        </div>
                        @error('foto')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                        {{-- Nama Lengkap --}}
                        <div class="space-y-2">
                            <label for="name" class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                placeholder="Masukkan nama sesuai KTM"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all @error('name') border-red-400 @enderror"
                                required>
                            @error('name')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NIM --}}
                        <div class="space-y-2">
                            <label for="nim" class="text-sm font-semibold text-slate-700">NIM</label>
                            <input type="number" name="nim" id="nim" value="{{ old('nim') }}"
                                placeholder="Contoh: 24241010..."
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all @error('nim') border-red-400 @enderror"
                                required>
                            @error('nim')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Fakultas --}}
                        <div class="space-y-2">
                            <label for="fakultas" class="text-sm font-semibold text-slate-700">Fakultas</label>
                            <select name="fakultas" id="fakultas"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all @error('fakultas') border-red-400 @enderror"
                                required>
                                <option value="" disabled selected>Pilih Fakultas</option>
                                <option value="Ilmu Komputer">Ilmu Komputer</option>
                                <option value="Teknik">Teknik</option>
                                <option value="Ekonomi dan Bisnis">Ekonomi dan Bisnis</option>
                                <option value="Kedokteran">Kedokteran</option>
                                <option value="Hukum">Hukum</option>
                                <option value="MIPA">MIPA</option>
                            </select>
                            @error('fakultas')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-slate-700">Email Institusi</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                placeholder="email@student.unej.ac.id"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl py-2.5 px-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all @error('email') border-red-400 @enderror"
                                required>
                            @error('email')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Status Keanggotaan --}}
                        <div class="space-y-2">
                            <label for="status" class="text-sm font-semibold text-slate-700">Status Awal</label>
                            <div class="flex flex-wrap gap-4 pt-1">
                                @foreach (['Aktif', 'Cuti', 'Suspended'] as $stat)
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input type="radio" name="status" value="{{ $stat }}"
                                            class="w-4 h-4 text-orange-500 border-slate-300 focus:ring-orange-200"
                                            {{ old('status', 'Aktif') == $stat ? 'checked' : '' }}>
                                        <span
                                            class="text-sm text-slate-600 group-hover:text-slate-800 transition-colors">{{ $stat }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 flex justify-end">
                        <button type="submit"
                            class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full text-sm font-bold transition shadow-lg shadow-orange-200 active:scale-95">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Simpan Data Mahasiswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
