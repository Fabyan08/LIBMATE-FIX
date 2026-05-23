@extends('layouts.app')

@section('title', 'Tentang | LibMate Universitas Jember')

@section('content')

    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden dark:bg-slate-900 transition-colors duration-300">
        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full bg-pattern pointer-events-none opacity-50 dark:opacity-20">
        </div>
        <div
            class="absolute top-20 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-orange-400/20 dark:bg-orange-600/20 rounded-full blur-3xl -z-10 pointer-events-none transition-colors">
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative text-center">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-orange-50 dark:bg-orange-500/10 border border-orange-100 dark:border-orange-500/20 text-orange-600 dark:text-orange-400 text-sm font-semibold mb-6 transition-colors">
                <img src="/unej-logo.png" alt="UNEJ" class="h-4 w-4 rounded-full bg-white hidden"
                    onerror="this.style.display='none'">
                <span>Universitas Jember</span>
            </div>
            <h1
                class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-6 transition-colors">
                Mendigitalkan Ruang,<br>
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-400 dark:from-orange-400 dark:to-orange-300">Mengkoneksikan
                    Ide.</span>
            </h1>
            <p
                class="mt-4 text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed transition-colors">
                LIBMATE hadir untuk mentransformasi pengalaman mahasiswa dalam mengakses ruang diskusi perpustakaan menjadi
                lebih cerdas, tertata, dan terintegrasi.
            </p>
        </div>
    </section>

    <section class="py-16 bg-white dark:bg-slate-900 relative transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-orange-400 to-orange-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200">
                    </div>
                    <div
                        class="relative bg-white dark:bg-slate-800 p-2 rounded-2xl ring-1 ring-slate-900/5 dark:ring-white/10 shadow-xl transition-colors">
                        <div
                            class="aspect-[4/3] bg-slate-100 dark:bg-slate-700 rounded-xl overflow-hidden flex items-center justify-center relative transition-colors">
                            <div
                                class="absolute inset-0 bg-gradient-to-tr from-orange-100 to-slate-50 dark:from-slate-800 dark:to-slate-700 transition-colors">
                                <img src="{{ asset('tentang.jpg') }}" alt="Tentang"
                                    class="w-full h-full object-cover dark:mix-blend-normal opacity-90">
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6 transition-colors">Latar Belakang</h2>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-6 transition-colors">
                        Berawal dari kebutuhan untuk menciptakan ekosistem akademik yang lebih efisien, LIBMATE dikembangkan
                        untuk mengatasi kendala pemesanan ruang diskusi manual. Kami memahami bahwa waktu mahasiswa sangat
                        berharga.
                    </p>

                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/20 flex items-center justify-center text-orange-500 dark:text-orange-400 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white transition-colors">Visi Kami
                                </h3>
                                <p class="text-slate-600 dark:text-slate-400 mt-1 transition-colors">Menjadi platform
                                    manajemen ruang akademik terdepan yang responsif dan mudah digunakan.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-500/20 flex items-center justify-center text-orange-500 dark:text-orange-400 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white transition-colors">Kolaborasi
                                </h3>
                                <p class="text-slate-600 dark:text-slate-400 mt-1 transition-colors">Mendukung terwujudnya
                                    ruang diskusi yang kolaboratif bagi seluruh sivitas akademika.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-20 bg-slate-50 dark:bg-slate-900 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-12 transition-colors">Nilai Utama LIBMATE</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-orange-50 dark:bg-orange-500/20 rounded-2xl flex items-center justify-center text-orange-500 dark:text-orange-400 mb-6 mx-auto transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 transition-colors">Efisiensi Waktu</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed transition-colors">Pesan ruang
                        dalam hitungan detik. Tidak perlu lagi antre atau mencari petugas perpustakaan.</p>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-xl transition-all duration-300 relative overflow-hidden">
                    <div
                        class="absolute top-0 right-0 w-20 h-20 bg-orange-50 dark:bg-orange-500/10 rounded-bl-full -z-10 transition-colors">
                    </div>
                    <div
                        class="w-14 h-14 bg-orange-50 dark:bg-orange-500/20 rounded-2xl flex items-center justify-center text-orange-500 dark:text-orange-400 mb-6 mx-auto transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 transition-colors">Transparansi Jadwal
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed transition-colors">Ketersediaan
                        ruang selalu diperbarui secara real-time, menghindari bentrok jadwal antarmahasiswa.</p>
                </div>

                <div
                    class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 hover:-translate-y-2 hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-orange-50 dark:bg-orange-500/20 rounded-2xl flex items-center justify-center text-orange-500 dark:text-orange-400 mb-6 mx-auto transition-colors">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 transition-colors">Integrasi AI</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed transition-colors">Asisten cerdas
                        kami siap merekomendasikan ruangan yang paling sesuai dengan kebutuhan kapasitas Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 dark:bg-slate-900 transition-colors duration-300">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-gradient-to-br from-orange-600 to-orange-500 dark:from-orange-700 dark:to-orange-800 rounded-3xl p-10 md:p-16 text-center shadow-2xl shadow-orange-500/30 dark:shadow-orange-900/30 relative overflow-hidden transition-colors">
                <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl">
                </div>
                <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl">
                </div>

                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 relative z-10">Siap Untuk Berdiskusi Hari Ini?
                </h2>
                <p class="text-orange-100 dark:text-orange-200 mb-10 max-w-2xl mx-auto relative z-10 text-lg">
                    Bergabunglah dengan ribuan mahasiswa lainnya yang telah menggunakan LIBMATE untuk pengalaman belajar
                    yang lebih baik.
                </p>
                <button
                    class="relative z-10 bg-white text-orange-600 dark:text-orange-700 hover:bg-slate-50 px-8 py-4 rounded-full font-bold text-lg transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                    Mulai Pesan Sekarang
                </button>
            </div>
        </div>
    </section>
@endsection
