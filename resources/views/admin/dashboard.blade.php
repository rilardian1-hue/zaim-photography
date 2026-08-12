@extends('admin.layouts.app')

@section('content')
<h1 class="text-3xl font-bold tracking-widest uppercase mb-10 observe-element delay-100">Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-200">
        <h3 class="text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Total Karya</h3>
        <p class="text-4xl font-light">{{ $worksCount }}</p>
    </div>
    <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-300">
        <h3 class="text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Total Album</h3>
        <p class="text-4xl font-light">{{ $albumsCount }}</p>
    </div>
    <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-400">
        <h3 class="text-[10px] tracking-[0.2em] uppercase text-[#cccccc] mb-2">Pesanan Masuk</h3>
        <p class="text-4xl font-light">{{ $ordersCount }}</p>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
    <!-- Revenue Trend Chart -->
    <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-500">
        <h2 class="text-[10px] font-bold tracking-[0.2em] uppercase mb-4 text-[#cccccc]">Tren Pendapatan (6 Bulan)</h2>
        <div id="revenueChart" class="min-h-[350px]"></div>
    </div>
    
    <!-- Category Chart -->
    <div class="bg-[#1c1c1c] border border-[#444444] p-6 observe-element delay-600">
        <h2 class="text-[10px] font-bold tracking-[0.2em] uppercase mb-4 text-[#cccccc]">Karya Berdasarkan Kategori</h2>
        <div id="categoryChart" class="min-h-[350px]"></div>
    </div>
</div>

<h2 class="text-xl font-bold tracking-widest uppercase mb-6 observe-element delay-700">Pesanan Terbaru</h2>
<div class="bg-[#1c1c1c] border border-[#444444] overflow-x-auto observe-element delay-700">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-[#444444] text-[10px] tracking-[0.2em] uppercase text-[#cccccc]">
                <th class="p-4 font-normal">No Order</th>
                <th class="p-4 font-normal">Klien</th>
                <th class="p-4 font-normal">Layanan</th>
                <th class="p-4 font-normal">Tanggal</th>
                <th class="p-4 font-normal">Status</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @forelse($latestOrders as $order)
                <tr class="border-b border-[#444444] hover:bg-[#2a2a2a] transition-colors">
                    <td class="p-4">{{ $order->order_number }}</td>
                    <td class="p-4">{{ $order->client_name }}</td>
                    <td class="p-4">{{ $order->service->name }}</td>
                    <td class="p-4">{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</td>
                    <td class="p-4 uppercase text-[10px] tracking-widest">{{ $order->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-[#cccccc] text-xs uppercase tracking-widest">Belum ada pesanan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Revenue Chart (Area Gradient)
        var revenueOptions = {
            series: [{
                name: 'Pendapatan',
                data: {!! json_encode(array_reverse($revenueData)) !!}
            }],
            chart: {
                type: 'area',
                height: 350,
                toolbar: { show: false },
                background: 'transparent',
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#ffffff'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.05,
                    stops: [0, 100]
                }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            xaxis: {
                categories: {!! json_encode(array_reverse($revenueMonths)) !!},
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: '#706f6c' } }
            },
            yaxis: {
                labels: {
                    formatter: function (val) { return "Rp " + val.toLocaleString('id-ID'); },
                    style: { colors: '#706f6c' }
                }
            },
            grid: {
                borderColor: '#444444',
                strokeDashArray: 4,
                yaxis: { lines: { show: true } }
            },
            theme: { mode: 'dark' },
            tooltip: { theme: 'dark' }
        };

        var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
        revenueChart.render();

        // Category Chart (Bar)
        var categoryOptions = {
            series: [{
                name: 'Total Karya',
                data: {!! json_encode($categoryData) !!}
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: false },
                background: 'transparent',
                fontFamily: 'Inter, sans-serif'
            },
            colors: ['#cccccc'],
            plotOptions: {
                bar: {
                    borderRadius: 2,
                    horizontal: true,
                }
            },
            dataLabels: { enabled: false },
            xaxis: {
                categories: {!! json_encode(array_map('strtoupper', $categoryLabels)) !!},
                labels: { style: { colors: '#706f6c' } }
            },
            yaxis: {
                labels: { style: { colors: '#cccccc' } }
            },
            grid: {
                borderColor: '#444444',
                strokeDashArray: 4,
            },
            theme: { mode: 'dark' },
            tooltip: { theme: 'dark' }
        };

        var categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryOptions);
        categoryChart.render();
    });
</script>
@endsection
