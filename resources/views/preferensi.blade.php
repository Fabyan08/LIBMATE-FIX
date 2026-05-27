@extends('layouts.app')

@section('title', 'Preferensi | LibMate')

@section('content')
    <main class="min-h-screen bg-slate-50 dark:bg-slate-900 pt-28 pb-10 transition-colors duration-300">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div
                class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden transition-colors">
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-8 py-6">
                    <h1 class="text-2xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pengaturan Preferensi
                    </h1>
                    <p class="text-orange-50 text-sm mt-1">Sesuaikan tampilan LibMate senyaman mungkin untuk Anda.</p>
                </div>

                <div class="p-8">
                    <form id="preference-form" class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Pilih Tema
                                Aplikasi</label>
                            <select id="input-theme"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                                <option value="light" {{ $currentTheme == 'light' ? 'selected' : '' }}>Terang (Light)
                                </option>
                                <option value="dark" {{ $currentTheme == 'dark' ? 'selected' : '' }}>Gelap (Dark)</option>
                                <option value="system" {{ $currentTheme == 'system' ? 'selected' : '' }}>Ikuti Sistem
                                    Perangkat</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ukuran Teks
                                (Eksperimental)</label>
                            <select id="input-font"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-600 bg-slate-50 dark:bg-slate-700 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-orange-500 transition-colors">
                                <option value="small" {{ $currentFontSize == 'small' ? 'selected' : '' }}>Kecil</option>
                                <option value="medium" {{ $currentFontSize == 'medium' ? 'selected' : '' }}>Sedang</option>
                                <option value="large" {{ $currentFontSize == 'large' ? 'selected' : '' }}>Besar</option>
                            </select>
                        </div>

                        <div id="success-alert"
                            class="hidden flex items-center gap-3 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 p-4 rounded-xl border border-green-200 dark:border-green-800 transition-colors">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            <span id="success-msg" class="text-sm font-medium"></span>
                        </div>

                        <div class="pt-4">
                            <button type="submit" id="btn-save"
                                class="w-full sm:w-auto px-8 py-3.5 bg-orange-600 hover:bg-orange-700 text-white font-bold rounded-xl shadow-lg shadow-orange-500/30 transition-all hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span>Simpan Preferensi</span>
                                <div id="loading-spinner"
                                    class="hidden w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin">
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('preference-form');
            const themeSelect = document.getElementById('input-theme');
            const fontSelect = document.getElementById('input-font');
            const btnSave = document.getElementById('btn-save');
            const spinner = document.getElementById('loading-spinner');
            const alertBox = document.getElementById('success-alert');
            const msgText = document.getElementById('success-msg');

            function getLocalCookie(name) {
                let nameEQ = name + "=";
                let ca = document.cookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i].trim();
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            const savedTheme = getLocalCookie('libmate_theme');
            const savedFont = getLocalCookie('libmate_font');

            if (savedTheme) themeSelect.value = savedTheme;
            if (savedFont) fontSelect.value = savedFont;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            form.addEventListener('submit', async function(e) {
                e.preventDefault();

                const themeValue = themeSelect.value;
                const fontValue = fontSelect.value;

                btnSave.disabled = true;
                btnSave.classList.add('opacity-75');
                spinner.classList.remove('hidden');
                alertBox.classList.add('hidden');

                try {
                    const response = await fetch('/api/preferensi/simpan', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            theme: themeValue,
                            font_size: fontValue
                        })
                    });

                    if (!response.ok) throw new Error('Gagal menghubungi server.');

                    const result = await response.json();

                    if (result.success) {
                        msgText.textContent = result.message;
                        alertBox.classList.remove('hidden');

                        if (typeof setCookie === "function") {
                            setCookie('libmate_theme', themeValue, 30);
                            setCookie('libmate_font', fontValue, 30);
                        } else {
                            document.cookie = "libmate_theme=" + themeValue + "; path=/; max-age=" + (
                                30 * 24 * 60 * 60);
                            document.cookie = "libmate_font=" + fontValue + "; path=/; max-age=" + (30 *
                                24 * 60 * 60);
                        }

                        if (themeValue === 'dark' || (themeValue === 'system' && window.matchMedia(
                                '(prefers-color-scheme: dark)').matches)) {
                            document.documentElement.classList.add('dark');
                            document.getElementById('theme-toggle-dark-icon')?.classList.add('hidden');
                            document.getElementById('theme-toggle-light-icon')?.classList.remove(
                                'hidden');
                        } else {
                            document.documentElement.classList.remove('dark');
                            document.getElementById('theme-toggle-light-icon')?.classList.add('hidden');
                            document.getElementById('theme-toggle-dark-icon')?.classList.remove(
                                'hidden');
                        }

                        if (fontValue === 'small') {
                            document.documentElement.style.fontSize = '14px';
                        } else if (fontValue === 'large') {
                            document.documentElement.style.fontSize = '18px';
                        } else {
                            document.documentElement.style.fontSize = '16px';
                        }
                    }
                } catch (error) {
                    alert('Terjadi kesalahan saat menyimpan data.');
                } finally {
                    btnSave.disabled = false;
                    btnSave.classList.remove('opacity-75');
                    spinner.classList.add('hidden');

                    setTimeout(() => {
                        alertBox.classList.add('hidden');
                    }, 3000);
                }
            });
        });
    </script>
@endpush
