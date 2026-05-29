@extends('layouts.app')

@section('title', 'Profil | LibMate Universitas Jember')

@section('content')

    <div class="w-full min-h-screen bg-slate-50 dark:bg-slate-900 pt-32 pb-20 font-sans transition-colors duration-300">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 relative">

            @if (session('status'))
                <div
                    class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-200 dark:border-emerald-800/50 text-emerald-700 dark:text-emerald-400 rounded-2xl flex items-center gap-3 text-sm font-semibold shadow-sm transition-colors">
                    <svg class="w-5 h-5 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-1 items-start md:grid-cols-2 gap-6 mb-6">
                <div
                    class="bg-white dark:bg-slate-800 rounded-[2rem] shadow-sm dark:shadow-none border border-emerald-100 dark:border-emerald-800/30 relative pt-16 pb-0 mt-16 transition-colors">

                    <div
                        class="absolute top-6 left-6 border border-emerald-200 dark:border-emerald-800/50 text-orange-500 dark:text-orange-400 bg-emerald-50 dark:bg-emerald-900/30 px-3 py-1 rounded-lg text-[10px] font-bold tracking-wider uppercase transition-colors">
                        Mahasiswa
                    </div>

                    <div class="absolute -top-16 left-1/2 transform -translate-x-1/2">
                        <div
                            class="w-32 h-32 rounded-full border-[6px] border-white dark:border-slate-800 bg-orange-100 dark:bg-slate-700 flex items-center justify-center shadow-sm text-orange-600 dark:text-orange-500 text-4xl font-extrabold transition-colors">
                            @if ($mahasiswa->foto)
                                <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Profil"
                                    class="w-full h-full object-cover rounded-full">
                            @else
                                {{ strtoupper(substr($mahasiswa->name ?? 'MA', 0, 2)) }}
                            @endif
                        </div>
                    </div>

                    <div class="text-center px-6 mt-4">
                        <h1 class="text-3xl font-bold text-slate-800 dark:text-white transition-colors">
                            {{ $mahasiswa->name ?? 'Nama Lengkap' }}</h1>
                        <div class="w-12 h-1.5 bg-emerald-500 dark:bg-emerald-600 rounded-full mx-auto mt-4 mb-6"></div>

                        <div class="flex justify-center items-center gap-3 mb-8">
                            <button onclick="toggleModal('edit-profil-modal')"
                                class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-md shadow-orange-200 dark:shadow-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                    </path>
                                </svg>
                                Edit Profil
                            </button>

                            <form action="{{ route('logout') }}" method="POST" class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/40 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/50 px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-sm dark:shadow-none">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>

                    <div
                        class="bg-[#eaf5ea] dark:bg-slate-700/50 rounded-b-[2rem] px-8 py-5 flex flex-col sm:flex-row justify-between items-start sm:items-center text-sm font-medium text-slate-700 dark:text-slate-300 transition-colors">
                        <div class="space-y-1">
                            <p><span class="font-bold text-slate-800 dark:text-white">Email:</span>
                                {{ $mahasiswa->email ?? 'mahasiswa@student.unej.ac.id' }}</p>
                            <p><span class="font-bold text-slate-800 dark:text-white">Fakultas:</span>
                                {{ $mahasiswa->fakultas ?? 'Ilmu Komputer' }}</p>
                        </div>
                        <div class="mt-3 sm:mt-0 text-slate-500 dark:text-slate-400">
                            Jember, ID
                        </div>
                    </div>
                </div>

                <div class="mb-6 md:mt-16">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm dark:shadow-none border border-emerald-100 dark:border-emerald-800/30 p-6 flex flex-col transition-colors h-full">
                        <div class="flex items-center gap-2 mb-6 text-orange-500 dark:text-orange-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold dark:text-white">Tentang</h3>
                        </div>
                        <div class="space-y-3 text-sm text-slate-600 dark:text-slate-300">
                            <p><span class="font-bold text-slate-800 dark:text-white">NIM:</span>
                                {{ $mahasiswa->nim ?? '-' }}</p>
                            <p><span class="font-bold text-slate-800 dark:text-white">Kampus:</span> Universitas Jember</p>
                            <p><span class="font-bold text-slate-800 dark:text-white">Status:</span> Aktif</p>
                            <p><span class="font-bold text-slate-800 dark:text-white">Terdaftar:</span>
                                {{ $mahasiswa->created_at ? $mahasiswa->created_at->format('l, d M Y') : date('l, d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role === 'mahasiswa')
                <div class="mt-8">
                    <div
                        class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm dark:shadow-none border border-emerald-100 dark:border-emerald-800/30 overflow-hidden transition-colors">
                        <div
                            class="p-6 border-b border-emerald-50 dark:border-slate-700 flex items-center gap-3 text-orange-500 dark:text-orange-400 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <h3 class="text-xl font-semibold text-slate-800 dark:text-white">Riwayat Pemesanan Ruangan</h3>
                        </div>

                        <div class="overflow-x-auto relative">
                            <table class="w-full text-left">
                                <thead
                                    class="bg-slate-50 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider transition-colors">
                                    <tr>
                                        <th class="px-6 py-4">Ruangan</th>
                                        <th class="px-6 py-4">Waktu</th>
                                        <th class="px-6 py-4">Keperluan</th>
                                        <th class="px-6 py-4">Status</th>
                                        <th class="px-6 py-4 text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                                    @forelse($mahasiswa->peminjamans as $booking)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4 font-bold text-slate-800 dark:text-slate-200">
                                                {{ $booking->ruangan->nama_ruang ?? 'Ruang' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                                {{ \Carbon\Carbon::parse($booking->tanggal_pinjam)->format('d M Y') }} <br>
                                                <b> {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}</b>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                                {{ $booking->keperluan }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @php
                                                    $colorMap = [
                                                        'Pending' =>
                                                            'bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400',
                                                        'Disetujui' =>
                                                            'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
                                                        'Ditolak' =>
                                                            'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
                                                        'Dibatalkan' =>
                                                            'bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-400',
                                                    ];
                                                    $badgeClass =
                                                        $colorMap[$booking->status] ??
                                                        'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300';
                                                @endphp
                                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $badgeClass }}">
                                                    {{ $booking->status }}
                                                </span>
                                            </td>

                                            <td class="px-6 py-4 text-right">
                                                @if ($booking->status === 'Pending')
                                                    <form action="{{ route('booking.batal', $booking->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini? Aksi ini tidak dapat diurungkan.');">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="flex items-center justify-end w-full gap-1 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-bold text-xs transition">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-16v1a3 3 0 003 3h10M4 7h16">
                                                                </path>
                                                            </svg>
                                                            Batalkan
                                                        </button>
                                                    </form>
                                                @else
                                                    <span
                                                        class="text-xs text-slate-500 dark:text-slate-500 italic">Dikunci</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center p-6 text-slate-400 dark:text-slate-500">
                                                Belum ada pemesanan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div id="edit-profil-modal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/50 dark:bg-slate-900/80 backdrop-blur-sm transition-opacity opacity-0"
            id="modal-overlay" onclick="toggleModal('edit-profil-modal')"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-[2rem] bg-white dark:bg-slate-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    id="modal-panel">

                    <div class="px-6 py-8">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-extrabold text-slate-800 dark:text-white">Edit Profil Anda</h3>
                            <button type="button" onclick="toggleModal('edit-profil-modal')"
                                class="text-slate-400 hover:text-red-500 dark:text-slate-500 dark:hover:text-red-400 bg-slate-50 hover:bg-red-50 dark:bg-slate-700/50 dark:hover:bg-red-900/30 p-2 rounded-full transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-5">
                            @csrf
                            @method('PUT')

                            {{-- profil --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Foto
                                    Profil</label>
                                <div
                                    class="w-24 h-24 rounded-full border-[4px] border-white dark:border-slate-800 bg-orange-100 dark:bg-slate-700 flex items-center justify-center shadow-sm text-orange-600 dark:text-orange-500 text-lg font-extrabold transition-colors">
                                    <input type="file" name="foto" accept="image/*"
                                        class="relative w-full h-full opacity-0 cursor-pointer">
                                    @if ($mahasiswa->foto)
                                        <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Profil"
                                            class="w-full h-full object-cover rounded-full">
                                    @else
                                        {{ strtoupper(substr($mahasiswa->name ?? 'MA', 0, 2)) }}
                                    @endif
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Nama
                                    Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $mahasiswa->name ?? '') }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm text-slate-800 dark:text-slate-200 transition-colors">
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">NIM</label>
                                <input type="text" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm text-slate-800 dark:text-slate-200 transition-colors">
                            </div>


                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1.5">Fakultas</label>
                                <input type="text" name="fakultas"
                                    value="{{ old('fakultas', $mahasiswa->fakultas ?? '') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm text-slate-800 dark:text-slate-200 transition-colors">
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-500 dark:text-slate-500 mb-1.5">Email</label>
                                <input type="email" name="email" value="{{ old('email', $mahasiswa->email ?? '') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm text-slate-800 dark:text-slate-200 transition-colors">
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-500 dark:text-slate-500 mb-1.5">Password
                                    Baru</label>
                                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-slate-50 dark:bg-slate-900/50 focus:bg-white dark:focus:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm text-slate-800 dark:text-slate-200 transition-colors">
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-orange-500/30 dark:shadow-none transform hover:-translate-y-0.5">
                                    Simpan Perubahan
                                </button>
                                {{-- tutup --}}
                                <a href=""
                                    class="block text-center text-orange-500 hover:text-orange-600 font-medium mt-2">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- fungsi untuk toggle modal --}}
    <script>
        function toggleModal(modalID) {
            const modal = document.getElementById(modalID);
            const overlay = document.getElementById('modal-overlay');
            const panel = document.getElementById('modal-panel');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    panel.classList.remove('opacity-0', 'translate-y-4', 'sm:scale-95');
                }, 10);
            } else {
                overlay.classList.add('opacity-0');
                panel.classList.add('opacity-0', 'translate-y-4', 'sm:scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300);
            }
        }
    </script>
@endsection
