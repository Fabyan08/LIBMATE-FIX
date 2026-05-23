@extends('layouts.dashboard.app')

@section('title', 'Kelola Data Mahasiswa')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
        <div class="p-6 md:p-8 lg:p-10 max-w-7xl mx-auto">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Manajemen Data Mahasiswa
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">
                        Daftar anggota mahasiswa perpustakaan, informasi kontak, dan status keanggotaan.
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

                    <form action="{{ route('manajemen-mahasiswa') }}" method="GET" class="relative w-full md:w-96">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama mahasiswa atau NIM..."
                            class="w-full bg-white border border-slate-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all" />

                        <button type="submit" class="hidden"></button>
                    </form>
                    @if (request('search'))
                        <a href="{{ route('manajemen-mahasiswa') }}"
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
                                <th class="px-6 py-4">Foto Profil</th>
                                <th class="px-6 py-4">Informasi Mahasiswa</th>
                                <th class="px-6 py-4">Fakultas</th>
                                <th class="px-6 py-4">Kontak</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">

                            @forelse ($mahasiswa as $mhs)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="flex items-center justify-center">
                                        <div
                                            class="w-12 h-12 rounded-full overflow-hidden bg-slate-100 flex items-center justify-center">
                                            @if ($mhs->foto)
                                                <img src="{{ asset('storage/' . $mhs->foto) }}"
                                                    alt="Foto {{ $mhs->nama }}" class="w-full h-full object-cover">
                                            @else
                                                <i data-lucide="user" class="w-6 h-6 text-slate-400"></i>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $mhs->name }}</div>
                                        <div class="text-xs text-slate-400">NIM: {{ $mhs->nim }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="flex items-center gap-1.5 text-slate-600 text-sm">
                                            <i data-lucide="graduation-cap" class="w-4 h-4 text-slate-400"></i>
                                            {{ $mhs->fakultas }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1.5 text-slate-600 text-sm">
                                            <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                                            {{ $mhs->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @php
                                            $badges = [
                                                'Aktif' => 'bg-emerald-100 text-emerald-700',
                                                'Suspended' => 'bg-red-100 text-red-700',
                                                'Cuti' => 'bg-orange-100 text-orange-700',
                                            ];
                                            $badgeClass = $badges[$mhs->status] ?? 'bg-slate-100 text-slate-700';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeClass }}">
                                            {{ $mhs->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('manajemen-mahasiswa.show', $mhs->id) }}"
                                                class="p-2 text-slate-400 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition">
                                                <i data-lucide="eye" class="w-4 h-4"></i>
                                            </a>
                                            <a href="{{ route('manajemen-mahasiswa.edit', $mhs->id) }}"
                                                class="p-2 text-slate-400 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition">
                                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                            </a>
                                            <form action="{{ route('manajemen-mahasiswa.destroy', $mhs->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?');">
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
                @if ($mahasiswa->hasPages())
                    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                        {{ $mahasiswa->links() }}
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
