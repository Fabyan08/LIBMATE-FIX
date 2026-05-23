@extends('layouts.app')

@section('title', 'Kontak | LibMate Universitas Jember')

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
                <span>Hubungi Kami</span>
            </div>
            <h1
                class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-6 transition-colors">
                Kami Siap Membantu<br>
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-orange-400 dark:from-orange-400 dark:to-orange-300">Diskusi
                    Anda.</span>
            </h1>
            <p
                class="mt-4 text-lg md:text-xl text-slate-600 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed transition-colors">
                Punya pertanyaan tentang LIBMATE atau kendala saat memesan ruangan? Jangan ragu untuk menghubungi tim kami.
            </p>
        </div>
    </section>
    <section class="py-16 bg-white dark:bg-slate-900 relative transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-6 transition-colors">Informasi Kontak
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-10 transition-colors">
                        Tim teknis dan administrasi LIBMATE tersedia untuk mendukung kelancaran kegiatan akademik Anda di
                        Perpustakaan Universitas Jember.
                    </p>

                    <div class="space-y-8">
                        <div class="flex gap-5">
                            <div
                                class="flex-shrink-0 w-14 h-14 rounded-2xl bg-orange-50 dark:bg-orange-500/20 flex items-center justify-center text-orange-500 dark:text-orange-400 shadow-sm transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white transition-colors">Lokasi</h3>
                                <p class="text-slate-600 dark:text-slate-400 mt-1 transition-colors">Gedung Perpustakaan
                                    Pusat, Universitas Jember.<br>Jl.
                                    Kalimantan No. 37, Jember, Jawa Timur.</p>
                            </div>
                        </div>

                        <div class="flex gap-5">
                            <div
                                class="flex-shrink-0 w-14 h-14 rounded-2xl bg-orange-50 dark:bg-orange-500/20 flex items-center justify-center text-orange-500 dark:text-orange-400 shadow-sm transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white transition-colors">Email</h3>
                                <p class="text-slate-600 dark:text-slate-400 mt-1 transition-colors">
                                    support.libmate@unej.ac.id</p>
                                <p class="text-slate-600 dark:text-slate-500 text-sm italic mt-1 transition-colors">Waktu
                                    respon: Kurang dari 24 jam.</p>
                            </div>
                        </div>

                        <div class="flex gap-5">
                            <div
                                class="flex-shrink-0 w-14 h-14 rounded-2xl bg-orange-50 dark:bg-orange-500/20 flex items-center justify-center text-orange-500 dark:text-orange-400 shadow-sm transition-colors">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white transition-colors">Jam
                                    Operasional</h3>
                                <p class="text-slate-600 dark:text-slate-400 mt-1 transition-colors">Senin - Jumat: 08:00 -
                                    20:00 WIB</p>
                                <p class="text-slate-600 dark:text-slate-400 mt-1 transition-colors">Sabtu - Minggu: Tutup
                                    (Layanan Online)</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-orange-400 to-orange-500 rounded-3xl blur opacity-20 transition duration-1000">
                    </div>
                    <div
                        class="relative bg-white dark:bg-slate-800 p-8 md:p-10 rounded-3xl ring-1 ring-slate-900/5 dark:ring-white/5 shadow-2xl transition-colors">
                        <form action="{{ route('kontak.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-bold text-slate-900 dark:text-slate-200 transition-colors">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama" placeholder="Masukkan nama"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 dark:text-white dark:placeholder-slate-500 border-transparent focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
                                    @error('nama')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-sm font-bold text-slate-900 dark:text-slate-200 transition-colors">Email
                                        Mahasiswa</label>
                                    <input type="email" name="email" placeholder="nim@mail.unej.ac.id"
                                        class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 dark:text-white dark:placeholder-slate-500 border-transparent focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-bold text-slate-900 dark:text-slate-200 transition-colors">Subjek</label>
                                <input type="text" name="subjek" placeholder="Tujuan pesan"
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 dark:text-white dark:placeholder-slate-500 border-transparent focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none">
                                @error('subjek')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-sm font-bold text-slate-900 dark:text-slate-200 transition-colors">Pesan</label>
                                <textarea rows="4" name="pesan" placeholder="Tuliskan pesan Anda..."
                                    class="w-full px-4 py-3 rounded-xl bg-slate-50 dark:bg-slate-900/50 dark:text-white dark:placeholder-slate-500 border-transparent focus:bg-white dark:focus:bg-slate-700 focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none resize-none"></textarea>
                                @error('pesan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengirim pesan ini?')"
                                class="w-full py-4 rounded-2xl bg-orange-600 text-white font-bold hover:bg-orange-500 hover:shadow-lg hover:shadow-orange-500/30 transition-all transform hover:-translate-y-1">
                                Kirim Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
