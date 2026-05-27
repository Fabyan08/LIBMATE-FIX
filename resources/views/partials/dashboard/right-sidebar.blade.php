<aside id="right-sidebar"
    class="fixed inset-y-0 right-0 z-40 w-80 bg-white border-l border-slate-100 transform translate-x-full lg:translate-x-0 lg:static transition-transform duration-300 ease-in-out">

    <div class="flex items-center justify-between p-6 border-b border-slate-50">
        <h3 class="text-base font-bold text-slate-800">Profil Admin</h3>

        <button type="button" onclick="closeRightSidebar()"
            class="lg:hidden p-2 text-slate-400 hover:text-red-500 rounded-xl hover:bg-red-50 transition">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>

    <div class="p-8 flex flex-col items-center">
        <div class="relative mb-4">
            @if (Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}" alt="Foto Profil"
                    class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md">
            @else
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=FB923C&color=fff&size=120"
                    alt="Profile" class="w-24 h-24 rounded-full border-4 border-white shadow-md" />
            @endif
            <div class="absolute bottom-1 right-1 w-4 h-4 bg-emerald-400 border-2 border-white rounded-full"></div>
        </div>
        <h3 class="text-lg font-bold text-slate-800 text-center">{{ Auth::user()->name }}</h3>
        <p class="text-xs text-slate-400 mt-1">Admin Perpustakaan</p>

        <button type="button" onclick="toggleModal('modal-edit-profil')"
            class="mt-5 w-full flex items-center justify-center gap-2 bg-slate-50 hover:bg-slate-100 text-slate-600 py-2.5 rounded-xl text-sm font-medium transition-colors border border-slate-100">
            <i data-lucide="edit-3" class="w-4 h-4"></i> Edit Profil
        </button>

        <div id="modal-edit-profil" class="fixed inset-0 z-[100] hidden">
            <div id="modal-overlay-bg" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="toggleModal('modal-edit-profil')"></div>
            <div class="absolute inset-0 flex items-center justify-center p-4">
                <div id="modal-panel-box" class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl w-full max-w-md p-8 relative opacity-0 translate-y-4 transition-all duration-300">
                    <h2 class="text-xl font-bold text-slate-800 dark:text-white mb-6">Edit Profil Admin</h2>
                    <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Email</label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Foto Profil</label>
                            <input type="file" name="foto" accept="image/*" class="w-full mt-1 text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-orange-50 file:text-orange-700">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-slate-500 uppercase">Password Baru</label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah" class="w-full mt-1 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-orange-500">
                        </div>
                        <div class="flex gap-3 pt-4">
                            <button type="button" onclick="toggleModal('modal-edit-profil')" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold text-sm hover:bg-slate-50 transition">Batal</button>
                            <button type="submit" class="flex-1 py-2.5 rounded-xl bg-orange-600 text-white font-semibold text-sm hover:bg-orange-700 transition shadow-lg shadow-orange-600/20">Simpan</button>
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
    // 1. FUNGSI CLOSE SIDEBAR (Hanya bergeser jika di layar mobile/HP)
    function closeRightSidebar() {
        const rightSidebar = document.getElementById("right-sidebar");
        const sidebarOverlay = document.getElementById("sidebarOverlay");

        // Cek jika ukuran layar saat ini di bawah 1024px (Layar Mobile)
        if (window.innerWidth < 1024) {
            if (rightSidebar) rightSidebar.style.transform = "translateX(100%)";
            if (sidebarOverlay) sidebarOverlay.classList.add("hidden");
            document.body.style.overflow = "";
        }
    }

    // 2. FUNGSI TOGGLE MODAL EDIT PROFIL
    function toggleModal(modalID) {
        const modal = document.getElementById(modalID);
        const overlay = document.getElementById('modal-overlay-bg');
        const panel = document.getElementById('modal-panel-box');

        if (!modal || !overlay || !panel) return;

        if (modal.classList.contains('hidden')) {
            modal.classList.remove('hidden');
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                panel.classList.remove('opacity-0', 'translate-y-4');
                panel.classList.add('opacity-100', 'translate-y-0');
            }, 10);
        } else {
            overlay.classList.add('opacity-0');
            panel.classList.remove('opacity-100', 'translate-y-0');
            panel.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    }

    // 3. LOGIKA INDEPENDEN UNTUK RESPONSIVE SCREEN
    (function() {
        document.addEventListener("DOMContentLoaded", function () {
            const mobileRightMenuBtn = document.getElementById("mobileRightMenuBtn");
            const rightSidebar = document.getElementById("right-sidebar");
            const sidebarOverlay = document.getElementById("sidebarOverlay");

            // Fungsi mengatur posisi awal berdasarkan ukuran layar saat di-refresh
            function handleResize() {
                if (!rightSidebar) return;
                if (window.innerWidth >= 1024) {
                    rightSidebar.style.transform = "translateX(0)"; // Stay di desktop
                } else {
                    rightSidebar.style.transform = "translateX(100%)"; // Sembunyi di mobile
                }
            }

            // Jalankan saat pertama kali dibuka
            handleResize();

            // Pantau jika user mengubah ukuran browser desktop ke mobile
            window.addEventListener('resize', handleResize);

            if (typeof lucide !== "undefined") {
                lucide.createIcons();
            }

            if (mobileRightMenuBtn && rightSidebar) {
                mobileRightMenuBtn.onclick = function (e) {
                    e.stopPropagation();
                    if (window.innerWidth < 1024) {
                        rightSidebar.style.transform = "translateX(0)";
                        if (sidebarOverlay) sidebarOverlay.classList.remove("hidden");
                        document.body.style.overflow = "hidden";
                    }
                };
            }

            if (sidebarOverlay) {
                sidebarOverlay.onclick = closeRightSidebar;
            }
        });
    })();
</script>
