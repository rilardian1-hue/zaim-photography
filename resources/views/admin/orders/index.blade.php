@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-10 observe-element delay-100">
    <h1 class="text-3xl font-bold tracking-widest uppercase">Kelola Pesanan</h1>
</div>

<div class="bg-[#1c1c1c] border border-[#444444] observe-element delay-200 overflow-x-auto">
    <table class="w-full text-left text-sm">
        <thead class="text-xs uppercase tracking-widest bg-[#0a0a0a] border-b border-[#444444] text-[#cccccc]">
            <tr>
                <th scope="col" class="px-6 py-4">ID Pesanan</th>
                <th scope="col" class="px-6 py-4">Klien</th>
                <th scope="col" class="px-6 py-4">Paket</th>
                <th scope="col" class="px-6 py-4">Tanggal Acara</th>
                <th scope="col" class="px-6 py-4">Status</th>
                <th scope="col" class="px-6 py-4 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr class="border-b border-[#444444] hover:bg-[#111] transition-colors">
                    <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                        {{ $order->order_number }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-white">{{ $order->client_name }}</div>
                        <div class="text-xs text-[#706f6c]">{{ $order->client_phone }}</div>
                    </td>
                    <td class="px-6 py-4 text-[#cccccc]">
                        {{ $order->service ? $order->service->name : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 text-[#cccccc]">
                        {{ $order->event_date ? \Carbon\Carbon::parse($order->event_date)->format('d M Y') : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($order->status === 'pending')
                            <span class="bg-yellow-900/30 text-yellow-500 border border-yellow-500/50 px-2 py-1 text-xs uppercase tracking-wider rounded-sm">Pending</span>
                        @elseif($order->status === 'confirmed')
                            <span class="bg-blue-900/30 text-blue-400 border border-blue-500/50 px-2 py-1 text-xs uppercase tracking-wider rounded-sm">Confirmed</span>
                        @elseif($order->status === 'done')
                            <span class="bg-green-900/30 text-green-400 border border-green-500/50 px-2 py-1 text-xs uppercase tracking-wider rounded-sm">Done</span>
                        @elseif($order->status === 'canceled')
                            <span class="bg-red-900/30 text-red-500 border border-red-500/50 px-2 py-1 text-xs uppercase tracking-wider rounded-sm">Canceled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end space-x-3">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-xs tracking-widest uppercase text-white hover:text-[#cccccc] transition-colors">Detail</a>
                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs tracking-widest uppercase text-red-500 hover:text-red-400 transition-colors">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-[#cccccc] text-sm tracking-widest uppercase">
                        Belum ada pesanan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-6">
    {{ $orders->links() }}
</div>
@endsection
