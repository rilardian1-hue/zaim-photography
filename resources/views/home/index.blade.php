@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="relative w-full h-screen flex items-center justify-center overflow-hidden">
    <!-- Parallax Background -->
    <div class="absolute inset-0 w-full h-full">
        <div class="absolute inset-0 bg-black/60 z-10"></div>
        <img src="https://picsum.photos/seed/hero/1920/1080" alt="Hero" class="w-full h-full object-cover animate-hero-zoom scale-105" data-parallax>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 text-center px-4 md:px-6 mt-16 animate-fade-in-up" style="animation-delay: 0.3s; animation-fill-mode: backwards;">
        <div class="mask-reveal-container mb-6 relative">
            <h1 class="mask-reveal observe-element is-visible delay-100 text-xl md:text-3xl sm:text-5xl md:text-8xl font-extrabold tracking-[0.1em] md:tracking-[0.2em] uppercase leading-tight">
                <span class="absolute -top-6 md:-top-12 left-1/2 -translate-x-1/2 text-5xl sm:text-8xl md:text-[12rem] text-white/5 whitespace-nowrap -z-10 tracking-[0.1em]">ZAIM</span>
                ZAIM PHOTOGRAPHY
            </h1>
        </div>
        <p class="text-[#cccccc] text-xs sm:text-sm md:text-lg tracking-[0.1em] md:tracking-[0.3em] uppercase mb-12 max-w-2xl mx-auto leading-relaxed">
            Siswa SMK Kartini Batam <span class="hidden sm:inline mx-2">·</span><br class="sm:hidden" /> Fotografer Muda Berjiwa Seni
        </p>
        <a href="{{ route('works.index') }}" class="magnetic-btn inline-block border border-white px-6 md:px-8 py-3 md:py-4 text-[10px] md:text-xs font-bold tracking-[0.2em] md:tracking-[0.3em] uppercase hover:bg-white hover:text-black transition-colors duration-500">
            Jelajahi Karya
        </a>
    </div>
</section>

<!-- Quote Section -->
<section class="py-32 px-6 bg-[#0a0a0a]">
    <div class="max-w-4xl mx-auto text-center observe-element opacity-0 transition-all duration-1000 ease-out">
        <svg class="w-12 h-12 mx-auto mb-8 text-[#444444]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
        </svg>
        <p class="text-2xl md:text-4xl font-light tracking-wide leading-relaxed text-[#f8f8f8]">
            "Melalui hitam dan putih, aku menangkap jati diri manusia dan keabadian sebuah momen."
        </p>
    </div>
</section>

