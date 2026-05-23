 <nav
     class="fixed w-full z-[999999] glass-panel border-b border-black/50 transition-all duration-300 bg-white/80 backdrop-blur-md">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         <div class="flex justify-between items-center h-20">
             <a href="/">
                 <img src="Libmate.png" width="130" alt="Logo LibMate" />
             </a>

             <div class="hidden md:flex space-x-8 items-center">
                 <a href="/"
                     class="text-sm font-semibold @if (request()->is('/')) text-orange-600 @else text-slate-500 hover:text-orange-600 @endif transition-colors">Beranda</a>
                 <a href="{{ route('tentang') }}"
                     class="text-sm font-semibold @if (request()->is('tentang')) text-orange-600 @else text-slate-500 hover:text-orange-600 @endif transition-colors">Tentang
                     Kami</a>
                 <a href="{{ route('kontak') }}"
                     class="text-sm font-semibold @if (request()->is('kontak')) text-orange-600 @else text-slate-500 hover:text-orange-600 @endif transition-colors">Kontak
                 </a>
                 <a href="{{ route('dashboard') }}"
                     class="text-sm font-semibold @if (request()->is('dashboard')) text-orange-600 @else text-slate-500 hover:text-orange-600 @endif transition-colors">Dashboard</a>
             </div>

             <div class="hidden md:flex animate-bounce items-center space-x-4">
                 <a href="{{ route('dashboard') }}"
                     class="px-5 py-2.5 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white text-sm font-semibold hover:bg-slate-800 shadow-xl shadow-slate-900/20 transition-all hover:-translate-y-0.5">Masuk</a>
             </div>

             <div class="md:hidden flex items-center">
                 <button id="mobile-menu-button"
                     class="text-slate-600 hover:text-orange-600 focus:outline-none transition-colors">
                     <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M4 6h16M4 12h16M4 18h16" />
                     </svg>
                 </button>
             </div>
         </div>
     </div>

     <div id="mobile-menu"
         class="hidden md:hidden bg-white/95 backdrop-blur-md border-t border-slate-100 shadow-lg absolute w-full">
         <div class="px-4 pt-2 pb-6 space-y-2 sm:px-3">
             <a href="/"
                 class="block px-3 py-2 rounded-md text-base font-medium @if (request()->is('/')) text-orange-600 bg-orange-50 @else text-slate-600 hover:text-orange-600 hover:bg-orange-50 @endif transition-colors">
                 Beranda
             </a>
             <a href="/tentang"
                 class="block px-3 py-2 rounded-md text-base font-medium @if (request()->is('tentang')) text-orange-600 bg-orange-50 @else text-slate-600 hover:text-orange-600 hover:bg-orange-50 @endif transition-colors">
                 Tentang Kami
             </a>
             <a href="{{ route('dashboard') }}"
                 class="block px-3 py-2 rounded-md text-base font-medium text-slate-600 hover:text-orange-600 hover:bg-orange-50 transition-colors">
                 Dashboard
             </a>

             <div class="pt-4 px-3">
                 <a href="{{ route('dashboard') }}"
                     class="block w-full text-center px-5 py-3 rounded-full bg-gradient-to-r from-orange-500 to-orange-600 text-white text-base font-semibold shadow-md shadow-orange-500/20">
                     Masuk
                 </a>
             </div>
         </div>
     </div>
 </nav>
