@extends('layouts.app')

@section('content')
<section class="pt-32 pb-24 px-6 md:px-12 bg-[#0a0a0a] min-h-screen flex items-center justify-center">
    <div class="max-w-4xl w-full mx-auto bg-[#1c1c1c] border border-[#444444] flex flex-col md:flex-row overflow-hidden animate-fade-in-up">
        
        <!-- Summary Side -->
        <div class="w-full md:w-1/3 bg-[#0a0a0a] p-10 border-b md:border-b-0 md:border-r border-[#444444] flex flex-col justify-between relative overflow-hidden group">
            <img src="https://picsum.photos/seed/service{{ $service->id }}/400/800" alt="" class="absolute inset-0 w-full h-full object-cover opacity-20 transition-transform duration-1000 group-hover:scale-110">
            <div class="relative z-10">
                <h3 class="text-[10px] tracking-[0.3em] uppercase text-[#cccccc] mb-2 border-b border-[#444444] inline-block pb-2">Ringkasan Layanan</h3>
                <h2 class="text-xl font-bold tracking-widest uppercase mb-4 mt-4">{{ $service->name }}</h2>
                <p class="text-xs text-[#cccccc] mb-8 leading-relaxed">{{ $service->description }}</p>
            </div>
            
            <div class="relative z-10 space-y-4 text-xs tracking-widest uppercase">
                <div class="flex justify-between border-b border-[#444444] pb-2">
                    <span class="text-[#cccccc]">Durasi</span>
                    <span>{{ $service->duration }}</span>
                </div>
                <div class="flex justify-between border-b border-[#444444] pb-2">
                    <span class="text-[#cccccc]">Total</span>
                    <span class="font-bold">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full md:w-2/3 p-10 md:p-16">
            <h1 class="text-2xl font-bold tracking-widest uppercase mb-8">Detail Pemesanan</h1>
            
            <form action="{{ route('orders.store') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="service_id" value="{{ $service->id }}">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="client_name" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Nama Lengkap *</label>
                        <input type="text" id="client_name" name="client_name" value="{{ old('client_name') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                        @error('client_name') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="client_email" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Email *</label>
                        <input type="email" id="client_email" name="client_email" value="{{ old('client_email') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                        @error('client_email') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="client_phone" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Nomor WhatsApp *</label>
                        <input type="text" id="client_phone" name="client_phone" value="{{ old('client_phone') }}" placeholder="08..." required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                        @error('client_phone') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="event_date" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Tanggal Acara *</label>
                        <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm [color-scheme:dark]">
                        @error('event_date') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="location" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Lokasi Acara *</label>
                    <input type="text" id="location" name="location" value="{{ old('location') }}" required class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm">
                    @error('location') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="notes" class="block text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Catatan Khusus</label>
                    <textarea id="notes" name="notes" rows="3" class="w-full bg-[#0a0a0a] border border-[#444444] text-white px-4 py-3 outline-none focus:border-white transition-colors text-sm resize-none">{{ old('notes') }}</textarea>
                    @error('notes') <p class="text-[#cccccc] text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full block text-center border border-white py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-white hover:text-black transition-colors duration-300">
                        Kirim Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
