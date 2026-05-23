@extends('layouts.dashboard.app')

@section('title', 'Dashboard Manajemen Ruang')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
        <div class="p-6 md:p-8 lg:p-10 max-w-7xl mx-auto">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Manajemen Ruang Perpustakaan
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">
                        Kelola jadwal, tambah pemesanan, dan pantau ketersediaan ruang
                        diskusi.
                    </p>
                </div>

                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <i data-lucide="search"
                            class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" placeholder="Cari sesuatu..."
                            class="w-full bg-white border-none rounded-full py-2.5 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 shadow-sm text-slate-600 placeholder-slate-400" />
                    </div>
                    <button class="bg-white p-2.5 rounded-full shadow-sm text-slate-500 hover:text-orange-400 relative">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                </div>
            </header>

            <div
                class="bg-gradient-to-r from-orange-400 to-orange-300 rounded-3xl p-6 md:p-8 flex items-center justify-between shadow-lg shadow-orange-200/50 mb-8 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-10 rounded-full"></div>
                <div class="absolute right-20 -bottom-10 w-32 h-32 bg-white opacity-10 rounded-full"></div>

                <div class="relative z-10 text-white">
                    <h2 class="text-2xl font-bold mb-2">Selamat Pagi, {{ Auth::user()->name }}! ✨</h2>
                    <p class="text-orange-50 text-sm md:text-base max-w-3xl">
                        Siap untuk mengelola ruang diskusi hari ini? Pastikan semua
                        pemesanan terorganisir dengan baik dan ruang selalu siap untuk
                        digunakan.
                    </p>
                    <button
                        class="mt-4 bg-white text-orange-500 font-semibold py-2 px-6 rounded-full text-sm hover:bg-orange-50 transition-colors shadow-sm">
                        Mulai Bekerja
                    </button>
                </div>

                <div class="hidden md:flex relative z-10">
                    <i data-lucide="coffee" class="w-24 h-24 text-white opacity-80"></i>
                </div>
            </div>

            {{-- <section class="bg-slate-50" id="booking-management">
                <div class="mx-auto">
                    <div class="mb-10">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                            <x-dashboard.stat-card judul="Total Pemesanan" ikon="clipboard-list" warna="blue"
                                id="stat-total-booking" nilai="0" />

                            <x-dashboard.stat-card judul="Pemesanan Hari Ini" ikon="clock" warna="orange"
                                id="stat-today-booking" nilai="0" />

                            <x-dashboard.stat-card judul="Total Orang (Kapasitas)" ikon="users" warna="red"
                                id="stat-total-people" nilai="0" />

                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm h-fit">
                            <h3 class="font-bold text-slate-900 mb-4 text-lg" id="form-title">
                                Form Pemesanan Baru
                            </h3>
                            <form id="booking-form" class="space-y-4">
                                <input type="hidden" id="edit-id" value="" />

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">ID Booking
                                        (Otomatis)</label>
                                    <input type="text" id="input-book-id" readonly
                                        class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-slate-50 text-slate-500 cursor-not-allowed focus:outline-none text-sm font-bold" />
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama
                                        Mahasiswa</label>
                                    <input type="text" id="input-name" placeholder="Nama Lengkap"
                                        class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition text-sm" />
                                    <span class="text-xs text-red-500 hidden mt-1" id="err-name">Nama wajib
                                        diisi!</span>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Pilih Ruangan
                                        (Kategori)</label>
                                    <select id="input-room"
                                        class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition text-sm">
                                        <option value="">-- Pilih Ruang --</option>
                                        <option value="Lantai 1 - Ruang Diskusi Terbuka">
                                            Lantai 1 - Ruang Diskusi Terbuka
                                        </option>
                                        <option value="Lantai 2 - Ruang Tenang (A)">
                                            Lantai 2 - Ruang Tenang (A)
                                        </option>
                                        <option value="Lantai 2 - Ruang Tenang (B)">
                                            Lantai 2 - Ruang Tenang (B)
                                        </option>
                                        <option value="Lantai 3 - Ruang Multimedia">
                                            Lantai 3 - Ruang Multimedia
                                        </option>
                                    </select>
                                    <span class="text-xs text-red-500 hidden mt-1" id="err-room">Silakan pilih
                                        ruangan!</span>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Kapasitas
                                            (Orang)</label>
                                        <input type="number" id="input-capacity" min="1" max="10"
                                            class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition text-sm" />
                                        <span class="text-xs text-red-500 hidden mt-1" id="err-capacity">Wajib &
                                            Maks 10!</span>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                                        <input type="date" id="input-date"
                                            class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition text-sm" />
                                        <span class="text-xs text-red-500 hidden mt-1" id="err-date">Pilih
                                            tanggal!</span>
                                    </div>
                                </div>

                                <div class="pt-2 flex gap-2">
                                    <button type="submit" id="btn-submit"
                                        class="flex-1 bg-orange-600 text-white py-2.5 rounded-lg font-semibold hover:bg-orange-700 transition shadow-sm text-sm">
                                        Simpan Pesanan
                                    </button>
                                    <button type="button" id="btn-cancel-edit"
                                        class="hidden px-4 bg-slate-200 text-slate-700 py-2.5 rounded-lg font-semibold hover:bg-slate-300 transition text-sm">
                                        Batal
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="lg:col-span-2">
                            <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                                <div class="flex flex-col md:flex-row gap-4 mb-6">
                                    <div class="flex-1 relative">
                                        <input type="text" id="search-data" placeholder="Cari ID atau Nama Pemesan..."
                                            class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition text-sm" />
                                        <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <select id="filter-data"
                                        class="md:w-64 px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition text-sm">
                                        <option value="All">Semua Lantai / Ruangan</option>
                                        <option value="Lantai 1">Lantai 1</option>
                                        <option value="Lantai 2">Lantai 2</option>
                                        <option value="Lantai 3">Lantai 3</option>
                                    </select>
                                </div>

                                <div class="overflow-x-auto rounded-xl border border-slate-200">
                                    <table class="min-w-full text-sm text-left">
                                        <thead class="bg-slate-50 text-slate-600 font-semibold border-b border-slate-200">
                                            <tr>
                                                <th class="px-4 py-3">ID</th>
                                                <th class="px-4 py-3">Nama & Ruang</th>
                                                <th class="px-4 py-3">Jadwal & Kapasitas</th>
                                                <th class="px-4 py-3 text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body" class="divide-y divide-slate-100"></tbody>
                                    </table>

                                    <div id="empty-state"
                                        class="hidden flex-col items-center justify-center py-12 text-slate-400">
                                        <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                            </path>
                                        </svg>
                                        <p>Belum ada data pemesanan ruangan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
        </div>
    </main>

@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
