@extends('layouts.dashboard.app')

@section('title', 'Manajemen Pemesanan Ruang')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0 bg-slate-50">
        <div class="p-6 md:p-8 lg:p-10 max-w-7xl mx-auto">

            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Manajemen Pemesanan Ruang
                    </h1>
                    <p class="text-sm text-slate-400 mt-1">
                        Persetujuan izin peminjaman ruang diskusi perpustakaan dan riwayat booking mahasiswa.
                    </p>
                </div>
            </header>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <x-dashboard.stat-card judul="Total Booking" ikon="calendar" warna="blue" id="stat-total-booking"
                    nilai="{{ $totalBooking }}" />
                <x-dashboard.stat-card judul="Menunggu Persetujuan" ikon="clock" warna="orange" id="stat-pending-booking"
                    nilai="{{ $pendingBooking }}" />
                <x-dashboard.stat-card judul="Booking Disetujui" ikon="check-circle" warna="emerald"
                    id="stat-approved-booking" nilai="{{ $approvedBooking }}" />
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div
                    class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col md:flex-row gap-4 justify-between items-center">
                    <form action="#" method="GET" class="relative w-full md:w-96">
                        <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama mahasiswa atau NIM..."
                            class="w-full bg-white border border-slate-200 rounded-xl py-2 pl-10 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-orange-200 transition-all" />
                    </form>

                    <div class="flex gap-2 w-full md:w-auto overflow-x-auto">
                        <a href="{{ route('manajemen-peminjaman') }}"
                            class="px-4 py-2 rounded-xl {{ !request('status') ? 'bg-slate-800 text-white' : 'bg-white border border-slate-200 text-slate-600' }} text-xs font-semibold shadow-sm">Semua</a>
                        <a href="{{ route('manajemen-peminjaman', ['status' => 'Pending']) }}"
                            class="px-4 py-2 rounded-xl {{ request('status') === 'Pending' ? 'bg-slate-800 text-white' : 'bg-white border border-slate-200 text-slate-600' }} text-xs font-semibold shadow-sm">Pending</a>
                        <a href="{{ route('manajemen-peminjaman', ['status' => 'Disetujui']) }}"
                            class="px-4 py-2 rounded-xl {{ request('status') === 'Disetujui' ? 'bg-slate-800 text-white' : 'bg-white border border-slate-200 text-slate-600' }} text-xs font-semibold shadow-sm">Disetujui</a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left border-collapse">
                        <thead
                            class="bg-slate-50 text-slate-600 font-semibold text-xs uppercase tracking-wider border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4">Mahasiswa</th>
                                <th class="px-6 py-4">Ruangan</th>
                                <th class="px-6 py-4">Waktu Akses</th>
                                <th class="px-6 py-4">Keperluan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Aksi Persetujuan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            {{-- Menggunakan variabel $peminjamans dari Controller nantinya --}}
                            @forelse ($peminjamans as $booking)
                                <tr class="hover:bg-slate-50/80 transition-colors">

                                    <td class="px-6 py-4">
                                        {{-- Sesuaikan properti relasi User/Mahasiswa Anda --}}
                                        <div class="font-bold text-slate-800">
                                            {{ $booking->user->name ?? 'Nama Mahasiswa' }}
                                        </div>
                                        <div class="text-xs text-slate-400">NIM {{ $booking->user->nim ?? '242410101xxx' }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-slate-700">{{ $booking->ruangan->nama_ruang }}</div>
                                        <div class="text-xs text-slate-400">Lantai {{ $booking->ruangan->lantai }}</div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-slate-700 flex items-center gap-1.5">
                                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-slate-400"></i>
                                            {{ \Carbon\Carbon::parse($booking->tanggal_pinjam)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-slate-400 flex items-center gap-1.5 mt-0.5">
                                            <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                                            {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }} WIB
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <p class="text-sm text-slate-600 max-w-xs truncate"
                                            title="{{ $booking->keperluan }}">
                                            {{ $booking->keperluan }}
                                        </p>
                                    </td>

                                    <td class="px-6 py-4">
                                        @php
                                            $badgeColor =
                                                [
                                                    'Pending' => 'bg-orange-50 text-orange-600 border-orange-100',
                                                    'Disetujui' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                    'Ditolak' => 'bg-red-50 text-red-600 border-red-100',
                                                    'Selesai' => 'bg-slate-100 text-slate-600 border-slate-200',
                                                ][$booking->status] ?? 'bg-slate-50 text-slate-600';
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold border {{ $badgeColor }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-1.5">
                                            @if ($booking->status === 'Pending')
                                                <form action="{{ route('manajemen-booking.status', $booking->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin MENYETUJUI peminjaman ruang ini?');">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="Disetujui">
                                                    <button type="submit" title="Setujui Peminjaman"
                                                        class="p-2 text-emerald-600 hover:bg-emerald-50 border border-transparent hover:border-emerald-200 rounded-xl transition">
                                                        <i data-lucide="check" class="w-4 h-4"></i>
                                                    </button>
                                                </form>

                                                <form action="{{ route('manajemen-booking.status', $booking->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin MENOLAK peminjaman ruang ini?');">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="Ditolak">
                                                    <button type="submit" title="Tolak Peminjaman"
                                                        class="p-2 text-red-500 hover:bg-red-50 border border-transparent hover:border-red-200 rounded-xl transition">
                                                        <i data-lucide="x" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('manajemen-booking.status', $booking->id) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Anda yakin ingin meralat/membatalkan keputusan ini dan mengembalikannya ke status Pending?');">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="Pending">
                                                    <button type="submit" title="Ralat Keputusan (Kembali ke Pending)"
                                                        class="flex items-center gap-1.5 p-2 text-slate-400 hover:text-orange-500 hover:bg-orange-50 border border-transparent hover:border-orange-200 rounded-xl transition">
                                                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center text-slate-400">
                                            <i data-lucide="calendar-x" class="w-12 h-12 mb-3 opacity-20"></i>
                                            <p class="font-medium">Belum ada riwayat atau pengajuan pemesanan ruang.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($peminjamans->hasPages())
                    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                        {{ $peminjamans->links() }}
                    </div>
                @endif

            </div>
        </div>
    </main>
@endsection
