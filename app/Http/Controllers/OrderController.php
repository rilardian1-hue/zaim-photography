<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $serviceId = $request->query('service_id');
        $service = Service::findOrFail($serviceId);
        
        return view('orders.create', compact('service'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => ['required', 'regex:/^(\+62|08)[0-9]{8,13}$/'],
            'event_date' => 'required|date|after_or_equal:today',
            'location' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $service = Service::findOrFail($validated['service_id']);
        
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'service_id' => $service->id,
            'client_name' => $validated['client_name'],
            'client_email' => $validated['client_email'],
            'client_phone' => $validated['client_phone'],
            'event_date' => $validated['event_date'],
            'location' => $validated['location'],
            'notes' => $validated['notes'],
            'total_price' => $service->price,
            'status' => 'pending',
            'payment_method' => 'manual_wa'
        ]);

        return redirect()->route('orders.success', $order->order_number);
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('service')->firstOrFail();
        
        $waAdmin = env('WA_ADMIN_NUMBER', '6281234567890');
        $text = "Halo Zaim Photography,\n\nSaya ingin mengkonfirmasi pesanan dengan detail berikut:\n";
        $text .= "No Order: " . $order->order_number . "\n";
        $text .= "Nama: " . $order->client_name . "\n";
        $text .= "Layanan: " . $order->service->name . "\n";
        $text .= "Tanggal: " . \Carbon\Carbon::parse($order->event_date)->format('d M Y') . "\n";
        $text .= "Lokasi: " . $order->location . "\n";
        $text .= "Total: Rp " . number_format($order->total_price, 0, ',', '.') . "\n\n";
        $text .= "Mohon informasi untuk proses selanjutnya. Terima kasih.";
        
        $waLink = "https://wa.me/" . $waAdmin . "?text=" . urlencode($text);
        
        return view('orders.success', compact('order', 'waLink'));
    }
}
