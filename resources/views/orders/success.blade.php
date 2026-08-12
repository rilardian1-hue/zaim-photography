@extends('layouts.app')

@section('content')
<section class="pt-32 pb-24 px-6 md:px-12 bg-[#0a0a0a] min-h-screen flex items-center justify-center">
    <div class="max-w-2xl w-full mx-auto bg-[#1c1c1c] border border-[#444444] p-10 md:p-16 text-center animate-fade-in-up">
        
        <div class="w-20 h-20 mx-auto rounded-full border-2 border-white flex items-center justify-center mb-8">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold tracking-widest uppercase mb-4">Pesanan Diterima</h1>
        <p class="text-[#cccccc] text-sm mb-12">Terima kasih, {{ $order->client_name }}. Pesanan Anda dengan nomor <strong class="text-white">{{ $order->order_number }}</strong> telah kami simpan.</p>
        
        <div class="bg-[#0a0a0a] p-6 text-left border border-[#444444] mb-12">
            <h3 class="text-xs font-bold tracking-widest uppercase mb-6 border-b border-[#1c1c1c] pb-4">Rincian</h3>
            
            <div class="space-y-4 text-sm tracking-wider uppercase text-[#cccccc]">
                <div class="flex justify-between">
                    <span>Layanan</span>
                    <span class="text-white">{{ $order->service->name }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Tanggal</span>
                    <span class="text-white">{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Total</span>
                    <span class="text-white font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <a href="{{ $waLink }}" target="_blank" class="block w-full text-center bg-white text-black border border-white py-4 text-xs font-bold tracking-[0.3em] uppercase hover:bg-transparent hover:text-white transition-colors duration-300">
            Konfirmasi via WhatsApp
        </a>
        
        <p class="text-[10px] text-[#444444] tracking-widest uppercase mt-6">Silakan klik tombol di atas untuk melanjutkan percakapan dengan admin Zaim Photography.</p>
    </div>
</section>
@endsection
