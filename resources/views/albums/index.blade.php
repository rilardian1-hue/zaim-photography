@extends('layouts.app')

@section('content')
<section class="pt-32 pb-24 px-6 md:px-12 bg-[#0a0a0a] min-h-screen">
    <div class="max-w-6xl mx-auto">
        <div class="mb-20 text-center">
            <div class="mask-reveal-container mb-6 relative">
                <h1 class="mask-reveal observe-element delay-100 text-4xl md:text-6xl font-bold tracking-[0.2em] uppercase relative">
                    <span class="absolute -top-10 left-1/2 -translate-x-1/2 text-6xl md:text-8xl text-white/5 whitespace-nowrap -z-10 tracking-[0.1em]">ALBUM</span>
                    Koleksi Galeri
                </h1>
            </div>
            <p class="text-[#cccccc] max-w-2xl mx-auto tracking-widest text-sm uppercase observe-element delay-200">
                Cerita yang dikurasi dalam bingkai-bingkai monokromatik.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($albums as $album)
                <a href="{{ route('albums.show', $album->slug) }}" class="group block observe-element opacity-0 transition-all duration-1000 ease-out tilt-effect">
                    <div class="relative aspect-square overflow-hidden mb-6 border border-[#1c1c1c]">
                        <!-- Kita ambil cover dari karya pertamanya jika cover_image tidak ada -->
                        @php
                            $cover = $album->cover_image ?? ($album->photographyWorks()->first()->image_path ?? 'https://picsum.photos/seed/'.rand().'/800/800');
                        @endphp
                        <img src="{{ $cover }}" alt="{{ $album->title }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105">
                        
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col items-center justify-center p-6 text-center">
                            <span class="text-white border border-white px-6 py-2 text-[10px] tracking-[0.3em] uppercase hover:bg-white hover:text-black transition-colors duration-300">
                                Buka Album
                            </span>
                        </div>
                    </div>
                    <h2 class="text-xl font-bold tracking-widest uppercase mb-2 group-hover:text-[#cccccc] transition-colors">{{ $album->title }}</h2>
                    <p class="text-xs text-[#444444] tracking-widest uppercase">{{ $album->photographyWorks()->count() }} Foto</p>
                </a>
            @empty
                <div class="col-span-full text-center py-20 border border-[#1c1c1c] text-[#cccccc] tracking-widest uppercase text-sm">
                    Belum ada album yang dibuat.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
