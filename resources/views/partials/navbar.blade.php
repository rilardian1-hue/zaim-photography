<nav id="navbar" class="fixed w-full z-50 transition-all duration-300 bg-transparent py-4">
    <div class="max-w-7xl mx-auto px-6 md:px-12 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-xl font-bold tracking-[0.2em] uppercase">ZAIM</a>
        
        <div class="hidden md:flex space-x-8 items-center text-sm font-medium tracking-widest uppercase text-[#cccccc]">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors duration-300">Home</a>
            <a href="{{ route('works.index') }}" class="hover:text-white transition-colors duration-300">Portofolio</a>
            <a href="{{ route('albums.index') }}" class="hover:text-white transition-colors duration-300">Album</a>
            <a href="{{ route('services.index') }}" class="hover:text-white transition-colors duration-300">Layanan</a>
            <a href="{{ route('about.index') }}" class="hover:text-white transition-colors duration-300">Tentang Saya</a>
            
            <button onclick="toggleModal()" class="ml-4 w-10 h-10 rounded-full border border-[#444444] overflow-hidden hover:border-white transition-all duration-300" aria-label="Buka Profil">
                <img src="{{ $aboutProfile->profile_image ?? 'https://picsum.photos/seed/zaim/100/100' }}" alt="{{ $aboutProfile->full_name ?? 'Profile' }}" class="w-full h-full object-cover">
            </button>
        </div>

        <!-- Mobile Menu Button -->
        <button class="md:hidden text-white focus:outline-none" onclick="toggleMobileMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-[#0a0a0a] border-b border-[#1c1c1c]">
        <div class="px-6 py-4 flex flex-col space-y-4 text-sm font-medium tracking-widest uppercase text-[#cccccc]">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <a href="{{ route('works.index') }}" class="hover:text-white transition-colors">Portofolio</a>
            <a href="{{ route('albums.index') }}" class="hover:text-white transition-colors">Album</a>
            <a href="{{ route('services.index') }}" class="hover:text-white transition-colors">Layanan</a>
            <a href="{{ route('about.index') }}" class="hover:text-white transition-colors">Tentang Saya</a>
            <button onclick="toggleModal()" class="text-left hover:text-white transition-colors">Profil</button>
        </div>
    </div>
</nav>

<script>
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 50) {
            navbar.classList.remove('bg-transparent', 'py-4');
            navbar.classList.add('bg-[#0a0a0a]/90', 'backdrop-blur-md', 'py-3', 'border-b', 'border-[#1c1c1c]');
        } else {
            navbar.classList.add('bg-transparent', 'py-4');
            navbar.classList.remove('bg-[#0a0a0a]/90', 'backdrop-blur-md', 'py-3', 'border-b', 'border-[#1c1c1c]');
        }
    });

    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
