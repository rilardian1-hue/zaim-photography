@extends('layouts.app')

@section('content')
<section class="pt-32 pb-24 px-6 md:px-12 bg-[#0a0a0a] min-h-screen">
    <div class="max-w-6xl mx-auto">
        <div class="mb-20 text-center animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold tracking-[0.2em] uppercase mb-6 relative">
                <span class="absolute -top-10 left-1/2 -translate-x-1/2 text-6xl md:text-8xl text-white/5 whitespace-nowrap -z-10 tracking-[0.1em]">LAYANAN</span>
                Layanan Jasa
            </h1>
            <p class="text-[#cccccc] max-w-2xl mx-auto">Kami menyediakan berbagai layanan fotografi monokromatik untuk kebutuhan personal hingga komersial.</p>
        </div>

        <div class="space-y-16">
            @foreach($services as $index => $service)
                <div class="group flex flex-col md:flex-row {{ $index % 2 !== 0 ? 'md:flex-row-reverse' : '' }} bg-[#1c1c1c] border border-[#444444] hover:border-white transition-colors duration-500 overflow-hidden observe-element opacity-0 transition-all duration-1000 ease-out">
                    
                    <!-- Text Content -->
                    <div class="w-full md:w-1/2 p-10 md:p-16 flex flex-col justify-center">
                        <h2 class="text-3xl font-bold tracking-widest uppercase mb-4">{{ $service->name }}</h2>
                        <div class="text-2xl font-light mb-8 text-[#cccccc]">Rp {{ number_format($service->price, 0, ',', '.') }}</div>
                        
                        <p class="text-sm leading-relaxed mb-8 text-[#cccccc]">{{ $service->description }}</p>
                        
                        <div class="mb-10 space-y-3 text-xs tracking-widest uppercase text-[#cccccc]">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Durasi: {{ $service->duration }}
                            </div>
                            <div class="flex items-start">
                                <svg class="w-4 h-4 mr-4 mt-1 text-white shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Termasuk: {{ $service->includes }}</span>
                            </div>
                        </div>

                        <a href="{{ route('orders.create', ['service_id' => $service->id]) }}" class="inline-block self-start border border-white px-8 py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-white hover:text-black transition-colors duration-300">
                            Pilih Jasa Ini
                        </a>
                    </div>
                    
                    <!-- Image -->
                    <div class="w-full md:w-1/2 h-64 md:h-auto relative overflow-hidden">
                        <img src="https://picsum.photos/seed/service{{ $service->id }}/800/800" alt="{{ $service->name }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110 group-hover:opacity-60">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors duration-500"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
