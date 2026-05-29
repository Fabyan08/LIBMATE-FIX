@extends('layouts.dashboard.app')
@section('title', 'Manajemen Kontak')

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
            </header>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div
                    class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row gap-4 justify-between items-center">

                    <form action="{{ route('manajemen-kontak') }}" method="GET" class="relative w-full md:w-96">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}" id="search-input"
                            placeholder="Cari nama kontak atau email..."
                            class="w-full bg-white border border-slate-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all" />

                        <i data-lucide="loader-2" id="search-loading"
                            class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-orange-500 animate-spin hidden"></i>
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
                                <th class="px-6 py-4 text-center">Detail</th>
                            </tr>
                        </thead>
                        <tbody id="table-body" class="divide-y divide-slate-100">

                            @forelse ($kontaks as $kontak)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $kontak->nama }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-600">{{ $kontak->email }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-slate-800">{{ $kontak->subjek }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-slate-500 max-w-xs truncate">{{ $kontak->pesan }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button type="button" onclick="openModal(this)" data-nama="{{ $kontak->nama }}"
                                            data-email="{{ $kontak->email }}" data-subjek="{{ $kontak->subjek }}"
                                            data-pesan="{{ $kontak->pesan }}"
                                            class="text-sm text-orange-500 hover:text-orange-700 hover:bg-orange-50 p-2 rounded-lg font-semibold transition inline-flex items-center justify-center">
                                            <i data-lucide="eye" class="w-5 h-5"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center">
                                        <div class="flex flex-col items-center justify-center text-slate-400">
                                            <i data-lucide="inbox" class="w-12 h-12 mb-3 opacity-20"></i>
                                            <p>Data pesan kontak tidak ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                @if ($kontaks->hasPages())
                    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                        {{ $kontaks->links() }}
                    </div>
                @endif

            </div>
        </div>

        <div id="modal-detail" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity opacity-0" id="modal-overlay"
                onclick="closeModal()"></div>

            <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                    <div id="modal-content"
                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 scale-95 duration-300">

                        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-slate-100">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-orange-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <i data-lucide="mail" class="h-5 w-5 text-orange-600"></i>
                                </div>
                                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                    <h3 class="text-lg font-bold leading-6 text-slate-900" id="modal-title">Detail Pesan
                                        Masuk</h3>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white px-4 py-5 sm:p-6 space-y-4">
                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Pengirim</h4>
                                <p class="text-sm font-semibold text-slate-800" id="detail-nama">-</p>
                                <p class="text-sm text-slate-500" id="detail-email">-</p>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Subjek</h4>
                                <p class="text-sm font-semibold text-slate-800" id="detail-subjek">-</p>
                            </div>

                            <div>
                                <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Isi Pesan</h4>
                                <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 mt-1">
                                    <p class="text-sm text-slate-700 whitespace-pre-wrap leading-relaxed" id="detail-pesan">
                                        -</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-slate-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" onclick="closeModal()"
                                class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-100 sm:mt-0 sm:w-auto transition-colors">
                                Tutup
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script>
        // Fungsi untuk membuka modal dan mengisi detail pesan berdasarkan data atribut pada tombol yang diklik
        function openModal(button) {

            const nama = button.getAttribute('data-nama');
            const email = button.getAttribute('data-email');
            const subjek = button.getAttribute('data-subjek');
            const pesan = button.getAttribute('data-pesan');


            document.getElementById('detail-nama').textContent = nama;
            document.getElementById('detail-email').textContent = email;
            document.getElementById('detail-subjek').textContent = subjek;
            document.getElementById('detail-pesan').textContent = pesan;


            const modal = document.getElementById('modal-detail');
            const overlay = document.getElementById('modal-overlay');
            const content = document.getElementById('modal-content');

            modal.classList.remove('hidden');


            void modal.offsetWidth;

            overlay.classList.remove('opacity-0');
            overlay.classList.add('opacity-100');

            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        }


        function closeModal() {
            const modal = document.getElementById('modal-detail');
            const overlay = document.getElementById('modal-overlay');
            const content = document.getElementById('modal-content');

            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');

            content.classList.remove('opacity-100', 'scale-100');
            content.classList.add('opacity-0', 'scale-95');


            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
        // Script untuk menangani pencarian langsung (live search) dengan AJAX saat pengguna mengetik di input pencarian
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const tableBody = document.getElementById('table-body');
            const loadingIcon = document.getElementById('search-loading');

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            let debounceTimer;

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const query = this.value;

                    if (loadingIcon) loadingIcon.classList.remove('hidden');

                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(async () => {
                        try {

                            const response = await fetch(
                                `{{ route('manajemen-kontak') }}?search=${encodeURIComponent(query)}`, {
                                    method: 'GET',
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'text/html'
                                    }
                                });

                            if (!response.ok) throw new Error('Gagal memuat data');

                            const html = await response.text();

                            if (tableBody) tableBody.innerHTML = html;

                            if (typeof lucide !== 'undefined') {
                                lucide.createIcons();
                            }

                        } catch (error) {
                            console.error('Error during live search:', error);
                        } finally {
                            if (loadingIcon) loadingIcon.classList.add('hidden');
                        }
                    }, 500);
                });
            }
        });
    </script>
@endpush
