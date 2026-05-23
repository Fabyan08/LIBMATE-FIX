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
    <div class="flex h-screen w-full">

        <!-- Sidebar Kiri -->
        @include('partials.dashboard.sidebar')

        {{-- Session Flash --}}
        <main class="flex-1 h-full overflow-y-auto pt-16 lg:pt-0">
            @if (session('success'))
                <div id="flash-message"
                    class="fixed top-5 right-5 z-[100] flex items-center p-4 mb-4 text-emerald-800 border-t-4 border-emerald-500 bg-emerald-50 shadow-lg rounded-2xl animate-bounce-in"
                    role="alert">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3"></i>
                    <div class="text-sm font-medium">
                        {{ session('success') }}
                    </div>
                    <button type="button" onclick="document.getElementById('flash-message').remove()"
                        class="ml-auto -mx-1.5 -my-1.5 bg-emerald-50 text-emerald-500 rounded-lg focus:ring-2 focus:ring-emerald-400 p-1.5 hover:bg-emerald-200 inline-flex h-8 w-8 transition-all">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div id="flash-message"
                    class="fixed top-5 right-5 z-[100] flex items-center p-4 mb-4 text-red-800 border-t-4 border-red-500 bg-red-50 shadow-lg rounded-2xl animate-bounce-in"
                    role="alert">
                    <i data-lucide="alert-circle" class="w-5 h-5 mr-3"></i>
                    <div class="text-sm font-medium">
                        {{ session('error') }}
                    </div>
                    <button type="button" onclick="document.getElementById('flash-message').remove()"
                        class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 transition-all">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif
            @yield('content')
        </main>

        <!-- Sidebar Kanan (Profil) -->
        @include('partials.dashboard.right-sidebar')

    </div>

    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>

</html>
