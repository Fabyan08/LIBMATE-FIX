{{-- @extends('layouts.dashboard.app')

@section('title', 'Manajemen Pesan Kontak')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0 bg-slate-50">
        <div class="p-6 md:p-8 lg:p-10 max-w-7xl mx-auto">
            <header class="mb-8">
                <h1 class="text-2xl font-bold text-slate-800">Manajemen Pesan Kontak</h1>
                <p class="text-sm text-slate-400 mt-1">Daftar pesan masuk dari customer LibMate.</p>
            </header>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Nama</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Email</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Subjek</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Pesan</th>
                            <th class="px-6 py-4 text-sm font-bold text-slate-600">Diterima</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($kontaks as $item)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-sm text-slate-700 font-semibold">{{ $item->nama }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500">{{ $item->email }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700">{{ $item->subjek }}</td>
                                <td class="px-6 py-4 text-sm text-slate-500 max-w-xs truncate">{{ $item->pesan }}</td>
                                <td class="px-6 py-4 text-sm text-slate-400">{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    Belum ada pesan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kontaks->hasPages())
                <div class="mt-6">
                    {{ $kontaks->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection --}}
@extends('layouts.dashboard.app')

@section('title', 'Kelola Data Mahasiswa')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
        <div class="p-6 md:p-8 lg:p-10 max-w-7xl mx-auto">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Manajemen Kontak
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">
                        Daftar pesan masuk.
                    </p>
                </div>

                {{-- <div class="flex items-center gap-4 w-full md:w-auto">
                    <a href="{{ route('manajemen-mahasiswa.create') }}"
                        class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-md shadow-orange-200">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Tambah Mahasiswa
                    </a>
                </div> --}}
            </header>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div
                    class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row gap-4 justify-between items-center">

                    <form action="{{ route('manajemen-kontak') }}" method="GET" class="relative w-full md:w-96">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama kontak atau email..."
                            class="w-full bg-white border border-slate-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all" />

                        <button type="submit" class="hidden"></button>
                    </form>
                    @if (request('search'))
                        <a href="{{ route('manajemen-kontak') }}"
                            class="text-sm text-slate-500 hover:text-slate-900 flex items-center gap-1.5 transition">
                            <i data-lucide="x" class="w-4 h-4"></i>
                            Reset
                        </a>
                    @endif

                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead
                            class="bg-slate-50 text-slate-600 font-semibold text-xs uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Subjek</th>
                                <th class="px-6 py-4">Pesan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

                            @forelse ($kontaks as $kontak)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $kontak->nama }}</div>
                                        <div class="text-xs text-slate-400">Email: {{ $kontak->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $kontak->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $kontak->subjek }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-500 max-w-xs truncate">{{ $kontak->pesan }}</div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center justify-center text-slate-400">
                                            <i data-lucide="user-x" class="w-12 h-12 mb-3 opacity-20"></i>
                                            <p>Data mahasiswa tidak ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links Laravel --}}
                @if ($kontaks->hasPages())
                    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                        {{ $kontaks->links() }}
                    </div>
                @endif

            </div>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const tableBody = document.getElementById('table-body');
            const loadingIcon = document.getElementById('search-loading');


            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            let debounceTimer;

            searchInput.addEventListener('input', function() {
                const query = this.value;


                loadingIcon.classList.remove('hidden');


                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(async () => {
                    try {

                        const response = await fetch(
                            `{{ route('manajemen-mahasiswa') }}?search=${encodeURIComponent(query)}`, {
                                method: 'GET',
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                    'X-CSRF-TOKEN': csrfToken 'Accept': 'text/html'
                                }
                            });

                        if (!response.ok) throw new Error('Gagal memuat data');

                        const html = await response.text();


                        tableBody.innerHTML = html;


                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }

                    } catch (error) {
                        console.error('Error during live search:', error);
                    } finally {

                        loadingIcon.classList.add('hidden');
                    }
                }, 500);
            });
        });
    </script>
@endpush
