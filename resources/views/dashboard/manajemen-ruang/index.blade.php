@extends('layouts.dashboard.app')

@section('title', 'Kelola Data Ruang Perpustakaan')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
        <div class="p-6 md:p-8 lg:p-10 max-w-7xl mx-auto">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Manajemen Data Ruang
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">
                        Daftar master ruangan perpustakaan, status ketersediaan, dan fasilitas.
                    </p>
                </div>

                <div class="flex items-center gap-4 w-full md:w-auto">
                    <a href="{{ route('manajemen-ruang.create') }}"
                        class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-md shadow-orange-200">
                        <i data-lucide="plus-circle" class="w-4 h-4"></i>
                        Tambah Ruang Baru
                    </a>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-dashboard.stat-card judul="Total Ruang" ikon="door-open" warna="blue" id="stat-total-room"
                    nilai="{{ $totalRuang ?? 0 }}" />
                <x-dashboard.stat-card judul="Tersedia" ikon="check-circle" warna="emerald" id="stat-available-room"
                    nilai="{{ $tersediaRuang ?? 0 }}" />
                <x-dashboard.stat-card judul="Sedang Dipakai" ikon="user-check" warna="orange" id="stat-occupied-room"
                    nilai="{{ $sedangDipakaiRuang ?? 0 }}" />
            </div>

            <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm overflow-hidden">
                <form action="{{ route('manajemen-ruang') }}" method="GET" class="relative w-full">
                    <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama ruang atau kategori..."
                        class="w-full bg-white border border-slate-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all"
                        autocomplete="off" />

                    <button type="submit" class="hidden">Cari</button>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead
                            class="bg-slate-50 text-slate-600 font-semibold text-xs uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4">Informasi Ruang</th>
                                <th class="px-6 py-4">Kapasitas</th>
                                <th class="px-6 py-4">Fasilitas</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

                            @forelse ($daftar_ruang as $ruang)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img src="{{ asset('storage/' . $ruang->gambar) }}"
                                                alt="{{ $ruang->nama_ruang }}"
                                                class="w-16 h-16 object-cover rounded-lg mr-4">
                                            <div class="flex flex-col">
                                                <div class="font-bold text-slate-800">{{ $ruang->nama_ruang }}</div>
                                                <div class="text-xs text-slate-400">Lantai {{ $ruang->lantai }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="flex items-center gap-1.5 text-slate-600">
                                            <i data-lucide="users" class="w-4 h-4 text-slate-400"></i>
                                            {{ $ruang->kapasitas }} Orang
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex gap-1 flex-wrap">

                                            @forelse ($ruang->fasilitas as $item)
                                                <span
                                                    class="px-2 py-0.5 bg-slate-100 border border-slate-200 text-slate-600 rounded text-[10px] font-medium">
                                                    {{ $item->nama_fasilitas }}
                                                </span>
                                            @empty
                                                <span class="text-xs text-slate-400 italic">Tidak ada fasilitas</span>
                                            @endforelse
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-indigo-50 text-indigo-600 border border-indigo-100">
                                            {{ $ruang->kategori }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('manajemen-ruang.show', $ruang->id) }}"
                                                class="p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('manajemen-ruang.edit', $ruang->id) }}"
                                                class="p-2 text-slate-400 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            </a>
                                            <form action="{{ route('manajemen-ruang.destroy', $ruang->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus ruang ini?');"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center justify-center text-slate-400">
                                            <i data-lucide="folder-open" class="w-12 h-12 mb-3 opacity-20"></i>
                                            <p>Belum ada data ruangan yang terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>


                @if ($daftar_ruang->hasPages())
                    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                        {{ $daftar_ruang->links() }}
                    </div>
                @endif
            </div>
        </div>
    </main>
@endsection
