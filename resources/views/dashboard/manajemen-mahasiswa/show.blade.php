@extends('layouts.dashboard.app')

@section('title', 'Detail Mahasiswa - ' . $mahasiswa->nama)

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
        <div class="p-6 md:p-8 lg:p-10 max-w-5xl mx-auto">
            {{-- Breadcrumb & Back Action --}}
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-2 uppercase tracking-wider">
                        <a href="{{ route('manajemen-mahasiswa') }}" class="hover:text-orange-500 transition-colors">Manajemen
                            Mahasiswa</a>
                        <i data-lucide="chevron-right" class="w-3 h-3"></i>
                        <span class="text-slate-600">Detail Profil</span>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        Profil Mahasiswa
                    </h1>
                </div>

                <div class="flex items-center gap-3 w-full md:w-auto">
                    <a href="{{ route('manajemen-mahasiswa') }}"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-white border border-slate-200 text-slate-600 px-5 py-2.5 rounded-full text-sm font-semibold transition hover:bg-slate-50">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Kembali
                    </a>
                    <a href="{{ route('manajemen-mahasiswa.edit', $mahasiswa->id) }}"
                        class="flex-1 md:flex-none flex items-center justify-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-5 py-2.5 rounded-full text-sm font-semibold transition shadow-md shadow-orange-200">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                        Edit Profil
                    </a>
                </div>
            </header>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Sisi Kiri: Ringkasan Profil --}}
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white rounded-3xl border border-slate-200 p-8 text-center shadow-sm">
                        <div class="relative w-32 h-32 mx-auto mb-6">
                            <div
                                class="w-full h-full bg-orange-100 rounded-full flex items-center justify-center text-orange-600 text-4xl font-bold border-4 border-white shadow-sm">
                                @if ($mahasiswa->foto)
                                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Mahasiswa"
                                        class="w-full h-full object-cover rounded-full">
                                @else
                                    {{ strtoupper(substr($mahasiswa->nama, 0, 1)) }}
                                @endif
                            </div>
                            <div
                                class="absolute bottom-1 right-1 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm">
                                <div
                                    class="w-5 h-5 rounded-full {{ $mahasiswa->status == 'Aktif' ? 'bg-emerald-500' : 'bg-slate-300' }}">
                                </div>
                            </div>
                        </div>
                        <h2 class="text-xl font-bold text-slate-800 leading-tight">{{ $mahasiswa->nama }}</h2>
                        <p class="text-sm text-slate-400 mt-1">{{ $mahasiswa->nim }}</p>

                        @php
                            $badgeStyles = [
                                'Aktif' => 'bg-emerald-100 text-emerald-700',
                                'Suspended' => 'bg-red-100 text-red-700',
                                'Lulus' => 'bg-blue-100 text-blue-700',
                                'Cuti' => 'bg-orange-100 text-orange-700',
                            ];
                        @endphp
                        <div class="mt-4">
                            <span
                                class="inline-flex items-center px-4 py-1 rounded-full text-xs font-bold {{ $badgeStyles[$mahasiswa->status] ?? 'bg-slate-100 text-slate-700' }}">
                                {{ strtoupper($mahasiswa->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Info Tambahan (Status Akun) --}}
                    <div class="bg-white  rounded-3xl p-6 text-orange-500 shadow-xl">
                        <h3 class="text-sm font-semibold opacity-60 mb-4 uppercase tracking-widest">Akses Perpustakaan</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm opacity-80">Peminjaman Buku</span>
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400"></i>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm opacity-80">Akses E-Library</span>
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400"></i>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm opacity-80">Booking Ruang</span>
                                <i data-lucide="{{ $mahasiswa->status == 'Aktif' ? 'check-circle-2' : 'x-circle' }}"
                                    class="w-5 h-5 {{ $mahasiswa->status == 'Aktif' ? 'text-emerald-400' : 'text-red-400' }}"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sisi Kanan: Detail Informasi --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
                        <div class="px-8 py-6 border-b border-slate-100 flex items-center gap-3 bg-slate-50/50">
                            <div class="p-2 bg-white rounded-xl shadow-sm">
                                <i data-lucide="user-check" class="w-5 h-5 text-orange-500"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-lg">Informasi Akademik</h3>
                        </div>

                        <div class="p-8">
                            <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-10">
                                <div>
                                    <dt class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap
                                    </dt>
                                    <dd class="text-slate-800 font-semibold flex items-center gap-2">
                                        <i data-lucide="user" class="w-4 h-4 text-slate-300"></i>
                                        {{ $mahasiswa->name }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Nomor Induk
                                        Mahasiswa</dt>
                                    <dd class="text-slate-800 font-semibold flex items-center gap-2">
                                        <i data-lucide="credit-card" class="w-4 h-4 text-slate-300"></i>
                                        {{ $mahasiswa->nim }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Fakultas
                                    </dt>
                                    <dd class="text-slate-800 font-semibold flex items-center gap-2">
                                        <i data-lucide="graduation-cap" class="w-4 h-4 text-slate-300"></i>
                                        {{ $mahasiswa->fakultas }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email
                                        Institusi</dt>
                                    <dd
                                        class="text-orange-600 font-semibold flex items-center gap-2 underline decoration-orange-200">
                                        <i data-lucide="mail" class="w-4 h-4 text-slate-300"></i>
                                        {{ $mahasiswa->email }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tanggal
                                        Terdaftar</dt>
                                    <dd class="text-slate-800 font-semibold flex items-center gap-2">
                                        <i data-lucide="calendar" class="w-4 h-4 text-slate-300"></i>
                                        {{ $mahasiswa->created_at->format('d F Y') }}
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Terakhir
                                        Diperbarui</dt>
                                    <dd class="text-slate-800 font-semibold flex items-center gap-2">
                                        <i data-lucide="clock" class="w-4 h-4 text-slate-300"></i>
                                        {{ $mahasiswa->updated_at->diffForHumans() }}
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        {{-- Footer Card --}}
                        <div class="px-8 py-5 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                            <p class="text-xs text-slate-400 italic">*Data ini merupakan data resmi sistem perpustakaan
                                LibMate.</p>

                            {{-- Tombol Delete dengan Form --}}
                            <form action="{{ route('manajemen-mahasiswa.destroy', $mahasiswa->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-xs font-bold text-red-400 hover:text-red-600 transition-colors flex items-center gap-1.5">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
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
