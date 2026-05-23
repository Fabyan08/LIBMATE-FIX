<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - LibMate Universitas Jember</title>
    <link rel="icon" href="{{ asset('icon.png') }}" type="image/x-icon" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen w-full relative flex items-center justify-center overflow-hidden bg-slate-50">

    <div class="absolute inset-0 w-full h-full z-0">
        <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-orange-400/30 blur-[100px]">
        </div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-orange-500/20 blur-[120px]">
        </div>
        <div
            class="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px]">
        </div>
    </div>

    <div class="w-full max-w-md mx-4 z-10">

        <div class="bg-white/70 backdrop-blur-xl border border-white/60 shadow-2xl rounded-3xl p-8 sm:p-10">

            <div class="text-center mb-6">
                <div class="flex justify-center items-center gap-2 mb-4">
                    <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                        LIBMAT<span class="text-orange-500">E</span>
                    </h1>
                </div>
                <h2 class="text-lg font-semibold text-slate-700">Lupa Password?</h2>
                <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                    Tidak masalah. Masukkan alamat email universitas Anda dan kami akan mengirimkan tautan untuk
                    mengatur ulang password Anda.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-xl border border-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">Email
                        Universitas</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="nim@student.unej.ac.id"
                        class="w-full px-4 py-3 rounded-xl bg-white/50 border @error('email') border-red-500 @else border-slate-200 @enderror text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300">

                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-4 mt-6">
                    <button type="submit"
                        class="w-full py-3.5 px-4 rounded-xl text-white font-bold bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 shadow-[0_8px_20px_-6px_rgba(249,115,22,0.5)] transform hover:-translate-y-1 transition-all duration-300">
                        Kirim Link Reset Password
                    </button>

                    <a href="{{ route('login') }}"
                        class="text-center text-sm font-semibold text-slate-500 hover:text-orange-500 transition-colors duration-200">
                        Kembali ke halaman Login
                    </a>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} Universitas Jember.
                </p>
            </div>
        </div>
    </div>

</body>

</html>