<!-- Latest Works Section -->
<section class="py-24 px-6 md:px-12 bg-[#0a0a0a]">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-16 observe-element opacity-0 transition-all duration-1000 ease-out">
            <h2 class="text-xl md:text-3xl font-bold tracking-[0.2em] uppercase">Karya Terbaru</h2>
            <a href="{{ route('works.index') }}" class="text-[#cccccc] text-xs font-medium tracking-widest uppercase border-b border-transparent hover:border-[#cccccc] transition-colors pb-1 hidden md:block">
                Lihat Semua
            </a>
        </div>
        
        <div class="columns-2 md:columns-2 lg:columns-3 gap-3 md:gap-8 space-y-3 md:space-y-8">
            @foreach($latestWorks as $index => $work)
                <div class="break-inside-avoid mb-4 group observe-element opacity-0 transition-all duration-1000 ease-out" style="transition-delay: {{ $index * 100 }}ms;">
                    <a href="{{ $work->image_path }}" data-title="{{ $work->title }}" data-description="{{ $work->description ?? '' }}" class="lightbox-trigger block relative rounded-xl md:rounded-2xl overflow-hidden cursor-zoom-in tilt-effect">
                        <img src="{{ $work->image_path }}" alt="{{ $work->title }}" class="w-full h-auto transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                    </a>
                    <div class="flex justify-between items-center mt-2 md:mt-3 px-1">
                        <div class="flex-1 min-w-0">
                            <h3 class="text-xs md:text-sm font-medium font-satoshi tracking-wide text-white truncate">{{ $work->title }}</h3>
                            <p class="text-[10px] md:text-xs text-[#888888] truncate capitalize">{{ str_replace('-', ' ', $work->category) }}</p>
                        </div>
                        <button class="ml-2 text-[#888888] hover:bg-[#1c1c1c] hover:text-white rounded-full p-1.5 transition-colors" aria-label="Options">
                            <svg class="w-4 h-4 md:w-5 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/></svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-12 text-center md:hidden">
            <a href="{{ route('works.index') }}" class="inline-block border border-[#444444] px-8 py-3 text-xs font-medium tracking-widest uppercase hover:border-white transition-colors">
                Lihat Semua
            </a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-32 px-6 md:px-12 bg-[#1c1c1c]">
    <div class="max-w-4xl mx-auto">
        <h2 class="text-xl md:text-3xl font-bold tracking-[0.2em] uppercase mb-4 text-center observe-element opacity-0 transition-all duration-1000 ease-out">Hubungi Kami</h2>
        <p class="text-[#cccccc] text-center mb-16 text-sm tracking-widest uppercase observe-element opacity-0 transition-all duration-1000 ease-out delay-100">Mari diskusikan konsep visual Anda</p>
        
        <form id="wa-contact-form" class="bg-[#0a0a0a] border border-[#444444] p-8 md:p-12 observe-element opacity-0 transition-all duration-1000 ease-out delay-200">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Nama -->
                <div>
                    <label class="block text-xs font-bold tracking-widest uppercase mb-3 text-[#cccccc]">Nama Lengkap</label>
                    <input type="text" id="wa-nama" required class="w-full bg-transparent border-b border-[#444444] text-white py-3 outline-none focus:border-white transition-colors placeholder-[#333333] tracking-wider" placeholder="Cth: Zaim">
                </div>
                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold tracking-widest uppercase mb-3 text-[#cccccc]">Email</label>
                    <input type="email" id="wa-email" required class="w-full bg-transparent border-b border-[#444444] text-white py-3 outline-none focus:border-white transition-colors placeholder-[#333333] tracking-wider" placeholder="Cth: halo@zaim.com">
                </div>
                <!-- Tanggal / Jadwal -->
                <div>
                    <label class="block text-xs font-bold tracking-widest uppercase mb-3 text-[#cccccc]">Tanggal / Jadwal</label>
                    <input type="date" id="wa-tanggal" required class="w-full bg-transparent border-b border-[#444444] text-white py-3 outline-none focus:border-white transition-colors tracking-wider" style="color-scheme: dark;">
                </div>
                <!-- Alamat -->
                <div>
                    <label class="block text-xs font-bold tracking-widest uppercase mb-3 text-[#cccccc]">Alamat Lokasi</label>
                    <input type="text" id="wa-alamat" required class="w-full bg-transparent border-b border-[#444444] text-white py-3 outline-none focus:border-white transition-colors placeholder-[#333333] tracking-wider" placeholder="Cth: Hotel Aston, Batam">
                </div>
            </div>

            <button type="submit" class="magnetic-btn w-full block text-center bg-white text-black border border-white py-4 text-sm font-bold tracking-[0.2em] uppercase hover:bg-black hover:text-white transition-colors duration-300 mt-4">
                Kirim via WhatsApp
            </button>
        </form>
    </div>
</section>

<script>
    document.getElementById('wa-contact-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const nama = document.getElementById('wa-nama').value;
        const email = document.getElementById('wa-email').value;
        const tanggal = document.getElementById('wa-tanggal').value;
        const alamat = document.getElementById('wa-alamat').value;
        
        const waNumber = '62895410258086';
        const message = `Halo Zaim Photography,\n\nSaya ingin berdiskusi mengenai sesi foto. Berikut data diri saya:\n\n*Nama:* ${nama}\n*Email:* ${email}\n*Tanggal / Jadwal:* ${tanggal}\n*Alamat Lokasi:* ${alamat}\n\nMohon informasi lebih lanjut. Terima kasih!`;
        
        const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;
        window.open(waUrl, '_blank');
    });
</script>


<!-- Subscribe Section -->
<section class="py-32 px-6 bg-[#0a0a0a] text-center">
    <div class="max-w-2xl mx-auto observe-element opacity-0 scale-95 transition-all duration-1000 ease-out">
        <h2 class="text-xl md:text-3xl font-bold tracking-[0.2em] uppercase mb-6">Tetap Terhubung</h2>
        <p class="text-[#cccccc] mb-12">Berlangganan untuk mendapatkan karya terbaru dan cerita di balik layar dari Zaim.</p>
        
        @if(session('success_subscribe'))
            <div class="border border-white text-white p-4 mb-8 text-sm tracking-widest uppercase">
                {{ session('success_subscribe') }}
            </div>
        @endif
        
        <form action="{{ route('subscribe.store') }}" method="POST" class="flex flex-col md:flex-row gap-4 justify-center">
            @csrf
            <input type="email" name="email" placeholder="ALAMAT EMAIL ANDA" required class="bg-[#1c1c1c] border border-[#444444] text-white px-6 py-4 outline-none focus:border-white transition-colors w-full md:w-96 placeholder-[#444444] tracking-widest text-sm uppercase">
            <button type="submit" class="bg-white text-black px-8 py-4 font-bold tracking-[0.2em] uppercase hover:bg-[#cccccc] transition-colors duration-300">
                Berlangganan
            </button>
        </form>
        @error('email')
            <p class="text-[#cccccc] text-xs mt-4">{{ $message }}</p>
        @enderror
    </div>
</section>
@endsection
