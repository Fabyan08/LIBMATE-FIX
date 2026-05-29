@extends('layouts.dashboard.app')

@section('title', 'Edit Data Ruangan')

@section('content')
    <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0 bg-slate-50">
        <div class="p-6 md:p-8 lg:p-10 max-w-5xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">Edit Ruangan: {{ $ruangan->nama_ruang }}</h1>
                    <p class="text-sm text-slate-500 mt-1">Perbarui informasi ruangan sesuai kebutuhan.</p>
                </div>
                <a href="{{ route('manajemen-ruang') }}"
                    class="flex items-center justify-center gap-2 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 px-4 py-2 rounded-xl text-sm font-semibold transition-all shadow-sm">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Kembali
                </a>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8">
                <form action="{{ route('manajemen-ruang.update', $ruangan->id) }}" method="POST"
                    enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Ruangan</label>

                        @if ($ruangan->gambar)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $ruangan->gambar) }}" alt="Foto {{ $ruangan->nama_ruang }}"
                                    class="h-32 w-48 object-cover rounded-xl border border-slate-200">
                                <p class="text-xs text-slate-500 mt-2">Biarkan kosong jika tidak ingin mengubah foto.</p>
                            </div>
                        @endif

                        <div class="flex items-center w-full">
                            <label for="gambar"
                                class="flex items-center justify-center px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-l-xl cursor-pointer hover:bg-slate-100 transition-colors text-sm font-semibold text-slate-600">
                                Pilih File Baru
                            </label>
                            <input type="file" id="gambar" name="gambar" class="hidden"
                                onchange="document.getElementById('file-name').textContent = this.files[0].name">
                            <div class="flex-1 px-4 py-2.5 border border-l-0 border-slate-200 rounded-r-xl text-sm text-slate-500 bg-white truncate"
                                id="file-name">
                                No file chosen
                            </div>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-1.5">*Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_ruang" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                                Ruang</label>
                            <input type="text" id="nama_ruang" name="nama_ruang"
                                value="{{ old('nama_ruang', $ruangan->nama_ruang) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm">
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-semibold text-slate-700 mb-2">Kategori
                                Ruangan</label>
                            <select id="kategori" name="kategori" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm appearance-none">
                                <option value="" disabled>Pilih Kategori</option>
                                <option value="Ruang Diskusi"
                                    {{ old('kategori', $ruangan->kategori) == 'Ruang Diskusi' ? 'selected' : '' }}>Ruang
                                    Diskusi</option>
                                <option value="Ruang Meeting"
                                    {{ old('kategori', $ruangan->kategori) == 'Ruang Meeting' ? 'selected' : '' }}>Ruang
                                    Meeting</option>
                                <option value="Ruang Tenang"
                                    {{ old('kategori', $ruangan->kategori) == 'Ruang Tenang' ? 'selected' : '' }}>Ruang
                                    Tenang</option>
                            </select>
                        </div>

                        <div>
                            <label for="lantai" class="block text-sm font-semibold text-slate-700 mb-2">Lantai</label>
                            <input type="number" id="lantai" name="lantai"
                                value="{{ old('lantai', $ruangan->lantai) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm">
                        </div>

                        <div>
                            <label for="kapasitas" class="block text-sm font-semibold text-slate-700 mb-2">Kapasitas
                                (Orang)</label>
                            <input type="number" id="kapasitas" name="kapasitas"
                                value="{{ old('kapasitas', $ruangan->kapasitas) }}" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all text-sm">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700">Fasilitas Ruangan</label>
                                <p class="text-xs text-slate-500 mt-0.5">Pilih fasilitas yang tersedia di ruangan ini.</p>
                            </div>

                            <button type="button" onclick="toggleFasilitasModal('modal-fasilitas')"
                                class="flex items-center gap-1.5 px-3 py-1.5 bg-orange-50 text-orange-600 hover:bg-orange-100 rounded-lg text-xs font-bold transition-colors">
                                <i data-lucide="settings-2" class="w-3.5 h-3.5"></i>
                                Kelola Master Fasilitas
                            </button>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3" id="checkbox-container">
                            @php
                                $ruangan_fasilitas_ids = $ruangan->fasilitas->pluck('id')->toArray();
                            @endphp

                            @foreach ($fasilitas as $fas)
                                <label id="check-fasilitas-{{ $fas->id }}"
                                    class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors group">
                                    <input type="checkbox" name="fasilitas[]" value="{{ $fas->id }}"
                                        {{ in_array($fas->id, old('fasilitas', $ruangan_fasilitas_ids)) ? 'checked' : '' }}
                                        class="w-4 h-4 text-orange-500 border-slate-300 rounded focus:ring-orange-500 cursor-pointer">
                                    <span
                                        class="ml-3 text-sm text-slate-600 group-hover:text-slate-800 font-medium">{{ $fas->nama_fasilitas }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit"
                            class="flex items-center gap-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl text-sm font-bold transition shadow-lg shadow-orange-500/30">
                            <i data-lucide="save" class="w-4 h-4"></i>
                            Perbarui Data Ruangan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <div id="modal-fasilitas" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity opacity-0" id="modal-overlay"
            onclick="toggleFasilitasModal('modal-fasilitas')"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    id="modal-panel">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-lg font-bold text-slate-800" id="modal-title">Kelola Master Fasilitas</h3>
                            <button type="button" onclick="toggleFasilitasModal('modal-fasilitas')"
                                class="text-slate-400 hover:text-slate-600 bg-slate-50 hover:bg-slate-100 p-1.5 rounded-lg transition-colors"><i
                                    data-lucide="x" class="w-5 h-5"></i></button>
                        </div>
                        <form id="form-fasilitas" class="mb-6 flex gap-3">
                            @csrf
                            <input type="text" id="input_nama_fasilitas" name="nama_fasilitas"
                                placeholder="Ketik nama fasilitas baru..." required
                                class="flex-1 px-4 py-2.5 rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-orange-500 text-sm">
                            <button type="button" onclick="tambahFasilitas()"
                                class="bg-slate-800 hover:bg-slate-900 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors">Tambah</button>
                        </form>
                        <div>
                            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Daftar Fasilitas
                                Saat Ini</p>
                            <div id="container-daftar-fasilitas"
                                class="max-h-60 overflow-y-auto border border-slate-100 rounded-xl divide-y divide-slate-100">
                                @foreach ($fasilitas as $fas)
                                    <div id="baris-fasilitas-{{ $fas->id }}"
                                        class="flex justify-between items-center p-3 hover:bg-slate-50">
                                        <span class="text-sm font-medium text-slate-700">{{ $fas->nama_fasilitas }}</span>
                                        <button type="button" onclick="hapusFasilitas({{ $fas->id }})"
                                            class="text-slate-400 hover:text-red-500 transition-colors"><i
                                                data-lucide="trash-2" class="w-4 h-4"></i></button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // fungsi untuk membuka dan menutup modal fasilitas
        function toggleFasilitasModal(modalID) {
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
        // fungsi untuk menambahkan fasilitas baru melalui AJAX
        function tambahFasilitas() {
            let input = document.getElementById('input_nama_fasilitas');
            let namaFasilitas = input.value;
            let token = document.querySelector('input[name="_token"]').value;

            if (namaFasilitas.trim() === '') {
                alert('Nama fasilitas tidak boleh kosong!');
                return;
            }
            // Kirim permintaan AJAX untuk menambahkan fasilitas baru
            fetch('{{ route('api.fasilitas.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        nama_fasilitas: namaFasilitas
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        input.value = '';

                        let containerModal = document.getElementById('container-daftar-fasilitas');
                        let barisModal = `
                            <div id="baris-fasilitas-${data.data.id}" class="flex justify-between items-center p-3 hover:bg-slate-50">
                                <span class="text-sm font-medium text-slate-700">${data.data.nama_fasilitas}</span>
                                <button type="button" onclick="hapusFasilitas(${data.data.id})" class="text-slate-400 hover:text-red-500 transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                            </div>`;
                        containerModal.insertAdjacentHTML('afterbegin', barisModal);


                        let containerForm = document.getElementById('checkbox-container');
                        let checkboxBaru = `
                            <label id="check-fasilitas-${data.data.id}" class="flex items-center p-3 border border-slate-200 rounded-xl cursor-pointer hover:bg-slate-50 transition-colors group">
                                <input type="checkbox" name="fasilitas[]" value="${data.data.id}" checked class="w-4 h-4 text-orange-500 border-slate-300 rounded focus:ring-orange-500 cursor-pointer">
                                <span class="ml-3 text-sm text-slate-600 group-hover:text-slate-800 font-medium">${data.data.nama_fasilitas}</span>
                            </label>`;
                        containerForm.insertAdjacentHTML('beforeend', checkboxBaru);

                        lucide.createIcons();
                    } else {
                        alert('Gagal menambahkan fasilitas.');
                    }
                }).catch(error => console.error('Error:', error));
        }
// fungsi untuk menghapus fasilitas melalui AJAX
        function hapusFasilitas(id) {
            if (!confirm('Yakin ingin menghapus fasilitas ini?')) return;
            let token = document.querySelector('input[name="_token"]').value;

            fetch(`/api/fasilitas/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        document.getElementById(`baris-fasilitas-${id}`).remove();

                        let checkboxElem = document.getElementById(`check-fasilitas-${id}`);
                        if (checkboxElem) checkboxElem.remove();
                    }
                }).catch(error => console.error('Error:', error));
        }
    </script>
@endsection
