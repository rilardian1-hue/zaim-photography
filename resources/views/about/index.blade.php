@extends('layouts.app')

@section('content')
<section class="pt-32 pb-24 px-6 md:px-12 bg-[#0a0a0a] min-h-screen">
    <div class="max-w-6xl mx-auto">
        <div class="mb-20 text-center animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold tracking-[0.2em] uppercase mb-6 relative">
                <span class="absolute -top-10 left-1/2 -translate-x-1/2 text-6xl md:text-8xl text-white/5 whitespace-nowrap -z-10 tracking-[0.1em]">TENTANG</span>
                Sang Fotografer
            </h1>
        </div>

        <div class="flex flex-col md:flex-row gap-16 items-center md:items-start">
            <!-- Image Column -->
            <div class="w-full md:w-5/12 flex justify-center observe-element opacity-0 transition-all duration-1000 ease-out">
                <div class="w-72 h-72 md:w-96 md:h-96 rounded-full border border-[#444444] p-2 relative overflow-hidden group">
                    <div class="absolute inset-0 border border-white rounded-full scale-[0.95] opacity-0 group-hover:scale-100 group-hover:opacity-100 transition-all duration-700"></div>
                    <img src="{{ $about->profile_image ?? 'https://picsum.photos/seed/zaim/800/800' }}" alt="{{ $about->full_name }}" class="w-full h-full object-cover rounded-full transition-transform duration-1000 group-hover:scale-105">
                </div>
            </div>

            <!-- Text Column -->
            <div class="w-full md:w-7/12 observe-element opacity-0 transition-all duration-1000 ease-out">
                <h2 class="text-3xl font-bold tracking-widest uppercase mb-2">{{ $about->full_name }}</h2>
                <h3 class="text-sm tracking-[0.3em] uppercase text-[#cccccc] mb-8">{{ $about->school }}</h3>
                
                <div class="text-[#cccccc] leading-loose mb-12 text-sm tracking-wider space-y-6">
                    <p>{{ $about->bio }}</p>
                    @if($about->experience)
                        <p class="border-l border-[#444444] pl-6 ml-2 italic">"{{ $about->experience }}"</p>
                    @endif
                </div>

                <!-- Social Links -->
                <div class="flex space-x-6">
                    @if($about->instagram_url)
                    <a href="{{ $about->instagram_url }}" target="_blank" class="w-12 h-12 border border-[#444444] rounded-full flex items-center justify-center text-[#cccccc] hover:text-white hover:border-white hover:bg-[#1c1c1c] transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    @endif
                    @if($about->tiktok_url)
                    <a href="{{ $about->tiktok_url }}" target="_blank" class="w-12 h-12 border border-[#444444] rounded-full flex items-center justify-center text-[#cccccc] hover:text-white hover:border-white hover:bg-[#1c1c1c] transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 15.68a6.34 6.34 0 006.33 6.32 6.32 6.32 0 006.32-6.32V10a8.21 8.21 0 004.35 1.25v-3.5a4.2 4.2 0 01-2.41-1.06z"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
