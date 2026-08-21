<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Zaim Photography</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0a] text-[#f8f8f8] font-inter antialiased">

    <!-- Cinematic Film Grain & Custom Cursor -->
    <div id="film-grain" class="pointer-events-none"></div>
    <div id="custom-cursor" class="pointer-events-none"></div>
    <div id="cursor-follower" class="pointer-events-none"></div>

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden md:hidden transition-opacity opacity-0 duration-300"></div>

    <!-- Sidebar (Drawer on Mobile, Fixed on Desktop) -->
    <aside id="admin-sidebar" class="fixed top-0 left-0 w-64 h-screen bg-[#080808] border-r border-[#1c1c1c] flex flex-col transition-transform duration-300 z-50 -translate-x-full md:translate-x-0">
        <!-- Sidebar Header / Logo -->
        <div class="h-16 flex items-center px-6 border-b border-[#1c1c1c] flex-shrink-0">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold tracking-[0.2em] uppercase">
                <span class="text-white">ZAIM</span> <span class="text-[#706f6c]">ADMIN</span>
            </a>
        </div>
        
        <!-- Sidebar Links -->
        <div class="flex-1 overflow-y-auto py-6">
            <ul class="space-y-2 px-4 text-sm tracking-widest uppercase">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-[#1c1c1c] border border-[#333] text-white shadow-md' : 'text-[#706f6c] hover:bg-[#111] hover:text-white transition-colors' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-md {{ request()->routeIs('admin.orders.*') ? 'bg-[#1c1c1c] border border-[#333] text-white shadow-md' : 'text-[#706f6c] hover:bg-[#111] hover:text-white transition-colors' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        <span>Kelola Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.albums.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-md {{ request()->routeIs('admin.albums.*') ? 'bg-[#1c1c1c] border border-[#333] text-white shadow-md' : 'text-[#706f6c] hover:bg-[#111] hover:text-white transition-colors' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>Kelola Album</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.works.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-md {{ request()->routeIs('admin.works.*') ? 'bg-[#1c1c1c] border border-[#333] text-white shadow-md' : 'text-[#706f6c] hover:bg-[#111] hover:text-white transition-colors' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        <span>Kelola Karya</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-md {{ request()->routeIs('admin.profile.*') ? 'bg-[#1c1c1c] border border-[#333] text-white shadow-md' : 'text-[#706f6c] hover:bg-[#111] hover:text-white transition-colors' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <span>Edit Profil</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.password.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-md {{ request()->routeIs('admin.password.*') ? 'bg-[#1c1c1c] border border-[#333] text-white shadow-md' : 'text-[#706f6c] hover:bg-[#111] hover:text-white transition-colors' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span>Ubah Password</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="md:ml-64 flex flex-col min-h-screen bg-[#050505] transition-all duration-300">
        
        <!-- Top Navbar (Sticky to top of content) -->
        <header class="sticky top-0 h-16 flex justify-between md:justify-end items-center px-6 border-b border-[#1c1c1c] bg-[#0a0a0a] z-10">
            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-btn" class="md:hidden text-[#cccccc] hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            
            <div class="flex items-center space-x-6 text-sm tracking-widest uppercase text-[#cccccc]">
                <a href="{{ route('home') }}" target="_blank" class="hover:text-white transition-colors flex items-center space-x-2 group">
                    <svg class="w-4 h-4 text-[#706f6c] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    <span>Lihat Web</span>
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="hover:text-red-500 transition-colors flex items-center space-x-2 group">
                        <svg class="w-4 h-4 text-[#706f6c] group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </header>

        <!-- Scrollable Content -->
        <main class="flex-1 p-6 md:p-10">
            <div class="max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="bg-green-900/30 border border-green-500/50 text-green-300 p-4 mb-8 text-sm tracking-widest uppercase rounded-sm shadow-[0_0_20px_rgba(34,197,94,0.1)] flex items-center space-x-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');

            function toggleSidebar() {
                sidebar.classList.toggle('-translate-x-full');
                
                if (sidebar.classList.contains('-translate-x-full')) {
                    // Closing
                    overlay.classList.add('opacity-0');
                    setTimeout(() => overlay.classList.add('hidden'), 300);
                } else {
                    // Opening
                    overlay.classList.remove('hidden');
                    setTimeout(() => overlay.classList.remove('opacity-0'), 10);
                }
            }

            if (mobileMenuBtn && overlay) {
                mobileMenuBtn.addEventListener('click', toggleSidebar);
                overlay.addEventListener('click', toggleSidebar);
            }
        });
    </script>
</body>
</html>
