<aside class="hidden xl:flex w-80 bg-white border-l border-slate-100 flex-col h-full overflow-y-auto">
    <div class="p-8 pb-6 flex flex-col items-center border-b border-slate-50">
        <div class="relative mb-4">
            @if (Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
                    class="w-16 h-16 rounded-full object-cover">
            @else
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=FB923C&color=fff&size=120"
                    alt="Profile" class="w-24 h-24 rounded-full border-4 border-white shadow-md" />
            @endif
            <div class="absolute bottom-1 right-1 w-4 h-4 bg-emerald-400 border-2 border-white rounded-full"></div>
        </div>
        <h3 class="text-lg font-bold text-slate-800">{{ Auth::user()->name }}</h3>
        <p class="text-xs text-slate-400 mt-1">Admin Perpustakaan</p>

        <button onclick="toggleModal('modal-edit-profil')"
            class="mt-5 w-full flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-slate-600 py-2.5 rounded-xl text-sm font-medium transition-colors border border-slate-100">
            <i data-lucide="edit-3" class="w-4 h-4"></i> Edit Profil
        </button>

        <div id="modal-edit-profil" class="fixed inset-0 z-[100] hidden">
            <div id="modal-overlay"
                class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm opacity-0 transition-opacity duration-300">
            </div>

            <div id="modal-panel"
                class="absolute inset-0 flex items-center justify-center p-4 opacity-0 translate-y-4 transition-all duration-300">
                <div class="bg-white rounded-3xl shadow-xl w-full max-w-md p-8 relative">
                    <h2 class="text-xl font-bold text-slate-800 mb-6">Edit Profil Admin</h2>

                    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Nama</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}"
                                class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Foto Profil</label>
                            <input type="file" name="foto"
                                class="w-full mt-1 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-orange-50 file:text-orange-700">
                        </div>

                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Password Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah"
                                class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm">
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="button" onclick="toggleModal('modal-edit-profil')"
                                class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm">Batal</button>
                            <button type="submit"
                                class="flex-1 py-2.5 rounded-xl bg-orange-600 text-white font-semibold text-sm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex gap-4 w-full mt-6">
            <div class="bg-orange-50 rounded-2xl p-3 flex-1 text-center">
                <p class="text-[10px] text-orange-500 font-semibold uppercase tracking-wider">Mulai Kerja</p>
                <p class="font-bold text-orange-600 mt-1">07:00</p>
            </div>
            <div class="bg-slate-50 rounded-2xl p-3 flex-1 text-center">
                <p class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider">Selesai</p>
                <p class="font-bold text-slate-700 mt-1">17:00</p>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="mt-6 w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white py-2.5 rounded-xl text-sm font-medium transition-colors">
                <i data-lucide="log-out" class="w-4 h-4"></i> Logout
            </button>
        </form>
    </div>
</aside>
<script>
    function toggleModal(modalID) {
        const modal = document.getElementById(modalID);
        const overlay = document.getElementById('modal-overlay');
        const panel = document.getElementById('modal-panel');

        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'translate-y-4');
            }, 10);
        } else {
            overlay.classList.add('opacity-0');
            panel.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }
</script>
