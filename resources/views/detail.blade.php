@extends('layouts.app')

@section('title', $ruangan->nama_ruang . ' | LibMate Universitas Jember')

@section('content')
    <section
        class="bg-gradient-to-b pt-32 from-orange-50 via-white to-slate-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-900 min-h-screen py-12 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6">

            @if (session('status'))
                <div
                    class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800/50 text-emerald-700 dark:text-emerald-400 rounded-2xl flex items-center gap-3 text-sm font-semibold shadow-sm transition-colors">
                    <svg class="w-5 h-5 text-emerald-500 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('status') }}
                </div>
                <p class="dark:text-slate-300">Pantau di halaman <a href="{{ route('profil') }}"
                        class="text-blue-500 dark:text-blue-400 hover:underline">Profil</a></p>
            @endif

            @if ($errors->any())
                <div
                    class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800/50 text-red-700 dark:text-red-400 rounded-2xl shadow-sm transition-colors">
                    <div class="flex items-center gap-3 text-sm font-bold mb-2">
                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Terdapat kesalahan pengisian formulir:
                    </div>
                    <ul class="list-disc list-inside text-xs space-y-1 opacity-90 pl-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-8">

                <div class="lg:col-span-5 space-y-6">
                    <div
                        class="rounded-[2rem] overflow-hidden shadow-xl dark:shadow-none border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-800 p-3 transition-colors">
                        <div class="rounded-[1.5rem] overflow-hidden h-72 lg:h-96 bg-slate-100 dark:bg-slate-700">
                            @if ($ruangan->gambar)
                                <img id="mainImage" src="{{ asset('storage/' . $ruangan->gambar) }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-500">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div
                        class="bg-white dark:bg-slate-800 p-8 rounded-[2rem] border border-slate-200 dark:border-slate-700 shadow-sm transition-colors">
                        <span
                            class="text-xs bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 px-4 py-1.5 rounded-full font-bold tracking-wide border border-orange-100 dark:border-orange-800/50 uppercase">
                            {{ $ruangan->kategori }}
                        </span>

                        <h1 class="text-3xl font-extrabold text-slate-800 dark:text-white tracking-tight mt-4 mb-4">
                            {{ $ruangan->nama_ruang }}
                        </h1>

                        <div
                            class="space-y-3.5 border-t border-b border-slate-100 dark:border-slate-700 py-4 mb-6 transition-colors">
                            <div class="flex items-center gap-3 text-sm font-semibold text-slate-600 dark:text-slate-300">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                Lokasi: Lantai {{ $ruangan->lantai }} Perpustakaan
                            </div>
                            <div class="flex items-center gap-3 text-sm font-semibold text-slate-600 dark:text-slate-300">
                                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                                Kapasitas Maksimal: {{ $ruangan->kapasitas }} Orang
                            </div>
                        </div>

                        <button onclick="document.getElementById('booking-card').scrollIntoView({ behavior: 'smooth' })"
                            class="w-full lg:hidden px-6 py-3.5 bg-orange-500 text-white rounded-xl font-bold hover:bg-orange-600 transition shadow-lg shadow-orange-500/20 active:scale-95">
                            Booking Sekarang
                        </button>
                    </div>
                </div>

                <div class="lg:col-span-7 w-full" id="booking-card">
                    <div
                        class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-[2rem] border border-slate-200 dark:border-slate-700 shadow-xl dark:shadow-none relative overflow-hidden transition-colors">

                        <div class="mb-6 pb-4 border-b border-slate-100 dark:border-slate-700">
                            <h2 class="text-xl font-bold text-slate-800 dark:text-white">Formulir Pengajuan Ruang</h2>
                            <p class="text-xs text-slate-400 mt-1">Silakan tentukan jadwal penggunaan ruang diskusi Anda.
                                (Kamu hanya bisa meminjam maksimal 3 jam (2 kali sehari) dalam satu kali pengajuan, dan
                                hanya
                                bisa memesan mulai pukul 08:00 hingga 16:00 WIB)
                            </p>
                        </div>

                        @if (!auth()->check())
                            <div
                                class="p-6 flex items-center gap-1 bg-yellow-50 dark:bg-yellow-900/30 rounded-xl border border-yellow-200 dark:border-yellow-700/50 text-yellow-700 dark:text-yellow-400 text-sm font-semibold transition-colors">
                                <svg class="w-5 h-5 text-yellow-500 shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                Anda harus <a href="{{ route('login') }}"
                                    class="text-orange-500 font-bold hover:underline">masuk</a> untuk mengajukan booking
                                ruang perpustakaan.
                            </div>
                        @else
                            <form action="{{ route('booking.store', $ruangan->id) }}" method="POST" class="space-y-5">
                                @csrf

                                <div>
                                    <label for="tanggal_pinjam"
                                        class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Tanggal
                                        Peminjaman</label>
                                    <input type="date" id="tanggal_pinjam" name="tanggal_pinjam"
                                        value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}"
                                        required
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50/50 dark:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all text-sm font-medium text-slate-700 dark:text-slate-200 [color-scheme:light] dark:[color-scheme:dark]">
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label for="jam_mulai"
                                            class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Jam
                                            Mulai</label>
                                        <input type="time" id="jam_mulai" name="jam_mulai"
                                            value="{{ old('jam_mulai', '08:00') }}" min="08:00" max="16:00" required
                                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50/50 dark:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all text-sm font-medium text-slate-700 dark:text-slate-200 [color-scheme:light] dark:[color-scheme:dark]">
                                    </div>
                                    <div>
                                        <label for="jam_selesai"
                                            class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Jam
                                            Selesai</label>
                                        <input type="time" id="jam_selesai" name="jam_selesai"
                                            value="{{ old('jam_selesai', '16:00') }}" min="08:00" max="16:00"
                                            required
                                            class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50/50 dark:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all text-sm font-medium text-slate-700 dark:text-slate-200 [color-scheme:light] dark:[color-scheme:dark]">
                                    </div>
                                </div>
                                <div>
                                    <label for="keperluan"
                                        class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Keperluan
                                        Penggunaan</label>
                                    <textarea id="keperluan" name="keperluan" rows="4" required
                                        placeholder="Contoh: Diskusi pengerjaan tugas kelompok mata kuliah PBO..."
                                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50/50 dark:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all text-sm font-medium text-slate-700 dark:text-slate-200 placeholder-slate-400 dark:placeholder-slate-500 leading-relaxed">{{ old('keperluan') }}</textarea>
                                </div>

                                <div
                                    class="p-4 bg-orange-50/60 dark:bg-orange-900/20 rounded-xl border border-orange-100 dark:border-orange-800/50 text-[11px] text-orange-800 dark:text-orange-300 leading-relaxed transition-colors">
                                    <strong class="dark:text-orange-400">Pemberitahuan Sistem:</strong> Pengajuan booking
                                    akan berstatus <span class="font-bold">Pending</span> terlebih dahulu untuk menunggu
                                    peninjauan dan persetujuan dari Admin Perpustakaan Fasilkom.
                                </div>

                                <div class="pt-2">
                                    <button type="submit"
                                        onclick="return confirm('Apakah Anda yakin dengan jadwal dan keperluan yang telah diisi? Pastikan tidak ada kesalahan karena pengajuan akan langsung diproses.')"
                                        class="w-full py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-xl font-extrabold text-sm tracking-wide transition-all shadow-[0_10px_25px_-5px_rgba(249,115,22,0.4)] transform hover:-translate-y-0.5 active:scale-95 text-center">
                                        Kirim Pengajuan Booking
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section
        class="max-w-7xl mx-auto mb-10 bg-white dark:bg-slate-800 rounded-[2rem] border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden transition-colors">
        <div
            class="p-6 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 transition-colors">
            <div>
                <h3 class="text-lg font-bold text-slate-800 dark:text-white">Jadwal & Riwayat Penggunaan Ruang</h3>
                <p class="text-xs text-slate-400 mt-1">Daftar mahasiswa yang telah memesan atau sedang mengantre di ruangan
                    ini.</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead
                    class="bg-slate-50/70 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 font-bold text-[11px] uppercase tracking-wider border-b border-slate-100 dark:border-slate-700 transition-colors">
                    <tr>
                        <th class="px-6 py-4">Mahasiswa</th>
                        <th class="px-6 py-4">Waktu Peminjaman</th>
                        <th class="px-6 py-4">Keperluan Diskusi</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">
                    @forelse($peminjaman as $book)
                        <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors">

                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 dark:text-slate-200">
                                    {{ $book->user->name ?? 'Pengguna LibMate' }}</div>
                                <div class="text-[11px] text-slate-400 dark:text-slate-500 mt-0.5">
                                    {{ $book->user->email ?? '-' }}</div>
                            </td>

                            <td class="px-6 py-4">
                                <div
                                    class="font-semibold text-slate-700 dark:text-slate-300 flex items-center gap-1.5 text-xs">
                                    <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($book->tanggal_pinjam)->format('d M Y') }}
                                </div>
                                <div class="text-xs text-slate-400 flex items-center gap-1.5 mt-1 font-medium">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ substr($book->jam_mulai, 0, 5) }} - {{ substr($book->jam_selesai, 0, 5) }} WIB
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <p
                                    class="text-slate-600 dark:text-slate-400 text-xs max-w-xs md:max-w-md leading-relaxed break-words">
                                    {{ $book->keperluan }}
                                </p>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $colorMap = [
                                        'Pending' =>
                                            'bg-orange-50 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 border-orange-100 dark:border-orange-800/50',
                                        'Disetujui' =>
                                            'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 border-emerald-100 dark:border-emerald-800/50',
                                        'Ditolak' =>
                                            'bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 border-red-100 dark:border-red-800/50',
                                        'Dibatalkan' =>
                                            'bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 border-slate-200 dark:border-slate-600',
                                    ];
                                    $badgeStyle =
                                        $colorMap[$book->status] ??
                                        'bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-slate-700';
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold border {{ $badgeStyle }}">
                                    {{ $book->status }}
                                </span>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400 dark:text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-300 dark:text-slate-600 mb-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    <p class="text-xs font-semibold">Belum ada riwayat pemesanan jadwal.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($peminjaman->hasPages())
            <div
                class="px-6 py-4 border-t relative z-[99999999999999] border-slate-100 dark:border-slate-700 bg-slate-50/30 dark:bg-slate-800/50 pointer-events-auto transition-colors">
                {{ $peminjaman->links() }}
            </div>
        @endif

    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputMulai = document.getElementById('jam_mulai');
            const inputSelesai = document.getElementById('jam_selesai');

            function timeToMinutes(timeStr) {
                const parts = timeStr.split(':');
                return (parseInt(parts[0]) * 60) + parseInt(parts[1]);
            }

            function minutesToTime(totalMinutes) {
                const h = Math.floor(totalMinutes / 60);
                const m = totalMinutes % 60;
                return String(h).padStart(2, '0') + ':' + String(m).padStart(2, '0');
            }

            function validateTime() {
                let valMulai = inputMulai.value;
                let valSelesai = inputSelesai.value;

                // 1. AUTO-KOREKSI KESALAHAN AM / PM (01:00 AM - 04:00 AM)
                if (valMulai) {
                    let hMulai = parseInt(valMulai.split(':')[0]);
                    if (hMulai >= 1 && hMulai <= 4) {
                        inputMulai.value = minutesToTime((hMulai + 12) * 60 + parseInt(valMulai.split(':')[1]));
                    }
                }

                if (valSelesai) {
                    let hSelesai = parseInt(valSelesai.split(':')[0]);
                    if (hSelesai >= 1 && hSelesai <= 5) {
                        inputSelesai.value = minutesToTime((hSelesai + 12) * 60 + parseInt(valSelesai.split(':')[
                            1]));
                    }
                }

                valMulai = inputMulai.value;
                valSelesai = inputSelesai.value;

                // 2. KUNCI RENTANG JAM OPERASIONAL (08:00 - 16:00)
                const minWaktu = 8 * 60; // 08:00 Pagi
                const maxWaktu = 16 * 60; // 16:00 Sore
                const maxDurasi = 3 * 60; // 3 Jam

                if (valMulai) {
                    let minMulai = timeToMinutes(valMulai);
                    if (minMulai < minWaktu) {
                        inputMulai.value = '08:00';
                    } else if (minMulai > maxWaktu) {
                        inputMulai.value = '16:00';
                    }
                }

                if (valSelesai) {
                    let minSelesai = timeToMinutes(valSelesai);
                    if (minSelesai < minWaktu) {
                        inputSelesai.value = '08:00';
                    } else if (minSelesai > maxWaktu) {
                        inputSelesai.value = '16:00';
                    }
                }

                // 3. LOGIKA DURASI DAN KESALAHAN WAKTU MUNDUR
                valMulai = inputMulai.value;
                valSelesai = inputSelesai.value;

                if (valMulai && valSelesai) {
                    let minMulai = timeToMinutes(valMulai);
                    let minSelesai = timeToMinutes(valSelesai);
                    let selisih = minSelesai - minMulai;

                    if (selisih <= 0) {
                        alert('Jam selesai harus lebih besar dari jam mulai!');
                        let newSelesai = Math.min(minMulai + 60, maxWaktu);
                        inputSelesai.value = minutesToTime(newSelesai);
                    } else if (selisih > maxDurasi) {
                        alert('Maksimal durasi pemesanan adalah 3 jam!');
                        let newSelesai = Math.min(minMulai + maxDurasi, maxWaktu);
                        inputSelesai.value = minutesToTime(newSelesai);
                    }
                }
            }

            inputMulai.addEventListener('change', validateTime);
            inputSelesai.addEventListener('change', validateTime);
        });
    </script>
@endsection
