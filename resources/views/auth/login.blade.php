<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Zaim Photography</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0a] text-[#f8f8f8] font-inter antialiased flex items-center justify-center min-h-screen">
    <div id="cursor-follower"></div>

    <div class="w-full max-w-md p-8 border border-[#1c1c1c] bg-[#0a0a0a]">
        <h1 class="text-2xl font-bold tracking-[0.2em] uppercase text-center mb-8">Admin Login</h1>

        @if($errors->any())
            <div class="bg-red-900/50 border border-red-500 text-red-200 p-4 mb-6 text-sm tracking-widest uppercase text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="flex mb-8 border-b border-[#1c1c1c]">
            <button id="tab-login" type="button" class="flex-1 pb-4 text-sm font-bold tracking-[0.1em] uppercase border-b-2 border-white text-white transition-colors" onclick="switchTab('login')">Standard Login</button>
            <button id="tab-secret" type="button" class="flex-1 pb-4 text-sm font-bold tracking-[0.1em] uppercase border-b-2 border-transparent text-[#706f6c] hover:text-white transition-colors" onclick="switchTab('secret')">Kunci Rahasia</button>
        </div>

        <form id="form-login" method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label for="email" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full bg-[#1c1c1c] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
            </div>

            <div>
                <label for="password" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Password</label>
                <input id="password" type="password" name="password" class="w-full bg-[#1c1c1c] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
            </div>

            <button type="submit" class="w-full bg-white text-black px-4 py-4 font-bold tracking-[0.2em] uppercase hover:bg-[#cccccc] transition-colors duration-300">
                Masuk
            </button>
        </form>

        <form id="form-secret" method="POST" action="{{ url('/login/secret') }}" class="space-y-6 hidden">
            @csrf
            <div>
                <label for="secret_email" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Email Akun Admin</label>
                <input id="secret_email" type="email" name="email" value="{{ old('email') }}" class="w-full bg-[#1c1c1c] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
            </div>

            <div>
                <label for="secret_key" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Kunci Rahasia</label>
                <input id="secret_key" type="password" name="secret_key" class="w-full bg-[#1c1c1c] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
            </div>

            <button type="submit" class="w-full bg-white text-black px-4 py-4 font-bold tracking-[0.2em] uppercase hover:bg-[#cccccc] transition-colors duration-300">
                Reset & Masuk
            </button>
            <p class="text-[10px] text-center text-[#706f6c] tracking-widest mt-4">Kunci ini hanya dapat digunakan 1x dalam 24 jam</p>
        </form>
    </div>

    <script>
        function switchTab(tab) {
            const tabLogin = document.getElementById('tab-login');
            const tabSecret = document.getElementById('tab-secret');
            const formLogin = document.getElementById('form-login');
            const formSecret = document.getElementById('form-secret');

            if (tab === 'login') {
                tabLogin.classList.replace('border-transparent', 'border-white');
                tabLogin.classList.replace('text-[#706f6c]', 'text-white');
                tabSecret.classList.replace('border-white', 'border-transparent');
                tabSecret.classList.replace('text-white', 'text-[#706f6c]');
                
                formLogin.classList.remove('hidden');
                formSecret.classList.add('hidden');
            } else {
                tabSecret.classList.replace('border-transparent', 'border-white');
                tabSecret.classList.replace('text-[#706f6c]', 'text-white');
                tabLogin.classList.replace('border-white', 'border-transparent');
                tabLogin.classList.replace('text-white', 'text-[#706f6c]');
                
                formSecret.classList.remove('hidden');
                formLogin.classList.add('hidden');
            }
        }
    </script>

</body>
</html>
