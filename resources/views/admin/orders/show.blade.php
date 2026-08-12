@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-10 observe-element delay-100">
    <div>
        <h1 class="text-3xl font-bold tracking-widest uppercase mb-2">Detail Pesanan</h1>
        <p class="text-[#706f6c] text-sm tracking-widest uppercase">#{{ $order->order_number }}</p>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="text-xs tracking-widest uppercase text-[#cccccc] hover:text-white transition-colors">
        &larr; Kembali
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-8">
        <!-- Informasi Klien -->
        <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-200">
            <h2 class="text-lg font-bold tracking-widest uppercase border-b border-[#444444] pb-4 mb-4">Informasi Klien</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Nama Lengkap</p>
                    <p class="text-sm font-medium">{{ $order->client_name }}</p>
                </div>
                <div>
                    <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Email</p>
                    <p class="text-sm font-medium">{{ $order->client_email }}</p>
                </div>
                <div>
                    <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">No WhatsApp</p>
                    <div class="flex items-center space-x-3">
                        <p class="text-sm font-medium">{{ $order->client_phone }}</p>
                        @php
                            $waNumber = $order->client_phone;
                            if(str_starts_with($waNumber, '0')) {
                                $waNumber = '62' . substr($waNumber, 1);
                            }
                        @endphp
                        <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="text-xs bg-green-900/30 text-green-400 border border-green-500/50 px-2 py-1 rounded hover:bg-green-900/50 transition-colors">
                            Chat WA
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Acara -->
        <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-300">
            <h2 class="text-lg font-bold tracking-widest uppercase border-b border-[#444444] pb-4 mb-4">Detail Acara & Paket</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Paket Layanan</p>
                    <p class="text-sm font-medium">{{ $order->service ? $order->service->name : 'Paket telah dihapus' }}</p>
                </div>
                <div>
                    <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Tanggal Acara</p>
                    <p class="text-sm font-medium">{{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->format('d F Y') : 'Belum ditentukan' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Lokasi</p>
                    <p class="text-sm font-medium">{{ $order->location ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Catatan Tambahan</p>
                    <p class="text-sm font-medium whitespace-pre-wrap">{{ $order->notes ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Samping (Status & Pembayaran) -->
    <div class="space-y-8">
        <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-400">
            <h2 class="text-lg font-bold tracking-widest uppercase border-b border-[#444444] pb-4 mb-4">Status & Pembayaran</h2>
            
            <div class="mb-6">
                <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Total Harga</p>
                <p class="text-2xl font-bold tracking-widest">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
            </div>

            <div class="mb-6">
                <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-1">Metode Pembayaran</p>
                <p class="text-sm font-medium uppercase tracking-widest">{{ str_replace('_', ' ', $order->payment_method) }}</p>
            </div>

            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="status" class="block text-xs text-[#706f6c] tracking-widest uppercase mb-2">Update Status</label>
                    <select name="status" id="status" class="w-full bg-[#0a0a0a] border border-[#333] text-white text-sm px-4 py-3 focus:outline-none focus:border-white transition-colors uppercase tracking-widest">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed (DP Diterima)</option>
                        <option value="done" {{ $order->status == 'done' ? 'selected' : '' }}>Done (Selesai)</option>
                        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-white text-black px-6 py-3 text-xs font-bold tracking-widest uppercase hover:bg-[#cccccc] transition-colors cursor-hover">
                    Simpan Perubahan
                </button>
            </form>
        </div>
        
        <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-500 text-center">
            <p class="text-xs text-[#706f6c] tracking-widest uppercase mb-2">Waktu Pemesanan</p>
            <p class="text-sm text-white">{{ $order->created_at->format('d M Y, H:i') }}</p>
        </div>
    </div>
</div>
@endsection
