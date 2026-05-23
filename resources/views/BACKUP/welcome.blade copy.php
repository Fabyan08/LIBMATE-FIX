@extends('layouts.app')

@section('title', 'Dashboard | LibMate Universitas Jember')

@section('content')
    <main style="background-image: url('{{ asset('unej.png') }}')"
        class="md:bg-[length:200%] bg-[length:1000%] bg-top bg-no-repeat md:min-h-screen">
        <div class="maskot fixed -bottom-20 -left-12 w-96">
            <img src="{{ asset('maskot.png') }}" alt="" class="animate-bounce">
        </div>
        <div id="weather-mascot-btn"
            class="maskot fixed -bottom-20 -left-12 w-96 z-50 cursor-pointer group hover:-translate-y-2 transition-transform duration-300">
            <div
                class="absolute -top-20 left-32 bg-white px-4 py-2 rounded-2xl shadow-xl border border-orange-200 text-sm font-bold text-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Cek Cuaca Jember! 🌤️
            </div>
            <img src="{{ asset('maskot.png') }}" alt="Maskot LibMate" class="animate-bounce drop-shadow-2xl">
        </div>

        <div id="weather-overlay"
            class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-500">
        </div>

        <div id="weather-popup"
            class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white/95 backdrop-blur-xl border-t border-x border-white/60 shadow-[0_-20px_40px_rgba(0,0,0,0.15)] rounded-t-[2.5rem] p-8 z-[70] transform translate-y-full transition-transform duration-500 ease-out">

            <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-6"></div>

            <button id="close-weather-popup"
                class="absolute top-6 right-6 p-2 bg-slate-100 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="text-slate-800 font-extrabold text-xl mb-6 flex items-center justify-center gap-2">
                <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                </svg>
                Cuaca Saat Ini
            </h2>

            <div id="weather-loading" class="flex flex-col items-center justify-center py-8 space-y-4">
                <div class="flex space-x-2">
                    <div class="w-3.5 h-3.5 bg-orange-500 rounded-full animate-bounce" style="animation-delay: -0.3s"></div>
                    <div class="w-3.5 h-3.5 bg-orange-500 rounded-full animate-bounce" style="animation-delay: -0.15s">
                    </div>
                    <div class="w-3.5 h-3.5 bg-orange-500 rounded-full animate-bounce"></div>
                </div>
                <p class="text-sm font-medium text-slate-500 animate-pulse">Menghubungi satelit cuaca...</p>
            </div>

            <div id="weather-content" class="hidden text-center py-2">
                <h3 id="w-city" class="text-3xl font-black text-slate-800 tracking-tight mb-2"></h3>
                <div class="flex justify-center items-start mb-6">
                    <span id="w-temp" class="text-[5rem] font-black text-orange-500 leading-none drop-shadow-md"></span>
                    <span class="text-3xl font-bold text-orange-400 mt-2">°C</span>
                </div>
                <div
                    class="inline-block px-6 py-2 bg-gradient-to-r from-orange-50 to-orange-100 border border-orange-200 rounded-full shadow-sm">
                    <p id="w-desc" class="text-base font-bold text-orange-700 capitalize"></p>
                </div>
            </div>

            <div id="weather-error" class="hidden text-center py-8">
                <div class="w-14 h-14 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-red-500">Gagal memuat data cuaca.<br>Coba lagi nanti.</p>
            </div>
        </div>
        <script></script>
        <section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full pointer-events-none">
                <div
                    class="absolute top-20 left-10 w-72 h-72 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
                </div>
                <div
                    class="absolute top-20 right-10 w-72 h-72 bg-orange-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-8 left-1/2 -translate-x-1/2 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <div class="flex items-center justify-center pb-2 w-full">
                    <img src="{{ asset('unej-logo.png') }}" alt="logo" width="100" class="animate-ping" />
                </div>

                <h1
                    class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight max-w-4xl mx-auto">
                    Pemesanan Ruang Perpus <br class="hidden md:block" />
                    <span class="text-orange-500">Universitas Jember</span>
                </h1>

                <p class="text-lg md:text-xl text-slate-500 mb-10 max-w-2xl mx-auto font-medium leading-relaxed">
                    LibMate membantu mahasiswa memesan ruang diskusi perpustakaan dengan
                    mudah dan memberikan rekomendasi cerdas untuk waktu dan ruangan
                    terbaik berdasarkan kebiasaan Anda.
                </p>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-16">
                    <a href="#ai-assistant"
                        class="w-full sm:w-auto px-8 py-4 rounded-full bg-white text-slate-700 font-semibold text-lg border border-slate-200 hover:bg-slate-50 shadow-sm transition-all flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                            </path>
                        </svg>
                        Cek Ruangan Kosong
                    </a>
                    <a href="#"
                        class="w-full sm:w-auto px-8 py-4 rounded-full bg-orange-600 text-white font-semibold text-lg hover:bg-orange-700 shadow-lg shadow-orange-500/30 transition-all hover:-translate-y-1 flex items-center justify-center gap-2">
                        Pesan Ruangan
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                </div>

                <div class="relative max-w-5xl mx-auto mt-12 animate-float-delayed">
                    <div class="relative rounded-2xl bg-white border border-slate-100 shadow-2xl overflow-hidden z-10">
                        <div class="bg-slate-50 border-b border-slate-100 px-4 py-3 flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            <div
                                class="mx-auto text-xs font-medium text-slate-400 bg-white px-3 py-1 rounded-md border border-slate-100 shadow-sm">
                                libmate.unej.ac.id
                            </div>
                        </div>
                        <div class="flex h-[400px] md:h-[500px]">
                            <div class="w-16 md:w-64 border-r border-slate-100 bg-slate-50 p-4 hidden sm:block">
                                <div class="space-y-4">
                                    <div
                                        class="h-10 w-full bg-white rounded-lg shadow-sm border border-slate-100 flex items-center px-3 gap-3">
                                        <div
                                            class="w-5 h-5 rounded bg-orange-100 text-orange-600 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="h-2 w-20 bg-slate-200 rounded hidden md:block"></div>
                                    </div>
                                    <div class="h-10 w-full bg-transparent rounded-lg flex items-center px-3 gap-3">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-200 text-slate-400 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="h-2 w-16 bg-slate-200 rounded hidden md:block"></div>
                                    </div>
                                    <div class="h-10 w-full bg-transparent rounded-lg flex items-center px-3 gap-3">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-200 text-slate-400 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="h-2 w-24 bg-slate-200 rounded hidden md:block"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-1 p-6 md:p-8 bg-white text-left relative">
                                <div class="h-6 w-48 bg-slate-100 rounded-md mb-6"></div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                                    <div
                                        class="h-24 rounded-xl bg-gradient-to-br from-orange-50 to-orange-50 border border-orange-100 p-4">
                                        <div class="h-3 w-20 bg-orange-200 rounded mb-3"></div>
                                        <div class="h-8 w-12 bg-orange-600 rounded"></div>
                                    </div>
                                    <div class="h-24 rounded-xl bg-slate-50 border border-slate-100 p-4">
                                        <div class="h-3 w-24 bg-slate-200 rounded mb-3"></div>
                                        <div class="h-8 w-16 bg-slate-300 rounded"></div>
                                    </div>
                                    <div class="h-24 rounded-xl bg-slate-50 border border-slate-100 p-4 hidden md:block">
                                        <div class="h-3 w-16 bg-slate-200 rounded mb-3"></div>
                                        <div class="h-8 w-10 bg-slate-300 rounded"></div>
                                    </div>
                                </div>
                                <div class="h-4 w-32 bg-slate-100 rounded-md mb-4"></div>
                                <div class="space-y-3">
                                    <div class="h-12 w-full bg-slate-50 rounded-lg border border-slate-100"></div>
                                    <div class="h-12 w-full bg-slate-50 rounded-lg border border-slate-100"></div>
                                    <div class="h-12 w-full bg-slate-50 rounded-lg border border-slate-100"></div>
                                </div>

                                <div
                                    class="absolute bottom-6 right-6 w-64 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden hidden md:flex flex-col">
                                    <div class="bg-orange-600 px-4 py-3 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        <span class="text-xs font-semibold text-white">LibMate AI</span>
                                    </div>
                                    <div
                                        class="p-3 bg-slate-50 text-xs text-slate-600 leading-relaxed border-b border-slate-100">
                                        Halo! Apakah kamu ingin memesan ruangan di lantai 2?
                                    </div>
                                    <div class="p-2 flex gap-2 bg-white">
                                        <div
                                            class="flex-1 py-1.5 bg-orange-50 text-orange-600 text-center rounded text-xs font-medium cursor-pointer border border-orange-100 hover:bg-orange-100">
                                            Ya, Pesankan
                                        </div>
                                        <div
                                            class="flex-1 py-1.5 bg-slate-50 text-slate-500 text-center rounded text-xs font-medium cursor-pointer border border-slate-200 hover:bg-slate-100">
                                            Opsi Lain
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute -left-6 bg-white top-1/4 glass-panel rounded-xl p-4 shadow-xl z-20 flex items-center gap-4 animate-float hidden lg:flex">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-500 font-medium">Status Ruangan</p>
                            <p class="text-sm font-bold text-slate-800">
                                Ruang Lantai 2 Tersedia Sekarang!
                            </p>
                        </div>
                    </div>

                    <div class="absolute -right-12 top-1/2 glass-panel rounded-xl p-4 shadow-xl z-20 animate-float hidden lg:block border border-orange-100"
                        style="animation-delay: 1s">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span class="text-xs font-bold text-orange-600 uppercase tracking-wide">Rekomendasi
                                AI</span>
                        </div>
                        <p class="text-sm font-semibold text-slate-800 mb-1">
                            Zona Tenang - Lantai 2
                        </p>
                        <p class="text-xs text-slate-500">
                            Cocok untuk mengerjakan tugas dengan tenang!
                        </p>
                        <div class="mt-3 flex justify-end">
                            <button
                                class="text-xs bg-orange-50 text-orange-600 px-3 py-1 rounded-full font-semibold hover:bg-orange-100">
                                Pesan →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-10 border-y border-slate-200 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x divide-slate-100">
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">
                            10+
                        </h4>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">
                            Tempat tersedia
                        </p>
                    </div>
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">
                            500+
                        </h4>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">
                            Mahasiswa Terlayani
                        </p>
                    </div>
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">
                            2000+
                        </h4>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">
                            Pemesanan Berhasil
                        </p>
                    </div>
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-orange-600 mb-2">
                            98%
                        </h4>
                        <p class="text-sm font-medium text-slate-500 uppercase tracking-wide">
                            Kepuasan Mahasiswa
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-orange-600 font-semibold text-sm uppercase tracking-wider">Fitur Utama</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-bold text-slate-900">
                        Pengalaman Pesan Ruang Perpus yang Beda!
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">
                            Pemesanan Ruang Cepat
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Mahasiswa dapat dengan mudah memesan ruang diskusi dalam
                            hitungan detik dengan antarmuka yang mulus dan intuitif.
                        </p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">
                            Rekomendasi Jadwal AI
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            AI kami menyarankan waktu dan ruang belajar terbaik yang
                            tersedia berdasarkan preferensi Anda dan jam sibuk kampus.
                        </p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">
                            Pelacak Ketersediaan Ruangan
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Periksa status ruangan secara real-time untuk melihat mana yang
                            terisi dan mana yang kosong bahkan sebelum Anda masuk
                            perpustakaan.
                        </p>
                    </div>

                    <div
                        class="bg-white rounded-2xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <div
                            class="absolute -right-6 -top-6 w-24 h-24 bg-orange-100 rounded-full blur-2xl opacity-50 pointer-events-none">
                        </div>

                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">
                            Asisten Chat AI
                        </h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Tanyakan kepada AI tentang ketersediaan ruangan, jadwal, atau
                            aturan perpustakaan secara instan melalui chatbot cerdas.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works" class="py-24 bg-white border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-20">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">
                        Pesan Ruangan dalam 3 Langkah Mudah
                    </h2>
                    <p class="text-lg text-slate-500">
                        Tidak perlu lagi berkeliling mencari tempat. Dapatkan ruangan
                        dengan cepat.
                    </p>
                </div>

                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                        <div class="text-center relative">
                            <div
                                class="w-20 h-20 mx-auto bg-white border-4 border-slate-50 rounded-full shadow-lg shadow-slate-200 flex items-center justify-center text-2xl font-bold text-orange-600 mb-6">
                                1
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">Cari</h3>
                            <p class="text-slate-500 text-sm max-w-xs mx-auto">
                                Telusuri ruang diskusi yang tersedia di seluruh perpustakaan
                                Universitas Jember secara real-time.
                            </p>
                        </div>

                        <div class="text-center relative">
                            <div
                                class="w-20 h-20 mx-auto bg-white border-4 border-orange-50 rounded-full shadow-lg flex items-center justify-center text-2xl font-bold text-orange-600 mb-6 relative">
                                <div class="absolute inset-0 bg-white rounded-full blur-md opacity-20 animate-pulse">
                                </div>
                                2
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">
                                Dapatkan Rekomendasi AI
                            </h3>
                            <p class="text-slate-500 text-sm max-w-xs mx-auto">
                                Biarkan AI kami menyarankan ruang dan waktu terbaik
                                berdasarkan pemesanan sebelumnya dan preferensi Anda.
                            </p>
                        </div>

                        <div class="text-center relative">
                            <div
                                class="w-20 h-20 mx-auto bg-white border-4 border-slate-50 rounded-full shadow-lg shadow-slate-200 flex items-center justify-center text-2xl font-bold text-orange-600 mb-6">
                                3
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2">
                                Pesan Instan
                            </h3>
                            <p class="text-slate-500 text-sm max-w-xs mx-auto">
                                Konfirmasi pesanan Anda dengan satu klik saja!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ai-assistant" class="py-24 bg-orange-400 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/20 md:bg-white rounded-full blur-[120px] pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-white/20 rounded-full blur-[100px] pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-16">
                    <div class="lg:w-1/2 text-left">
                        <span
                            class="inline-block py-1 px-3 rounded-full bg-white/20 text-white text-sm font-semibold mb-6 border border-white">Asisten
                            Chat AI</span>
                        <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
                            Asisten Perpustakaan Pribadi Anda
                        </h2>
                        <p class="text-white text-lg mb-8 leading-relaxed">
                            Tidak ingin repot melihat jadwal? Tanya saja LibMate. AI
                            generatif kami memahami bahasa sehari-hari untuk menemukan dan
                            memesan tempat yang tepat untuk Anda dalam hitungan detik.
                        </p>
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-start gap-3 text-white">
                                <svg class="w-6 h-6 text-white shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>"Carikan ruang tenang untuk 3 orang jam 2 siang ini"</span>
                            </li>
                            <li class="flex items-start gap-3 text-white">
                                <svg class="w-6 h-6 text-white shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>"Batalkan pesanan saya untuk Ruang 4"</span>
                            </li>
                            <li class="flex items-start gap-3 text-white">
                                <svg class="w-6 h-6 text-white shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>"Lantai mana yang area belajarnya paling sepi saat
                                    ini?"</span>
                            </li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center gap-2 text-white font-semibold hover:text-orange-300 transition-colors">
                            Jelajahi Kemampuan AI
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="lg:w-1/2 w-full max-w-md mx-auto">
                        <div class="bg-white rounded-2xl border border-white shadow-2xl overflow-hidden">
                            <div
                                class="bg-white shadow-md backdrop-blur-sm border-b p-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="relative">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gradient-to-r from-orange-500 to-orange-500 flex items-center justify-center shadow-lg">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div
                                            class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-slate-800 rounded-full">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="text-slate-500 font-semibold text-sm">
                                            LibMate AI
                                        </h4>
                                        <p class="text-slate-400 text-xs">Online</p>
                                    </div>
                                </div>
                            </div>

                            <div class="p-4 space-y-4 h-80 overflow-y-auto bg-white">
                                <div class="flex justify-end">
                                    <div
                                        class="bg-orange-400 shadow-sm text-white rounded-2xl rounded-tr-sm px-4 py-2 text-sm max-w-[80%]">
                                        Saya butuh ruang untuk kerja kelompok (4 orang) sekitar
                                        jam 3 sore ini.
                                    </div>
                                </div>

                                <div class="flex justify-start">
                                    <div
                                        class="bg-slate-200 border text-slate-200 rounded-2xl rounded-tl-sm px-4 py-3 text-sm max-w-[85%]">
                                        <p class="mb-2 text-slate-500">
                                            Saya menemukan 2 pilihan sempurna untuk kelompok Anda
                                            pada 15:00:
                                        </p>
                                        <div class="bg-orange-900 rounded-lg p-3 border border-slate-700 mb-2">
                                            <div class="flex justify-between items-center mb-1">
                                                <span class="font-bold text-white">Kursi Ruang B</span>
                                                <span
                                                    class="text-xs bg-green-500/20 text-green-400 px-2 py-0.5 rounded">Tersedia</span>
                                            </div>
                                            <p class="text-xs text-white">Lantai 2 • Kapasitas 6</p>
                                        </div>
                                        <button
                                            class="w-full bg-orange-400 hover:bg-orange-500 text-white font-semibold py-1.5 rounded-lg text-xs transition-colors">
                                            Pesan Ruang B
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 bg-white shadow-md border-t">
                                <div class="relative">
                                    <input type="text" placeholder="Ketik pesan..."
                                        class="w-full bg-slate-200 text-sm text-slate-900 placeholder-slate-400 rounded-full py-3 pl-4 pr-12 border border-slate-100 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-colors" />
                                    <button
                                        class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-orange-600 rounded-full flex items-center justify-center text-white hover:bg-orange-500 transition-colors">
                                        <svg class="w-4 h-4 ml-0.5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">
                        Riwayat Pemesanan Ruangan
                    </h2>
                    <p class="text-slate-500">
                        Cari dan filter data pemesanan ruang diskusi Anda
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm">
                        <h3 class="font-semibold text-slate-900 mb-4">Filter</h3>

                        <div class="mb-6">
                            <p class="text-sm font-medium text-slate-600 mb-2">Lantai</p>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="accent-orange-500" />
                                    <span class="text-sm">Lantai 1</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="accent-orange-500" />
                                    <span class="text-sm">Lantai 2</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="accent-orange-500" />
                                    <span class="text-sm">Lantai 3</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-slate-600 mb-2">Status</p>
                            <div class="space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="accent-green-500" />
                                    <span class="text-sm">Selesai</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="accent-yellow-500" />
                                    <span class="text-sm">Berlangsung</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="accent-red-500" />
                                    <span class="text-sm">Dibatalkan</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-3">
                        <div class="mb-6 flex flex-col md:flex-row gap-4">
                            <input type="text" id="search-history" placeholder="Cari nama ruang atau tanggal..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition" />
                            <button
                                class="px-6 py-3 bg-orange-600 text-white rounded-xl font-semibold hover:bg-orange-700 transition">
                                Cari
                            </button>
                        </div>

                        <div class="overflow-x-auto bg-white rounded-2xl border border-slate-200 shadow-sm">
                            <table id="history-table" class="min-w-full text-sm text-left">
                                <thead class="bg-slate-100 text-slate-700 uppercase text-xs">
                                    <tr>
                                        <th class="px-6 py-3">Nama Ruang</th>
                                        <th class="px-6 py-3">Tanggal</th>
                                        <th class="px-6 py-3">Waktu</th>
                                        <th class="px-6 py-3">Kapasitas</th>
                                        <th class="px-6 py-3">Status</th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y">
                                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-orange-50 transition">
                                        <td class="px-6 py-4 font-medium">Kursi A-1</td>
                                        <td class="px-6 py-4">12 Maret 2026</td>
                                        <td class="px-6 py-4">13:00 - 15:00</td>
                                        <td class="px-6 py-4">4 Orang</td>
                                        <td class="px-6 py-4 text-green-600 font-semibold">
                                            Selesai
                                        </td>
                                    </tr>

                                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-orange-50 transition">
                                        <td class="px-6 py-4 font-medium">Kursi A-2</td>
                                        <td class="px-6 py-4">15 Maret 2026</td>
                                        <td class="px-6 py-4">15:00 - 17:00</td>
                                        <td class="px-6 py-4">6 Orang</td>
                                        <td class="px-6 py-4 text-yellow-600 font-semibold">
                                            Berlangsung
                                        </td>
                                    </tr>

                                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-orange-50 transition">
                                        <td class="px-6 py-4 font-medium">Kursi B-2</td>
                                        <td class="px-6 py-4">18 Maret 2026</td>
                                        <td class="px-6 py-4">10:00 - 12:00</td>
                                        <td class="px-6 py-4">3 Orang</td>
                                        <td class="px-6 py-4 text-red-500 font-semibold">
                                            Dibatalkan
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 bg-slate-50" id="booking-management">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-10">
                    <h2 class="text-3xl font-bold text-slate-900 mb-2">
                        Manajemen Pemesanan Ruangan
                    </h2>
                    <p class="text-slate-500 mb-6">
                        Kelola jadwal, tambah pemesanan, dan pantau ketersediaan ruang
                        diskusi.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium">
                                    Total Pemesanan
                                </p>
                                <p class="text-2xl font-bold text-slate-900" id="stat-total-booking">
                                    0
                                </p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                            <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium">
                                    Pemesanan Hari Ini
                                </p>
                                <p class="text-2xl font-bold text-slate-900" id="stat-today-booking">
                                    0
                                </p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm flex items-center gap-4">
                            <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 font-medium">
                                    Total Orang (Kapasitas)
                                </p>
                                <p class="text-2xl font-bold text-slate-900" id="stat-total-people">
                                    0
                                </p>
                            </div>
                        </div>
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
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Mahasiswa</label>
                                <input type="text" id="input-name" placeholder="Nama Lengkap"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-orange-500 focus:outline-none transition text-sm" />
                                <span class="text-xs text-red-500 hidden mt-1" id="err-name">Nama wajib diisi!</span>
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
                                    <span class="text-xs text-red-500 hidden mt-1" id="err-capacity">Wajib & Maks
                                        10!</span>
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
        </section>
        <section class="py-24 bg-white relative">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-gradient-to-br from-orange-600 to-orange-800 rounded-3xl p-10 md:p-16 text-center shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl">
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">
                            Mulai Pesan Sekarang Yuk!
                        </h2>

                        <div class="flex flex-col justify-center items-center gap-4">
                            <p class="mt-6 text-sm text-white">
                                Membutuhkan Kartu Tanda Mahasiswa (KTM) Universitas Jember.
                            </p>
                            <a href="#"
                                class="w-full sm:w-auto px-8 py-4 rounded-full bg-white text-orange-600 font-bold text-lg hover:bg-slate-50 shadow-xl transition-all hover:-translate-y-1">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mascotBtn = document.getElementById('weather-mascot-btn');
            const overlay = document.getElementById('weather-overlay');
            const popup = document.getElementById('weather-popup');
            const closeBtn = document.getElementById('close-weather-popup');

            const uiLoading = document.getElementById('weather-loading');
            const uiContent = document.getElementById('weather-content');
            const uiError = document.getElementById('weather-error');

            let isWeatherFetched = false;

            const openWeatherPopup = async () => {
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    popup.classList.remove('translate-y-full');
                }, 10);

                if (!isWeatherFetched) {
                    await fetchWeatherAPI();
                }
            };

            const closeWeatherPopup = () => {
                popup.classList.add('translate-y-full');
                overlay.classList.add('opacity-0');

                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 500);
            };

            mascotBtn.addEventListener('click', openWeatherPopup);
            closeBtn.addEventListener('click', closeWeatherPopup);
            overlay.addEventListener('click', closeWeatherPopup)

            async function fetchWeatherAPI() {
                try {
                    uiLoading.classList.remove('hidden');
                    uiContent.classList.add('hidden');
                    uiError.classList.add('hidden');

                    const response = await fetch('https://wttr.in/Jember?format=j1');

                    if (!response.ok) {
                        throw new Error('Gagal mengambil data dari API');
                    }

                    const data = await response.json();

                    const cityName = data.nearest_area[0].areaName[0].value;
                    const tempC = data.current_condition[0].temp_C;
                    const weatherDesc = data.current_condition[0].weatherDesc[0].value;

                    document.getElementById('w-city').textContent = cityName;
                    document.getElementById('w-temp').textContent = tempC;
                    document.getElementById('w-desc').textContent = weatherDesc;

                    uiLoading.classList.add('hidden');
                    uiContent.classList.remove('hidden');

                    isWeatherFetched = true

                } catch (error) {
                    console.error("Terjadi kesalahan:", error);
                    uiLoading.classList.add('hidden');
                    uiError.classList.remove('hidden');
                }
            }
        });
    </script>
@endsection
@push('scripts')
    <script>
        (function() {

            const message = "{{ session('welcome_toast') ?? 'Selamat Datang di LibMate UNEJ! 👋' }}";


            const toaster = document.createElement('div');


            toaster.className = "fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] pointer-events-auto " +
                "bg-slate-900/90 backdrop-blur-md text-white px-6 py-3 rounded-full " +
                "shadow-2xl flex items-center gap-3 transform transition-all duration-700 " +
                "translate-y-20 opacity-0";


            toaster.innerHTML = `
            <div class="bg-orange-500 p-1.5 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"></path>
                </svg>
            </div>
            <span class="text-sm font-medium whitespace-nowrap">${message}</span>
        `;


            document.body.appendChild(toaster);


            setTimeout(() => {

                toaster.classList.remove('translate-y-20', 'opacity-0');
                toaster.classList.add('translate-y-0', 'opacity-100');


                setTimeout(() => {
                    toaster.classList.remove('translate-y-0', 'opacity-100');
                    toaster.classList.add('translate-y-20', 'opacity-0');


                    setTimeout(() => toaster.remove(), 700);
                }, 4000);
            }, 300);
        })();
    </script>
@endpush
