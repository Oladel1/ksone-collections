<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_categories' => Category::count(),
            'active_categories' => Category::where('is_active', true)->count(),
            'total_products'  => Product::count(),
            'active_products' => Product::where('is_active', true)->count(),
            'total_orders'    => Order::count(),
            'successful_orders' => Order::where('status', 'success')->count(),
            'total_revenue'   => Order::where('status', 'success')->sum('amount'),
            'total_users'     => User::count(),
            'low_stock'       => Product::whereHas('sizes', function ($q) {
                $q->havingRaw('SUM(stock_quantity) <= 5')->groupBy('product_id');
            })->count(),
        ];

        // Recent orders
        $recentOrders = Order::latest()->take(10)->get();

        // Low stock products
        $lowStockProducts = Product::with('sizes')
            ->get()
            ->filter(fn ($p) => $p->total_stock <= 5 && $p->total_stock >= 0)
            ->take(5);

        // Revenue by month (last 6 months)
        $monthlyRevenue = Order::where('status', 'success')
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('SUM(amount) as revenue'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts', 'monthlyRevenue'));
    }
}
