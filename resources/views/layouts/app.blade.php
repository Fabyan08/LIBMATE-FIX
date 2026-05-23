<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LibMate') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script>
        function getSafeCookie(name) {
            let nameEQ = name + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i].trim();
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        let theme = getSafeCookie('libmate_theme') || 'system';

        if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        let fontSize = getSafeCookie('libmate_font') || 'medium';

        if (fontSize === 'small') {
            document.documentElement.style.fontSize = '14px';
        } else if (fontSize === 'large') {
            document.documentElement.style.fontSize = '18px';
        } else {
            document.documentElement.style.fontSize = '16px';
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('icon.png') }}" type="image/x-icon" />
    <script>
        (function() {
            if (!window.chatbase || window.chatbase("getState") !== "initialized") {
                window.chatbase = (...arguments) => {
                    if (!window.chatbase.q) {
                        window.chatbase.q = []
                    }
                    window.chatbase.q.push(arguments)
                };
                window.chatbase = new Proxy(window.chatbase, {
                    get(target, prop) {
                        if (prop === "q") {
                            return target.q
                        }
                        return (...args) => target(prop, ...args)
                    }
                })
            }
            const onLoad = function() {
                const script = document.createElement("script");
                script.src = "https://www.chatbase.co/embed.min.js";
                script.id = "qWivSeb0BOK9C1xrUCF8S";
                script.domain = "www.chatbase.co";
                document.body.appendChild(script)
            };
            if (document.readyState === "complete") {
                onLoad()
            } else {
                window.addEventListener("load", onLoad)
            }
        })();
    </script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-slate-900 transition-colors duration-300">
        @include('partials.navbar')

        @isset($header)
            <header class="bg-white dark:bg-slate-800 shadow transition-colors duration-300">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-slate-800 dark:text-white">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            @yield('content')
        </main>
        @include('partials.footer')
    </div>
    @stack('scripts')
</body>

</html>
