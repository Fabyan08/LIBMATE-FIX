@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
    <main style="background-image: url('{{ asset('unej.png') }}')"
        class="md:bg-[length:200%] bg-[length:1000%] bg-top bg-no-repeat md:min-h-screen dark:bg-slate-900 transition-colors duration-300">
        {{-- maskot & popup cuaca --}}
        <div class="maskot fixed -bottom-20 -left-12 w-60 md:w-96 z-40">
            <img src="{{ asset('maskot.png') }}" alt="" class="animate-bounce drop-shadow-2xl">
        </div>

        <div id="weather-mascot-btn"
            class="maskot fixed -bottom-20 -left-12 w-60 md:w-96 z-50 cursor-pointer group hover:-translate-y-2 transition-transform duration-300">
            <div
                class="absolute -top-20 left-32 bg-white dark:bg-slate-800 px-4 py-2 rounded-2xl shadow-xl border border-orange-200 dark:border-orange-500/30 text-sm font-bold text-orange-600 dark:text-orange-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Cek Cuaca Jember! 🌤️
            </div>
            <img src="{{ asset('maskot.png') }}" alt="Maskot LibMate" class="animate-bounce drop-shadow-2xl">
        </div>

        <div id="weather-overlay"
            class="fixed inset-0 bg-slate-900/40 dark:bg-black/60 backdrop-blur-sm z-[60] hidden opacity-0 transition-opacity duration-500">
        </div>

        <div id="weather-popup"
            class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border-t border-x border-white/60 dark:border-slate-700 shadow-[0_-20px_40px_rgba(0,0,0,0.15)] rounded-t-[2.5rem] p-8 z-[70] transform translate-y-full transition-transform duration-500 ease-out">

            <div class="w-12 h-1.5 bg-slate-200 dark:bg-slate-700 rounded-full mx-auto mb-6"></div>

            <button id="close-weather-popup"
                class="absolute top-6 right-6 p-2 bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-300 hover:text-red-500 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-slate-700 rounded-full transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <h2 class="text-slate-800 dark:text-white font-extrabold text-xl mb-6 flex items-center justify-center gap-2">
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
                <p class="text-sm font-medium text-slate-500 dark:text-slate-400 animate-pulse">Menghubungi satelit cuaca...
                </p>
            </div>

            <div id="weather-content" class="hidden text-center py-2">
                <h3 id="w-city" class="text-3xl font-black text-slate-800 dark:text-white tracking-tight mb-2"></h3>
                <div class="flex justify-center items-start mb-6">
                    <span id="w-temp" class="text-[5rem] font-black text-orange-500 leading-none drop-shadow-md"></span>
                    <span class="text-3xl font-bold text-orange-400 mt-2">°C</span>
                </div>
                <div
                    class="inline-block px-6 py-2 bg-gradient-to-r from-orange-50 to-orange-100 dark:from-slate-800 dark:to-slate-700 border border-orange-200 dark:border-slate-600 rounded-full shadow-sm">
                    <p id="w-desc" class="text-base font-bold text-orange-700 dark:text-orange-400 capitalize"></p>
                </div>
            </div>

            <div id="weather-error" class="hidden text-center py-8">
                <div
                    class="w-14 h-14 bg-red-100 dark:bg-red-900/30 text-red-500 dark:text-red-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                </div>
                <p class="text-sm font-semibold text-red-500 dark:text-red-400">Gagal memuat data cuaca.<br>Coba lagi nanti.
                </p>
            </div>
        </div>

        <section id="home" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-full pointer-events-none">
                <div
                    class="absolute top-20 left-10 w-72 h-72 bg-orange-300 dark:bg-orange-600/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob">
                </div>
                <div
                    class="absolute top-20 right-10 w-72 h-72 bg-orange-300 dark:bg-orange-500/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000">
                </div>
                <div
                    class="absolute -bottom-8 left-1/2 -translate-x-1/2 w-96 h-96 bg-purple-300 dark:bg-purple-600/20 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000">
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <div class="flex items-center justify-center pb-2 w-full">
                    <img src="{{ asset('unej-logo.png') }}" alt="logo" width="100" class="animate-ping" />
                </div>

                <h1
                    class="text-5xl md:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white mb-6 leading-tight max-w-4xl mx-auto transition-colors">
                    Pemesanan Ruang Perpus <br class="hidden md:block" />
                    <span class="text-orange-500">Universitas Jember</span>
                </h1>

                <p
                    class="text-lg md:text-xl text-slate-500 dark:text-slate-400 mb-10 max-w-2xl mx-auto font-medium leading-relaxed transition-colors">
                    LibMate membantu mahasiswa memesan ruang diskusi perpustakaan dengan
                    mudah dan memberikan rekomendasi cerdas untuk waktu dan ruangan
                    terbaik berdasarkan kebiasaan Anda.
                </p>

                <div class="flex flex-col sm:flex-row justify-center items-center gap-4 mb-16">
                    <a href="#ai-assistant"
                        class="w-full sm:w-auto px-8 py-4 rounded-full bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 font-semibold text-lg border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700 shadow-sm transition-all flex items-center justify-center gap-2">
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
                    <div
                        class="relative rounded-2xl bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 shadow-2xl overflow-hidden z-10 transition-colors">
                        <div
                            class="bg-slate-50 dark:bg-slate-900/50 border-b border-slate-100 dark:border-slate-700 px-4 py-3 flex items-center gap-2 transition-colors">
                            <div class="w-3 h-3 rounded-full bg-red-400"></div>
                            <div class="w-3 h-3 rounded-full bg-amber-400"></div>
                            <div class="w-3 h-3 rounded-full bg-green-400"></div>
                            <div
                                class="mx-auto text-xs font-medium text-slate-400 dark:text-slate-500 bg-white dark:bg-slate-800 px-3 py-1 rounded-md border border-slate-100 dark:border-slate-700 shadow-sm transition-colors">
                                libmate.unej.ac.id
                            </div>
                        </div>
                        <div class="flex h-[400px] md:h-[500px]">
                            <div
                                class="w-16 md:w-64 border-r border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 p-4 hidden sm:block transition-colors">
                                <div class="space-y-4">
                                    <div
                                        class="h-10 w-full bg-white dark:bg-slate-800 rounded-lg shadow-sm border border-slate-100 dark:border-slate-700 flex items-center px-3 gap-3 transition-colors">
                                        <div
                                            class="w-5 h-5 rounded bg-orange-100 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="h-2 w-20 bg-slate-200 dark:bg-slate-700 rounded hidden md:block"></div>
                                    </div>
                                    <div class="h-10 w-full bg-transparent rounded-lg flex items-center px-3 gap-3">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500 flex items-center justify-center transition-colors">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div
                                            class="h-2 w-16 bg-slate-200 dark:bg-slate-700 rounded hidden md:block transition-colors">
                                        </div>
                                    </div>
                                    <div class="h-10 w-full bg-transparent rounded-lg flex items-center px-3 gap-3">
                                        <div
                                            class="w-5 h-5 rounded bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500 flex items-center justify-center transition-colors">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div
                                            class="h-2 w-24 bg-slate-200 dark:bg-slate-700 rounded hidden md:block transition-colors">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-1 p-6 md:p-8 bg-white dark:bg-slate-800 text-left relative transition-colors">
                                <div class="h-6 w-48 bg-slate-100 dark:bg-slate-700 rounded-md mb-6 transition-colors">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                                    <div
                                        class="h-24 rounded-xl bg-gradient-to-br from-orange-50 to-orange-50 dark:from-slate-700 dark:to-slate-700 border border-orange-100 dark:border-slate-600 p-4 transition-colors">
                                        <div class="h-3 w-20 bg-orange-200 dark:bg-slate-500 rounded mb-3"></div>
                                        <div class="h-8 w-12 bg-orange-600 dark:bg-orange-500 rounded"></div>
                                    </div>
                                    <div
                                        class="h-24 rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700 p-4 transition-colors">
                                        <div class="h-3 w-24 bg-slate-200 dark:bg-slate-600 rounded mb-3"></div>
                                        <div class="h-8 w-16 bg-slate-300 dark:bg-slate-500 rounded"></div>
                                    </div>
                                    <div
                                        class="h-24 rounded-xl bg-slate-50 dark:bg-slate-700/50 border border-slate-100 dark:border-slate-700 p-4 hidden md:block transition-colors">
                                        <div class="h-3 w-16 bg-slate-200 dark:bg-slate-600 rounded mb-3"></div>
                                        <div class="h-8 w-10 bg-slate-300 dark:bg-slate-500 rounded"></div>
                                    </div>
                                </div>
                                <div class="h-4 w-32 bg-slate-100 dark:bg-slate-700 rounded-md mb-4 transition-colors">
                                </div>
                                <div class="space-y-3">
                                    <div
                                        class="h-12 w-full bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-100 dark:border-slate-700 transition-colors">
                                    </div>
                                    <div
                                        class="h-12 w-full bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-100 dark:border-slate-700 transition-colors">
                                    </div>
                                    <div
                                        class="h-12 w-full bg-slate-50 dark:bg-slate-700/50 rounded-lg border border-slate-100 dark:border-slate-700 transition-colors">
                                    </div>
                                </div>

                                <div
                                    class="absolute bottom-6 right-6 w-64 bg-white dark:bg-slate-800 rounded-xl shadow-xl border border-slate-100 dark:border-slate-700 overflow-hidden hidden md:flex flex-col transition-colors">
                                    <div class="bg-orange-600 px-4 py-3 flex items-center gap-2">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                        <span class="text-xs font-semibold text-white">LibMate AI</span>
                                    </div>
                                    <div
                                        class="p-3 bg-slate-50 dark:bg-slate-900/50 text-xs text-slate-600 dark:text-slate-300 leading-relaxed border-b border-slate-100 dark:border-slate-700 transition-colors">
                                        Halo! Apakah kamu ingin memesan ruangan di lantai 2?
                                    </div>
                                    <div class="p-2 flex gap-2 bg-white dark:bg-slate-800 transition-colors">
                                        <div
                                            class="flex-1 py-1.5 bg-orange-50 dark:bg-orange-500/10 text-orange-600 dark:text-orange-400 text-center rounded text-xs font-medium cursor-pointer border border-orange-100 dark:border-orange-500/20 hover:bg-orange-100 dark:hover:bg-orange-500/20 transition-colors">
                                            Ya, Pesankan
                                        </div>
                                        <div
                                            class="flex-1 py-1.5 bg-slate-50 dark:bg-slate-700 text-slate-500 dark:text-slate-300 text-center rounded text-xs font-medium cursor-pointer border border-slate-200 dark:border-slate-600 hover:bg-slate-100 dark:hover:bg-slate-600 transition-colors">
                                            Opsi Lain
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute -left-6 bg-white/70 dark:bg-slate-800/70 top-1/4 backdrop-blur-md rounded-xl p-4 shadow-xl z-20 flex items-center gap-4 animate-float hidden lg:flex border border-white dark:border-slate-700 transition-colors">
                        <div
                            class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-500/20 flex items-center justify-center text-green-600 dark:text-green-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                        </div>
                        <div class="text-left">
                            <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Status Ruangan</p>
                            <p class="text-sm font-bold text-slate-800 dark:text-white">Ruang Lantai 2 Tersedia!</p>
                        </div>
                    </div>

                    <div class="absolute -right-12 top-1/2 bg-white/70 dark:bg-slate-800/70 backdrop-blur-md rounded-xl p-4 shadow-xl z-20 animate-float hidden lg:block border border-orange-100 dark:border-slate-700 transition-colors"
                        style="animation-delay: 1s">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-4 h-4 text-orange-500 dark:text-orange-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span
                                class="text-xs font-bold text-orange-600 dark:text-orange-400 uppercase tracking-wide">Rekomendasi
                                AI</span>
                        </div>
                        <p class="text-sm font-semibold text-slate-800 dark:text-white mb-1">Zona Tenang - Lantai 2</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Cocok untuk mengerjakan tugas dengan tenang!
                        </p>
                        <div class="mt-3 flex justify-end">
                            <button
                                class="text-xs bg-orange-50 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 px-3 py-1 rounded-full font-semibold hover:bg-orange-100 dark:hover:bg-orange-500/30 transition-colors">Pesan
                                →</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section
            class="py-10 border-y border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-x divide-slate-100 dark:divide-slate-800">
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-2">10+</h4>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Tempat
                            tersedia</p>
                    </div>
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-2">500+</h4>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Mahasiswa
                            Terlayani</p>
                    </div>
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-slate-900 dark:text-white mb-2">2000+</h4>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Pemesanan
                            Berhasil</p>
                    </div>
                    <div class="p-4">
                        <h4 class="text-3xl md:text-4xl font-extrabold text-orange-600 dark:text-orange-500 mb-2">98%</h4>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Kepuasan
                            Mahasiswa</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="features" class="py-24 bg-slate-50 dark:bg-slate-900/50 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <span class="text-orange-600 dark:text-orange-500 font-semibold text-sm uppercase tracking-wider">Fitur
                        Utama</span>
                    <h2 class="mt-3 text-3xl md:text-4xl font-bold text-slate-900 dark:text-white transition-colors">
                        Pengalaman Pesan Ruang Perpus yang Beda!
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Pemesanan Cepat</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Mahasiswa dapat dengan mudah
                            memesan ruang diskusi dalam hitungan detik dengan antarmuka yang mulus.</p>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Rekomendasi AI</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">AI kami menyarankan waktu dan
                            ruang belajar terbaik berdasarkan preferensi Anda dan jam sibuk.</p>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Pelacak Real-time</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Periksa status ruangan secara
                            real-time untuk melihat mana yang terisi dan kosong dari jauh.</p>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group relative overflow-hidden">
                        <div
                            class="absolute -right-6 -top-6 w-24 h-24 bg-orange-100 dark:bg-orange-500/10 rounded-full blur-2xl opacity-50 pointer-events-none">
                        </div>
                        <div
                            class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">Asisten Chat AI</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Tanyakan kepada AI tentang
                            jadwal atau aturan perpustakaan secara instan melalui chatbot.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works"
            class="py-24 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 transition-colors">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-20">
                    <h2 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white mb-4">Pesan Ruangan dalam 3
                        Langkah</h2>
                    <p class="text-lg text-slate-500 dark:text-slate-400">Tidak perlu lagi berkeliling mencari tempat.
                        Dapatkan ruangan dengan cepat.</p>
                </div>

                <div class="relative">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                        <div class="text-center relative">
                            <div
                                class="w-20 h-20 mx-auto bg-white dark:bg-slate-800 border-4 border-slate-50 dark:border-slate-700 rounded-full shadow-lg dark:shadow-none flex items-center justify-center text-2xl font-bold text-orange-600 dark:text-orange-500 mb-6 transition-colors">
                                1</div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Cari</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs mx-auto">Telusuri ruang diskusi
                                yang tersedia di Universitas Jember secara real-time.</p>
                        </div>
                        <div class="text-center relative">
                            <div
                                class="w-20 h-20 mx-auto bg-white dark:bg-slate-800 border-4 border-orange-50 dark:border-orange-900/30 rounded-full shadow-lg dark:shadow-none flex items-center justify-center text-2xl font-bold text-orange-600 dark:text-orange-500 mb-6 relative transition-colors">
                                <div
                                    class="absolute inset-0 bg-white dark:bg-orange-500/20 rounded-full blur-md opacity-20 animate-pulse">
                                </div>
                                2
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Rekomendasi AI</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs mx-auto">Biarkan AI kami
                                menyarankan ruang dan waktu terbaik berdasarkan preferensi Anda.</p>
                        </div>
                        <div class="text-center relative">
                            <div
                                class="w-20 h-20 mx-auto bg-white dark:bg-slate-800 border-4 border-slate-50 dark:border-slate-700 rounded-full shadow-lg dark:shadow-none flex items-center justify-center text-2xl font-bold text-orange-600 dark:text-orange-500 mb-6 transition-colors">
                                3</div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Pesan Instan</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs mx-auto">Konfirmasi pesanan Anda
                                dengan satu klik saja!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="ai-assistant"
            class="py-24 bg-orange-400 dark:bg-orange-600 relative overflow-hidden transition-colors">
            <div
                class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/20 rounded-full blur-[120px] pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-white/20 rounded-full blur-[100px] pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-16">

                    <div class="lg:w-1/2 text-left">
                        <span
                            class="inline-block py-1 px-3 rounded-full bg-white/20 text-white text-sm font-semibold mb-6 border border-white/50">
                            Pusat Informasi AI
                        </span>
                        <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">
                            Asisten Cerdas Siap Menjawab
                        </h2>
                        <p class="text-white text-lg mb-8 leading-relaxed">
                            Punya pertanyaan seputar fasilitas ruangan, prosedur pemesanan, atau aturan perpustakaan? Tanya
                            langsung ke AI LibMate! Asisten virtual kami memahami bahasa sehari-hari dan siap memberikan
                            informasi akurat kapan saja.
                        </p>
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-start gap-3 text-white">
                                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>"Bagaimana prosedur memesan ruang diskusi?"</span>
                            </li>
                            <li class="flex items-start gap-3 text-white">
                                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>"Berapa jam batas maksimal peminjaman ruangan?"</span>
                            </li>
                            <li class="flex items-start gap-3 text-white">
                                <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>"Apakah ada fasilitas AC dan proyektor di Ruang Meeting?"</span>
                            </li>
                        </ul>
                        <a href="#"
                            class="inline-flex items-center gap-2 text-white font-semibold hover:text-orange-200 transition-colors">
                            Coba Tanya AI Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="lg:w-1/2 w-full max-w-md mx-auto">
                        <div
                            class="bg-white dark:bg-slate-800 rounded-2xl border border-white/50 dark:border-slate-700 shadow-2xl overflow-hidden transition-colors">

                            <div
                                class="bg-white dark:bg-slate-900/50 shadow-sm backdrop-blur-sm border-b dark:border-slate-700 p-4 flex items-center justify-between transition-colors">
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
                                        <h4 class="text-slate-700 dark:text-slate-300 font-bold text-sm">LibMate AI</h4>
                                        <p class="text-slate-400 dark:text-slate-500 text-xs">Asisten Informasi</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="p-4 space-y-4 h-[350px] overflow-y-auto bg-slate-50 dark:bg-slate-800 transition-colors custom-scrollbar">

                                <div class="flex justify-end">
                                    <div
                                        class="bg-orange-500 shadow-sm text-white rounded-2xl rounded-tr-sm px-4 py-2.5 text-sm max-w-[85%]">
                                        Gimana cara pesan ruangan di libmate?
                                    </div>
                                </div>

                                <div class="flex justify-start">
                                    <div
                                        class="bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 shadow-sm text-slate-800 dark:text-slate-200 rounded-2xl rounded-tl-sm p-4 text-sm max-w-[90%] transition-colors">
                                        <p class="mb-3">Tentu! Cara pesan ruangan di LibMate adalah sebagai berikut:</p>

                                        <ol class="list-decimal ml-4 space-y-1.5 mb-4 text-slate-700 dark:text-slate-300">
                                            <li><strong>Login</strong> ke akun mahasiswa UNEJ.</li>
                                            <li><strong>Lihat katalog ruang</strong> untuk memilih ruangan.</li>
                                            <li><strong>Isi formulir booking</strong> sesuai kebutuhan.</li>
                                            <li>Status pesanan akan menjadi <strong>Pending</strong> dan diverifikasi admin.
                                            </li>
                                        </ol>

                                        <div
                                            class="bg-orange-50 dark:bg-slate-800/50 p-3 rounded-lg border border-orange-100 dark:border-slate-600">
                                            <p class="font-semibold text-xs text-orange-600 dark:text-orange-400 mb-1">
                                                Catatan penting:</p>
                                            <ul
                                                class="list-disc ml-4 space-y-1 text-xs text-slate-600 dark:text-slate-400">
                                                <li>Pemesanan hanya antara 08:00–16:00 WIB.</li>
                                                <li>Maksimal 3 jam per sesi.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="p-3 bg-white dark:bg-slate-900 shadow-md border-t dark:border-slate-700 transition-colors">
                                <div class="relative">
                                    <input type="text" placeholder="Tanya sesuatu..." disabled
                                        class="w-full bg-slate-100 dark:bg-slate-800 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 rounded-full py-3 pl-4 pr-12 border border-slate-200 dark:border-slate-700 focus:outline-none transition-colors cursor-not-allowed" />
                                    <button disabled
                                        class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-orange-400 rounded-full flex items-center justify-center text-white cursor-not-allowed">
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

        <section
            class="py-12 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-slate-50 dark:bg-slate-800 rounded-3xl p-8 border border-slate-200 dark:border-slate-700 shadow-xl transition-all duration-300">

                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                        <div>
                            <span
                                class="text-orange-600 dark:text-orange-500 font-bold text-xs uppercase tracking-wider block mb-1">Fitur
                                Sesi</span>
                            <h2 class="text-2xl font-extrabold text-slate-900 dark:text-white transition-colors">Data
                                Kunjungan.</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Informasi ini disimpan secara
                                lokal di dalam enkripsi enkapsulasi Laravel Session.</p>
                        </div>
                        @if (Auth::user()?->role === 'admin')
                            <form action="{{ route('kunjungan.reset') }}" method="POST" class="shrink-0">
                                @csrf
                                <button type="submit"
                                    class="px-5 py-2.5 bg-red-50 dark:bg-red-950/30 hover:bg-red-100 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 font-bold text-sm rounded-xl border border-red-200 dark:border-red-900/40 transition-all flex items-center gap-2 shadow-sm active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v1a3 3 0 003 3h10M4 7h16">
                                        </path>
                                    </svg>
                                    Reset Hitungan
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                        <div
                            class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-700 flex items-center gap-4 transition-colors">
                            <div
                                class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/20 text-orange-600 dark:text-orange-400 flex items-center justify-center shrink-0 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-bold">
                                    Jumlah Kunjungan</p>
                                <p class="text-2xl font-black text-slate-900 dark:text-white mt-0.5">
                                    {{ session('visit_count', 0) }} x</p>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-700 flex items-center gap-4 transition-colors">
                            <div
                                class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/20 text-blue-600 dark:text-blue-400 flex items-center justify-center shrink-0 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-bold">
                                    Kunjungan Pertama</p>
                                <p
                                    class="text-sm font-extrabold text-slate-800 dark:text-slate-200 mt-1 transition-colors">
                                    {{ session('first_visit', '-') }}</p>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-slate-900 p-5 rounded-2xl border border-slate-200 dark:border-slate-700 flex items-center gap-4 transition-colors">
                            <div
                                class="w-12 h-12 rounded-xl bg-green-50 dark:bg-green-500/20 text-green-600 dark:text-green-400 flex items-center justify-center shrink-0 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-slate-400 dark:text-slate-500 uppercase tracking-wider font-bold">
                                    Kunjungan Terakhir</p>
                                <p
                                    class="text-sm font-extrabold text-slate-800 dark:text-slate-200 mt-1 transition-colors">
                                    {{ session('last_visit', '-') }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section class="py-24 bg-white dark:bg-slate-900 relative transition-colors duration-300">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-gradient-to-br from-orange-600 to-orange-800 dark:from-orange-700 dark:to-orange-900 rounded-3xl p-10 md:p-16 text-center shadow-2xl relative overflow-hidden transition-colors">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl">
                    </div>
                    <div
                        class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl">
                    </div>

                    <div class="relative z-10">
                        <h2 class="text-3xl md:text-5xl font-bold text-white mb-6">Mulai Pesan Sekarang Yuk!</h2>
                        <div class="flex flex-col justify-center items-center gap-4">
                            <a href="/ruangan"
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

            if (mascotBtn) mascotBtn.addEventListener('click', openWeatherPopup);
            if (closeBtn) closeBtn.addEventListener('click', closeWeatherPopup);
            if (overlay) overlay.addEventListener('click', closeWeatherPopup);

            async function fetchWeatherAPI() {
                try {
                    uiLoading.classList.remove('hidden');
                    uiContent.classList.add('hidden');
                    uiError.classList.add('hidden');
                    // Mengambil data cuaca wilayah Jember dari API eksternal (wttr.in) berformat JSON
                    const response = await fetch('https://wttr.in/Jember?format=j1');
                    if (!response.ok) throw new Error('Gagal mengambil data dari API');

                    const data = await response.json();
                    const cityName = data.nearest_area[0].areaName[0].value;
                    const tempC = data.current_condition[0].temp_C;
                    const weatherDesc = data.current_condition[0].weatherDesc[0].value;

                    document.getElementById('w-city').textContent = cityName;
                    document.getElementById('w-temp').textContent = tempC;
                    document.getElementById('w-desc').textContent = weatherDesc;

                    uiLoading.classList.add('hidden');
                    uiContent.classList.remove('hidden');
                    isWeatherFetched = true;
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
    {{-- IIFE (Immediately Invoked Function Expression) untuk menampilkan notifikasi Toast secara dinamis saat halaman pertama
    kali dimuat --}}
    <script>
        (function() {
            const message = "{{ session('welcome_toast') ?? 'Selamat Datang di LibMate UNEJ! 👋' }}";
            const toaster = document.createElement('div');

            toaster.className = "fixed bottom-10 left-1/2 -translate-x-1/2 z-[100] pointer-events-auto " +
                "bg-slate-900/90 dark:bg-white/90 backdrop-blur-md text-white dark:text-slate-900 px-6 py-3 rounded-full " +
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
