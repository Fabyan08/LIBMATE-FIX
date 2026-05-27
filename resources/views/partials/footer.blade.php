<footer
    class="bg-slate-50 dark:bg-slate-900 pt-16 pb-8 border-t border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-400 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="md:col-span-2">
                <div class="dark:bg-white dark:px-6 dark:w-fit dark:h-fit dark:py-2 dark:rounded-full">
                    <img src="{{ asset('Libmate.png') }}" width="100" class="pb-2" alt="Logo LibMate" />
                </div>
                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm mb-6 leading-relaxed transition-colors">
                    Sistem Pemesanan Ruang Diskusi Perpustakaan dengan AI resmi untuk
                    Universitas Jember. Membuat kehidupan belajar di kampus menjadi
                    lebih mudah.
                </p>
            </div>

            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-4 transition-colors">Menu</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="/"
                            class="hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('tentang') }}"
                            class="hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Tentang
                            Kami</a>
                    </li>
                    <li>
                        <a href="{{ route('kontak') }}"
                            class="hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Kontak</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-slate-900 dark:text-white mb-4 transition-colors">Bantuan</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('kontak') }}"
                            class="hover:text-orange-600 dark:hover:text-orange-400 transition-colors">Hubungi Admin</a>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4 transition-colors">
            <p class="text-sm text-slate-400 dark:text-slate-500">
                &copy; {{ date('Y') }} LibMate - Perpustakaan Universitas Jember. Hak Cipta
                Dilindungi.
            </p>
            <div class="flex space-x-4 text-sm text-slate-400 dark:text-slate-500">
                <a href="#" class="hover:text-slate-600 dark:hover:text-slate-300 transition-colors">Kebijakan
                    Privasi</a>
                <a href="#" class="hover:text-slate-600 dark:hover:text-slate-300 transition-colors">Syarat
                    Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

{{-- <div class="fixed bottom-6 right-6 z-[100] flex flex-col items-end">
    <div id="floating-chat"
        class="mb-4 w-[320px] md:w-[350px] bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 overflow-hidden transform scale-95 opacity-0 pointer-events-none transition-all duration-300 origin-bottom-right">

        <div
            class="bg-gradient-to-r from-orange-500 to-orange-600 dark:from-orange-600 dark:to-orange-700 p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-slate-100 dark:border-slate-800 rounded-full">
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-sm">LibMate AI</h4>
                    <p class="text-orange-100 text-xs">Selalu Siap Membantu</p>
                </div>
            </div>


            <div id="floating-chat"
                class="fixed bottom-6 right-6 w-[350px] bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden z-50 opacity-0 scale-95 pointer-events-none">
                <div
                    class="bg-gradient-to-r from-orange-500 to-orange-600 p-4 flex items-center justify-between text-white">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center">
                            <span class="text-orange-600 font-bold">AI</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm">LibMate Assistant</h4>
                            <p class="text-[10px] text-orange-100">Online • Siap membantu</p>
                        </div>
                    </div>
                    <button onclick="toggleChat()" class="hover:text-orange-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="p-4 h-64 overflow-y-auto bg-slate-50 flex flex-col gap-3">
                    <div
                        class="bg-white p-3 rounded-2xl rounded-tl-none shadow-sm text-sm text-slate-700 w-fit max-w-[80%]">
                        Halo! Ada yang bisa saya bantu terkait pemesanan ruang hari ini?
                    </div>
                </div>

                <div class="p-3 border-t flex gap-2">
                    <input type="text" placeholder="Ketik pesan..."
                        class="flex-1 text-sm border-none bg-slate-100 rounded-full px-4 py-2 focus:ring-2 focus:ring-orange-500">
                    <button class="bg-orange-600 text-white p-2 rounded-full hover:bg-orange-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="p-4 h-64 overflow-y-auto bg-slate-50 dark:bg-slate-900 flex flex-col gap-4 transition-colors">
            <div class="flex justify-start">
                <div
                    class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 rounded-2xl rounded-tl-sm px-4 py-3 text-sm max-w-[90%] leading-relaxed shadow-sm transition-colors">
                    Halo! 👋 Saya Asisten AI LibMate. Ada yang bisa saya bantu hari
                    ini? Anda bisa menanyakan ruang kosong atau meminta rekomendasi
                    jadwal.
                </div>
            </div>

            <div class="flex flex-col gap-2 items-start mt-1">
                <button
                    class="bg-white dark:bg-slate-800 border border-orange-200 dark:border-orange-500/30 text-orange-600 dark:text-orange-400 text-xs py-2 px-3 rounded-xl hover:bg-orange-500 hover:text-white dark:hover:bg-orange-600 transition-colors text-left w-full shadow-sm">
                    Cari ruang tenang untuk 2 orang
                </button>
                <button
                    class="bg-white dark:bg-slate-800 border border-orange-200 dark:border-orange-500/30 text-orange-600 dark:text-orange-400 text-xs py-2 px-3 rounded-xl hover:bg-orange-500 hover:text-white dark:hover:bg-orange-600 transition-colors text-left w-full shadow-sm">
                    Apa saja fasilitas di Ruang 3A?
                </button>
            </div>
        </div>

        <div class="p-3 bg-white border-t border-slate-200 flex gap-2 transition-colors">
            <input type="text" id="chat-input" placeholder="Ketik pesan..."
                class="flex-1 text-sm bg-slate-100 rounded-full py-2 px-4 focus:outline-none" />
            <button id="send-btn"
                class="w-10 h-10 bg-orange-600 rounded-full flex items-center justify-center text-white hover:bg-orange-500 transition-colors shrink-0 shadow-md">
                <svg class="w-4 h-4 ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </button>
        </div>
    </div>


</div> --}}
