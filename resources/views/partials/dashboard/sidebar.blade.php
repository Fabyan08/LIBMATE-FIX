 <aside id="sidebar"
     class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-100 transform -translate-x-full lg:translate-x-0 lg:static lg:flex lg:flex-col transition-transform duration-300 ease-in-out">
     <div
         class="h-20 flex items-center gap-3 px-8 text-orange-400 font-bold text-2xl border-b border-slate-50 lg:border-none mt-16 lg:mt-0">
         <a href="">
             <img src={{ asset('Libmate.png') }} width="130" alt="Logo LibMate" />
         </a>
     </div>

     <div class="flex flex-col flex-1 px-4 py-6 gap-2 overflow-y-auto">
         <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">
             Menu Utama
         </p>

         <!-- Dashboard -->
         <a href="{{ route('dashboard') }}"
             class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all
   {{ request()->routeIs('dashboard') ? 'bg-orange-400 text-white shadow-md shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
             <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
             <span class="font-medium">Dashboard</span>
         </a>

         {{-- Manajemen Ruangan --}}
         <a href="{{ route('manajemen-ruang') }}"
             class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all
   {{ request()->routeIs('manajemen-ruang*') ? 'bg-orange-400 text-white shadow-md shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
             <i data-lucide="users" class="w-5 h-5"></i>
             <span class="font-medium">Manajemen Ruangan</span>
         </a>
         {{-- manajemne mahasiswa --}}
         <a href="{{ route('manajemen-mahasiswa') }}"
             class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all text-nowrap
   {{ request()->routeIs('manajemen-mahasiswa*') ? 'bg-orange-400 text-white shadow-md shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
             <i data-lucide="users" class="w-5 h-5"></i>
             <span class="font-medium">Manajemen Mahasiswa</span>
         </a>
         {{-- manajemne peminjaman --}}
         <a href="{{ route('manajemen-peminjaman') }}"
             class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all text-nowrap
    {{ request()->routeIs('manajemen-peminjaman*') ? 'bg-orange-400 text-white shadow-md shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
             <i data-lucide="calendar" class="w-5 h-5"></i>
             <span class="font-medium">Peminjaman</span>
         </a>
         {{-- manajemen kontak --}}
         <a href="{{ route('manajemen-kontak') }}"
             class="flex items-center gap-3 px-4 py-3 rounded-2xl transition-all text-nowrap
    {{ request()->routeIs('manajemen-kontak*') ? 'bg-orange-400 text-white shadow-md shadow-orange-200' : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">
             <i data-lucide="phone" class="w-5 h-5"></i>
             <span class="font-medium">Kontak</span>
         </a>
     </div>

     <div class="p-4 mt-auto">
         <a href="/"
             class="flex items-center gap-3 px-4 py-3 rounded-2xl text-slate-500 hover:bg-red-50 hover:text-red-500 transition-all">
             <i data-lucide="log-out" class="w-5 h-5"></i>
             <span class="font-medium">Keluar</span>
         </a>
     </div>
 </aside>
