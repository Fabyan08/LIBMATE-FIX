<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'LibMate Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="icon" href="{{ asset('icon.png') }}" type="image/x-icon" />
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body
    class="bg-slate-50 text-slate-800 font-sans antialiased overflow-hidden selection:bg-orange-200 selection:text-orange-600">

    <div id="sidebarOverlay"
        class="fixed inset-0 bg-slate-900/40 z-30 hidden lg:hidden transition-opacity duration-300"></div>

    <div class="flex h-screen w-full relative">

        @include('partials.dashboard.sidebar')

        <div class="flex-1 flex flex-col h-full overflow-hidden w-full">

            <header
                class="h-16 lg:hidden bg-white border-b border-slate-100 flex items-center justify-between px-6 z-20 w-full shrink-0">
                <button id="mobileMenuBtn" class="p-2 text-slate-600 hover:bg-slate-50 rounded-xl transition">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <img src="{{ asset('Libmate.png') }}" width="100" alt="Logo" />
                <button id="mobileRightMenuBtn" class="p-2 text-slate-600 hover:bg-slate-50 rounded-xl transition">
                    <i data-lucide="user" class="w-6 h-6"></i>
                </button>
            </header>

            <main class="flex-1 h-full overflow-y-auto p-6 lg:p-10 relative">
                {{-- Session Flash Success --}}
                @if (session('success'))
                    <div id="flash-message"
                        class="fixed top-5 right-5 z-[100] flex items-center p-4 mb-4 text-emerald-800 border-t-4 border-emerald-500 bg-emerald-50 shadow-lg rounded-2xl"
                        role="alert">
                        <i data-lucide="check-circle" class="w-5 h-5 mr-3"></i>
                        <div class="text-sm font-medium">{{ session('success') }}</div>
                        <button type="button" onclick="document.getElementById('flash-message').remove()"
                            class="ml-auto -mx-1.5 -my-1.5 text-emerald-500 rounded-lg p-1.5 hover:bg-emerald-200 inline-flex">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif

                {{-- Session Flash Error --}}
                @if (session('error'))
                    <div id="flash-message"
                        class="fixed top-5 right-5 z-[100] flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-500 bg-red-50 shadow-lg rounded-2xl"
                        role="alert">
                        <i data-lucide="alert-circle" class="w-5 h-5 mr-3"></i>
                        <div class="text-sm font-medium">{{ session('error') }}</div>
                        <button type="button" onclick="document.getElementById('flash-message').remove()"
                            class="ml-auto -mx-1.5 -my-1.5 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        @include('partials.dashboard.right-sidebar')

    </div>

    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>

</html>
