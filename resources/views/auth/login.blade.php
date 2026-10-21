<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Emphatia</title>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config={darkMode:"class",theme:{extend:{colors:{primary:"#4144c9","primary-container":"#5b5fe3",secondary:"#006a60",background:"#f8f9ff",surface:"#f8f9ff","on-surface":"#0b1c30","on-surface-variant":"#464554",outline:"#767586","surface-container-low":"#eff4ff","surface-container-lowest":"#ffffff"},borderRadius:{DEFAULT:"1rem",lg:"2rem",xl:"3rem",full:"9999px"},fontFamily:{body:["Plus Jakarta Sans"]}}}};
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen antialiased">

    <div class="min-h-screen flex items-center justify-center px-4 py-10 sm:px-6 lg:px-8">

        <div class="w-full max-w-md flex flex-col gap-6">

            <!-- Brand -->
            <div class="flex flex-col items-center text-center gap-2">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#5b5fe3] to-[#20b2aa] flex items-center justify-center shadow-md shadow-[#5b5fe3]/25">
                    <span class="material-symbols-outlined text-white text-[28px]">favorite</span>
                </div>
                <h1 class="text-[24px] font-bold tracking-tight">Selamat Datang Kembali</h1>
                <p class="text-[13.5px] text-on-surface-variant">Masuk ke akun Emphatia Anda untuk melanjutkan.</p>
            </div>

            <!-- Card Form Login -->
            <div class="rounded-2xl bg-surface-container-lowest border border-slate-200/70 shadow-sm p-6 sm:p-8">

                @if (session('status'))
                    <div class="mb-4 p-3.5 rounded-xl bg-teal-50 border border-teal-200 text-teal-800 text-[13px]">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    <!-- Email -->
                    <div class="flex flex-col gap-1.5">
                        <label for="email" class="text-[13px] font-semibold text-on-surface">Email</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">mail</span>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                autofocus
                                placeholder="nama@email.com"
                                class="w-full pl-10 pr-3 py-2.5 rounded-xl bg-surface border border-slate-200/80 text-[14px] placeholder:text-outline/70 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all @error('email') border-rose-400 focus:ring-rose-200 focus:border-rose-500 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="text-[12px] text-rose-600 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="text-[13px] font-semibold text-on-surface">Kata Sandi</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px] pointer-events-none">lock</span>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full pl-10 pr-11 py-2.5 rounded-xl bg-surface border border-slate-200/80 text-[14px] placeholder:text-outline/70 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all @error('password') border-rose-400 focus:ring-rose-200 focus:border-rose-500 @enderror"
                            >
                            <button
                                type="button"
                                onclick="togglePassword('password', this)"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-on-surface transition-colors"
                                title="Tampilkan kata sandi"
                            >
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-[12px] text-rose-600 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label for="remember" class="flex items-center gap-2 text-[13px] text-on-surface-variant cursor-pointer">
                            <input
                                id="remember"
                                name="remember"
                                type="checkbox"
                                value="1"
                                class="rounded border-slate-300 text-primary focus:ring-primary/30"
                            >
                            Ingat saya
                        </label>
                    </div>

                    <!-- Tombol Submit -->
                    <button
                        type="submit"
                        class="mt-1 w-full py-2.5 rounded-xl bg-gradient-to-r from-[#5b5fe3] to-[#20b2aa] text-white font-semibold text-[14px] shadow-md shadow-[#5b5fe3]/25 hover:opacity-90 active:scale-[0.99] transition-all flex items-center justify-center gap-2"
                    >
                        <span class="material-symbols-outlined text-[18px]">login</span>
                        Masuk
                    </button>
                </form>
            </div>

            <!-- Link ke Register -->
            <p class="text-center text-[13px] text-on-surface-variant">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-primary hover:text-[#5b5fe3] transition-colors">Daftar sekarang</a>
            </p>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan/menyembunyikan kata sandi
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('.material-symbols-outlined');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerText = 'visibility_off';
            } else {
                input.type = 'password';
                icon.innerText = 'visibility';
            }
        }
    </script>
</body>
</html>
