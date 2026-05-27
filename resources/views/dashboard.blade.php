@extends('layouts.dashboard.app')

@section('title', 'Dashboard Manajemen Ruang')

@section('content')
    <main class="flex-1 h-full overflow-y-auto md:pt-16 lg:pt-0">
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

        </div>
    </main>

@endsection

@push('scripts')
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
