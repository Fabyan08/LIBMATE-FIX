<nav
    class="fixed w-full z-[999999] glass-panel border-b border-black/50 dark:border-slate-700 transition-all duration-300 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <a href="/" class="dark:bg-white dark:px-6 dark:py-2 dark:rounded-full">
                <img src="{{ asset('Libmate.png') }}" width="130" alt="Logo LibMate" />
            </a>

            <div class="hidden md:flex space-x-8 items-center">
                <a href="/"
                    class="text-sm font-semibold @if (request()->is('/')) text-orange-600 dark:text-orange-500 @else text-slate-500 dark:text-slate-300 @endif hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Beranda</a>
                <a href="/tentang"
                    class="text-sm font-semibold @if (request()->is('tentang')) text-orange-600 dark:text-orange-500 @else text-slate-500 dark:text-slate-300 @endif hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Tentang
                    Kami</a>
                <a href="/ruangan"
                    class="text-sm font-semibold @if (request()->is('ruangan*')) text-orange-600 dark:text-orange-500 @else text-slate-500 dark:text-slate-300 @endif hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Katalog
                    Ruangan</a>
                <a href="/kontak"
                    class="text-sm font-semibold @if (request()->is('kontak')) text-orange-600 dark:text-orange-500 @else text-slate-500 dark:text-slate-300 @endif hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Kontak</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                <a href="/preferensi"
                    class="text-sm font-semibold text-slate-500 dark:text-slate-300 hover:text-orange-600 dark:hover:text-orange-400 transition-colors">
                    Preferensi
                </a>

                <button id="theme-toggle" type="button"
                    class="text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none rounded-lg text-sm p-2.5 transition-colors">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.32a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zm-4.22 4.93a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.415 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.93-4.22a1 1 0 01-1.415 0l-.707-.707a1 1 0 011.414-1.414l.707.707a1 1 0 010 1.415zM4 10a1 1 0 01-1 1H2a1 1 0 110-2h1a1 1 0 011 1zm2.32-4.22a1 1 0 010-1.415l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.415 0zM10 5a5 5 0 100 10 5 5 0 000-10z">
                        </path>
                    </svg>
                </button>

                <div class="animate-pulse">
                    @if (auth()->check())
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard') }}"
                                class="px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold hover:bg-slate-800 dark:hover:bg-orange-700 shadow-xl shadow-slate-900/20 transition-all hover:-translate-y-0.5 inline-block">Dashboard</a>
                        @else
                            <a href="{{ route('profil') }}"
                                class="px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold hover:bg-slate-800 dark:hover:bg-orange-700 shadow-xl shadow-slate-900/20 transition-all hover:-translate-y-0.5 inline-block">Profil</a>
                        @endif
                    @else
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold hover:bg-slate-800 dark:hover:bg-orange-700 shadow-xl shadow-slate-900/20 transition-all hover:-translate-y-0.5 inline-block">Masuk</a>
                    @endif
                </div>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button"
                    class="text-slate-600  dark:text-slate-300 hover:text-orange-600 dark:hover:text-orange-400 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu"
        class="hidden md:hidden bg-white/95 dark:bg-slate-900/95 backdrop-blur-md border-t border-slate-100 dark:border-slate-800 shadow-lg absolute w-full transition-colors">
        <div class="px-4 pt-2 pb-6 space-y-2 sm:px-3">
            <a href="/"
                class="block px-3 py-2 rounded-md text-base font-medium @if (request()->is('/')) text-orange-600 bg-orange-50 dark:bg-slate-800 @else text-slate-600 dark:text-slate-300 hover:text-orange-600 hover:bg-orange-50 dark:hover:bg-slate-800 @endif transition-colors">
                Beranda
            </a>
            <a href="/tentang"
                class="block px-3 py-2 rounded-md text-base font-medium @if (request()->is('tentang')) text-orange-600 bg-orange-50 dark:bg-slate-800 @else text-slate-600 dark:text-slate-300 hover:text-orange-600 hover:bg-orange-50 dark:hover:bg-slate-800 @endif transition-colors">
                Tentang Kami
            </a>
            <a href="/kontak"
                class="block px-3 py-2 rounded-md text-base font-medium @if (request()->is('kontak')) text-orange-600 bg-orange-50 dark:bg-slate-800 @else text-slate-600 dark:text-slate-300 hover:text-orange-600 hover:bg-orange-50 dark:hover:bg-slate-800 @endif transition-colors">
                Kontak
            </a>
            <a href="/preferensi"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 dark:text-slate-300 hover:text-orange-600 hover:bg-orange-50 dark:hover:bg-slate-800 transition-colors">
                Preferensi
            </a>
            <a href="{{ route('dashboard') }}"
                class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 dark:text-slate-300 hover:text-orange-600 hover:bg-orange-50 dark:hover:bg-slate-800 transition-colors">
                Dashboard
            </a>

            <button id="theme-toggle-mobile"
                class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-slate-600 dark:text-slate-300 hover:text-orange-600 hover:bg-orange-50 dark:hover:bg-slate-800 transition-colors flex items-center justify-between">
                <span>Ganti Tema</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z">
                    </path>
                </svg>
            </button>

            <div class="pt-4 px-3">
                <a href="{{ route('dashboard') }}"
                    class="block w-full text-center px-5 py-3 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white text-base font-semibold shadow-md shadow-orange-500/20">
                    Masuk
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        let nameEQ = name + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function deleteCookie(name) {
        document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }

    document.addEventListener('DOMContentLoaded', function() {

        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');

        if (btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }


        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');


        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }


        function toggleTheme() {
            if (themeToggleDarkIcon) themeToggleDarkIcon.classList.toggle('hidden');
            if (themeToggleLightIcon) themeToggleLightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                setCookie('libmate_theme', 'light', 30); // SIMPAN NAMA BARU
            } else {
                document.documentElement.classList.add('dark');
                setCookie('libmate_theme', 'dark', 30); // SIMPAN NAMA BARU
            }
        }
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', toggleTheme);
        }

        if (themeToggleMobileBtn) {
            themeToggleMobileBtn.addEventListener('click', toggleTheme);
        }
    });
</script>
