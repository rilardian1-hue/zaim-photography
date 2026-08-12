<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Order;
use App\Models\PhotographyWork;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $worksCount = PhotographyWork::count();
        $albumsCount = Album::count();
        $ordersCount = Order::count();
        $latestOrders = Order::latest()->take(5)->get();

        // Revenue Trend (Last 6 Months)
        $revenueData = [];
        $revenueMonths = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = \Carbon\Carbon::now()->subMonths($i);
            $revenueMonths[] = $month->format('M Y');
            $revenue = Order::whereYear('created_at', $month->year)
                            ->whereMonth('created_at', $month->month)
                            ->sum('total_price');
            $revenueData[] = $revenue;
        }

        // Works by Category
        $worksByCategory = PhotographyWork::selectRaw('category, count(*) as count')
                                          ->groupBy('category')
                                          ->pluck('count', 'category')
                                          ->toArray();
        $categoryLabels = array_keys($worksByCategory);
        $categoryData = array_values($worksByCategory);

        return view('admin.dashboard', compact(
            'worksCount', 'albumsCount', 'ordersCount', 'latestOrders',
            'revenueData', 'revenueMonths', 'categoryLabels', 'categoryData'
        ));
    }
}
