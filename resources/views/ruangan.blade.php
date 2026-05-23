@extends('layouts.app')

@section('title', 'Eksplorasi Ruang - LibMate')

@section('content')
    <div class="bg-slate-50 dark:bg-slate-900 min-h-screen pb-20 transition-colors duration-300">

        <div class="pt-32 pb-12 text-center px-4 max-w-4xl mx-auto">
            <h1
                class="text-4xl md:text-5xl font-extrabold text-slate-800 dark:text-white tracking-tight mb-4 transition-colors">
                Eksplorasi Ruang <span class="text-orange-500">LIBMATE</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg transition-colors">
                Temukan ruang diskusi yang dirancang khusus untuk mendukung produktivitas Anda.
            </p>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="mb-10 bg-white dark:bg-slate-800 p-4 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col md:flex-row gap-4 justify-between items-center transition-colors">

                <div class="flex gap-2 overflow-x-auto w-full md:w-auto pb-2 md:pb-0 hide-scrollbar">
                    <a href="{{ route('ruangan.index') }}"
                        class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-semibold transition-all {{ !request('kategori') ? 'bg-orange-500 text-white shadow-md shadow-orange-200 dark:shadow-none' : 'bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700' }}">
                        Semua Ruang
                    </a>
                    @foreach ($kategoris as $kat)
                        <a href="{{ route('ruangan.index', ['kategori' => $kat, 'search' => request('search')]) }}"
                            class="whitespace-nowrap px-5 py-2 rounded-full text-sm font-semibold transition-all {{ request('kategori') == $kat ? 'bg-orange-500 text-white shadow-md shadow-orange-200 dark:shadow-none' : 'bg-slate-50 dark:bg-slate-900 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700' }}">
                            {{ $kat }}
                        </a>
                    @endforeach
                </div>

                <form action="{{ route('ruangan.index') }}" method="GET" class="w-full md:w-96 relative">
                    @if (request('kategori'))
                        <input type="hidden" name="kategori" value="{{ request('kategori') }}">
                    @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama ruangan..."
                        class="w-full pl-12 pr-4 py-3 rounded-full bg-slate-50 dark:bg-slate-900 border-none focus:ring-2 focus:ring-orange-500 text-sm transition-shadow text-slate-800 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500">
                    <svg class="w-5 h-5 text-slate-400 dark:text-slate-500 absolute left-4 top-1/2 -translate-y-1/2"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($ruangans as $ruang)
                    <div
                        class="bg-white dark:bg-slate-800 rounded-[2rem] overflow-hidden shadow-[0_4px_20px_-10px_rgba(0,0,0,0.1)] dark:shadow-none border border-slate-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-[0_8px_30px_-10px_rgba(249,115,22,0.2)] dark:hover:shadow-[0_8px_30px_-10px_rgba(249,115,22,0.4)] transition-all duration-300 group flex flex-col">

                        <div class="relative h-56 bg-slate-200 dark:bg-slate-700 overflow-hidden">
                            @if ($ruang->gambar)
                                <img src="{{ asset('storage/' . $ruang->gambar) }}" alt="{{ $ruang->nama_ruang }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif

                            <div
                                class="absolute top-4 right-4 bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm text-orange-600 dark:text-orange-400 font-bold text-[10px] px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm border border-orange-100 dark:border-orange-900/50">
                                Lantai {{ $ruang->lantai }}
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-1">
                            <span
                                class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">{{ $ruang->kategori }}</span>
                            <h3
                                class="text-xl font-bold text-slate-800 dark:text-white mb-3 group-hover:text-orange-500 transition-colors">
                                {{ $ruang->nama_ruang }}</h3>

                            <div class="flex items-center text-sm text-slate-500 dark:text-slate-400 font-medium mb-6">
                                <svg class="w-4 h-4 mr-2 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Kapasitas {{ $ruang->kapasitas }} Orang
                            </div>

                            <div class="mt-auto">
                                <a href="{{ route('ruangan.show', ['lantai' => $ruang->lantai, 'id' => $ruang->id]) }}"
                                    class="block w-full text-center bg-[#8B4513] hover:bg-[#6b340e] text-white font-bold py-3 rounded-xl transition-colors shadow-md">
                                    Detail Ruangan
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full text-center py-20 bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700 transition-colors">
                        <svg class="w-16 h-16 text-slate-300 dark:text-slate-600 mx-auto mb-4" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                        <h3 class="text-lg font-bold text-slate-700 dark:text-slate-200">Ruangan tidak ditemukan</h3>
                        <p class="text-slate-500 dark:text-slate-400 mt-1">Coba gunakan kata kunci atau kategori lain.</p>
                        <a href="{{ route('ruangan.index') }}"
                            class="mt-4 inline-block text-orange-500 font-semibold hover:underline">Reset Pencarian</a>
                    </div>
                @endforelse
            </div>

            @if ($ruangans->hasPages())
                <div class="mt-12 flex justify-center relative z-20 pointer-events-auto">
                    {{ $ruangans->links() }}
                </div>
            @endif

        </div>
    </div>

    <style>
        /* CSS tambahan untuk menyembunyikan scrollbar pada filter kategori tapi tetap bisa di-scroll */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
