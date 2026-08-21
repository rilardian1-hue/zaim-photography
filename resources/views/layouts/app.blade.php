<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="view-transition" content="same-origin">
    <title>ZAIM PHOTOGRAPHY</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Fontshare: Satoshi -->
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@900,700,500,300,400&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="custom-cursor bg-[#0a0a0a] text-[#f8f8f8] font-sans antialiased selection:bg-[#444444] selection:text-white overflow-x-hidden">

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-text">ZAIM</div>
    </div>

    <div id="film-grain"></div>
    <div id="custom-cursor"></div>
    <div id="cursor-follower"></div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-[9999] hidden flex flex-col md:flex-row items-center justify-center opacity-0 transition-opacity duration-500">
        <span class="lightbox-close cursor-hover absolute top-6 right-8 text-white font-bold text-sm tracking-[0.3em] uppercase z-50 bg-black/50 p-2 md:bg-transparent rounded hover:text-[#cccccc] transition-colors">&times; Tutup</span>
        <div class="lightbox-content-wrapper flex flex-col md:flex-row w-full h-full">
            <div class="lightbox-image-container w-full h-[50vh] md:h-full md:w-1/2 flex items-center justify-center p-4 md:p-12">
                <img id="lightbox-img" src="" alt="Fullscreen view" class="w-full max-w-2xl h-auto max-h-[80vh] md:max-h-[85vh] object-contain drop-shadow-2xl">
            </div>
            <div class="lightbox-text-container w-full h-[50vh] md:h-full md:w-1/2 flex flex-col justify-center items-center text-center p-8 md:p-16 bg-transparent border-t md:border-t-0 md:border-l border-white/10">
                <h3 id="lightbox-title" class="text-4xl md:text-6xl font-black uppercase tracking-wider mb-6 text-white drop-shadow-md"></h3>
                <div id="lightbox-description" class="text-base md:text-xl text-[#cccccc] leading-relaxed font-medium uppercase max-w-lg"></div>
            </div>
        </div>
    </div>
    
    @include('partials.navbar')
    
    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.modal-profile')
    
    @stack('scripts')
</body>
</html>
