@extends('layouts.dashboard.app')

@section('title', 'Detail Ruangan')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0 bg-slate-50">
        <div class="p-6 md:p-8 lg:p-10 max-w-6xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 tracking-wider uppercase mb-1">
                        Manajemen Ruangan <span class="mx-2">›</span> Detail Ruangan
                    </p>
                    <h1 class="text-3xl font-bold text-slate-800">Detail Ruangan</h1>
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto">
                    <a href="{{ route('manajemen-ruang') }}"
                        class="flex items-center justify-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-sm">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Kembali
                    </a>
                    <a href="{{ route('manajemen-ruang.edit', $ruangan->id) }}"
                        class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-md shadow-orange-200">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        Edit Ruangan
                    </a>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-6">

                <div class="w-full lg:w-1/3 flex flex-col gap-6">

                    <div
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 flex flex-col items-center text-center">
                        <div
                            class="w-32 h-32 mb-5 rounded-full overflow-hidden border-4 border-slate-50 shadow-inner bg-slate-100 flex items-center justify-center">
                            @if ($ruangan->gambar)
                                <img src="{{ asset('storage/' . $ruangan->gambar) }}" alt="{{ $ruangan->nama_ruang }}"
                                    class="w-full h-full object-cover">
                            @else
                                <i data-lucide="image" class="w-10 h-10 text-slate-300"></i>
                            @endif
                        </div>

                        <h2 class="text-xl font-bold text-slate-800 mb-1">{{ $ruangan->nama_ruang }}</h2>
                        <p class="text-sm text-slate-400 mb-4">{{ $ruangan->kategori }}</p>

                        <span
                            class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold tracking-wide bg-emerald-50 text-emerald-600 border border-emerald-100">
                            AKTIF
                        </span>
                    </div>

                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                        <h3 class="text-xs font-bold text-orange-500 tracking-wider uppercase mb-4">Fasilitas Tersedia</h3>
                        <div class="flex flex-col space-y-4">
                            @forelse($ruangan->fasilitas as $fas)
                                <div
                                    class="flex items-center justify-between pb-4 border-b border-slate-50 last:border-0 last:pb-0">
                                    <span class="text-sm font-medium text-slate-600">{{ $fas->nama_fasilitas }}</span>
                                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                                </div>
                            @empty
                                <p class="text-sm text-slate-400 italic text-center py-2">Tidak ada fasilitas.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <div
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden h-full flex flex-col">

                        <div class="px-8 py-5 border-b border-slate-100 flex items-center gap-3">
                            <div class="p-2 bg-orange-50 rounded-xl text-orange-500">
                                <i data-lucide="info" class="w-5 h-5"></i>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Informasi Spesifikasi</h2>
                        </div>

                        <div class="p-8 flex-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-6">

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Nama
                                        Ruangan</p>
                                    <div class="flex items-center gap-2 text-slate-800 font-semibold">
                                        <i data-lucide="door-open" class="w-4 h-4 text-slate-400"></i>
                                        {{ $ruangan->nama_ruang }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Kategori
                                    </p>
                                    <div class="flex items-center gap-2 text-slate-800 font-semibold">
                                        <i data-lucide="layout-grid" class="w-4 h-4 text-slate-400"></i>
                                        {{ $ruangan->kategori }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Lokasi
                                        Lantai</p>
                                    <div class="flex items-center gap-2 text-slate-800 font-semibold">
                                        <i data-lucide="layers" class="w-4 h-4 text-slate-400"></i>
                                        Lantai {{ $ruangan->lantai }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">
                                        Kapasitas Maksimal</p>
                                    <div class="flex items-center gap-2 text-slate-800 font-semibold">
                                        <i data-lucide="users" class="w-4 h-4 text-slate-400"></i>
                                        {{ $ruangan->kapasitas }} Orang
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Tanggal
                                        Didaftarkan</p>
                                    <div class="flex items-center gap-2 text-slate-800 font-medium">
                                        <i data-lucide="calendar" class="w-4 h-4 text-slate-400"></i>
                                        {{ $ruangan->created_at->format('d M Y') }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-1.5">Terakhir
                                        Diperbarui</p>
                                    <div class="flex items-center gap-2 text-slate-800 font-medium">
                                        <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                                        {{ $ruangan->updated_at->diffForHumans() }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="px-8 py-5 border-t border-slate-100 bg-slate-50/50 flex justify-between items-center">
                            <p class="text-xs text-slate-400 italic">
                                *Data ini merupakan data resmi sistem perpustakaan LibMate.
                            </p>

                            <form action="{{ route('manajemen-ruang.destroy', $ruangan->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ruangan ini secara permanen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-1.5 text-xs font-bold text-red-500 hover:text-red-600 transition-colors">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    Hapus Data Permanen
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
