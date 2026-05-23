@extends('layouts.app') {{-- Sesuaikan dengan layout dashboard Anda --}}

@section('title', 'Profil Anggota | LibMate')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0 bg-slate-50">
        <div class="p-6 md:p-8 lg:p-10 max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 tracking-wider uppercase mb-1">
                        Manajemen Mahasiswa <span class="mx-1.5">›</span> Detail Profil
                    </p>
                    <h1 class="text-3xl font-bold text-slate-800">Profil Anggota</h1>
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto">
                    <a href="#"
                        class="flex items-center justify-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-5 py-2.5 rounded-full text-sm font-semibold transition-all shadow-sm">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Kembali
                    </a>
                    <a href="#"
                        class="flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-md shadow-orange-200">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        Edit Profil
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

                <div class="lg:col-span-4 space-y-6">

                    <div
                        class="bg-white rounded-3xl border border-slate-200 shadow-sm p-8 flex flex-col items-center text-center">
                        <div class="relative mb-5">
                            <div
                                class="w-28 h-28 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-3xl font-extrabold shadow-inner">
                                {{ strtoupper(substr($mahasiswa->name ?? 'FA', 0, 2)) }}
                            </div>
                            <span
                                class="absolute bottom-1 right-2 w-5 h-5 bg-emerald-500 border-4 border-white rounded-full"></span>
                        </div>

                        <h2 class="text-xl font-bold text-slate-800 mb-1">{{ $mahasiswa->name ?? 'Nama Lengkap' }}</h2>
                        <p class="text-sm text-slate-400 font-medium mb-4">{{ $mahasiswa->nim ?? 'NIM Mahasiswa' }}</p>

                        <span
                            class="inline-flex items-center px-4 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-wide">
                            Aktif
                        </span>
                    </div>

                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6">
                        <h3 class="text-xs font-bold text-orange-500 tracking-wider uppercase mb-4">Akses Perpustakaan</h3>
                        <div class="flex flex-col space-y-4">

                            <div class="flex items-center justify-between pb-1">
                                <span class="text-sm font-semibold text-slate-600">Peminjaman Buku</span>
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                            </div>

                            <div class="flex items-center justify-between pb-1">
                                <span class="text-sm font-semibold text-slate-600">Akses E-Library</span>
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-sm font-semibold text-slate-600">Booking Ruang</span>
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500"></i>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="lg:col-span-8">
                    <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden flex flex-col">

                        <div class="px-8 py-5 border-b border-slate-100 flex items-center gap-3 bg-white">
                            <div class="p-2 bg-orange-50 rounded-xl text-orange-500">
                                <i data-lucide="user" class="w-5 h-5"></i>
                            </div>
                            <h2 class="text-lg font-bold text-slate-800">Informasi Akademik</h2>
                        </div>

                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-8 gap-x-8">

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nama
                                        Lengkap</p>
                                    <div class="flex items-center gap-2.5 text-slate-800 font-bold text-sm">
                                        <i data-lucide="user-check" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                        {{ $mahasiswa->name ?? '-' }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Nomor
                                        Induk Mahasiswa</p>
                                    <div class="flex items-center gap-2.5 text-slate-800 font-bold text-sm">
                                        <i data-lucide="credit-card" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                        {{ $mahasiswa->nim ?? '-' }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Fakultas
                                    </p>
                                    <div class="flex items-center gap-2.5 text-slate-800 font-bold text-sm">
                                        <i data-lucide="graduation-cap" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                        {{ $mahasiswa->fakultas ?? 'Ilmu Komputer' }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Email
                                        Institusi</p>
                                    <div class="flex items-center gap-2.5 text-orange-600 font-bold text-sm break-all">
                                        <i data-lucide="mail" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                        {{ $mahasiswa->email ?? '-' }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Tanggal
                                        Terdaftar</p>
                                    <div class="flex items-center gap-2.5 text-slate-700 font-semibold text-sm">
                                        <i data-lucide="calendar" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                        {{ $mahasiswa->created_at ? $mahasiswa->created_at->format('d M Y') : date('d M Y') }}
                                    </div>
                                </div>

                                <div>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">Terakhir
                                        Diperbarui</p>
                                    <div class="flex items-center gap-2.5 text-slate-700 font-semibold text-sm">
                                        <i data-lucide="clock" class="w-4 h-4 text-slate-400 shrink-0"></i>
                                        {{ $mahasiswa->updated_at ? $mahasiswa->updated_at->diffForHumans() : 'Baru saja' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div
                            class="px-8 py-5 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <p class="text-xs text-slate-400 italic leading-relaxed">
                                *Data ini merupakan data resmi sistem perpustakaan LibMate.
                            </p>

                            {{-- Tombol Hapus Akun Permanen (Hanya muncul jika diakses oleh admin) --}}
                            <form action="#" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini secara permanen dari sistem?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-1.5 text-xs font-bold text-red-500 hover:text-red-600 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    Hapus Data permanen
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
