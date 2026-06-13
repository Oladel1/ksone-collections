@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Stats Grid --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- Products --}}
        <div class="bg-white rounded-xl border border-gray-200/80 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Products</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $stats['active_products'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $stats['total_products'] }} total</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
                </div>
            </div>
        </div>

        {{-- Orders --}}
        <div class="bg-white rounded-xl border border-gray-200/80 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Orders</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">{{ $stats['successful_orders'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $stats['total_orders'] }} total</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        {{-- Revenue --}}
        <div class="bg-white rounded-xl border border-gray-200/80 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Revenue</p>
                    <p class="text-2xl font-black text-gray-900 mt-1">₦{{ number_format($stats['total_revenue']) }}</p>
                    <p class="text-xs text-gray-400 mt-1">All time</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-[#B8860B]/10 flex items-center justify-center">
                    <span class="text-lg">💰</span>
                </div>
            </div>
        </div>

        {{-- Low Stock --}}
        <div class="bg-white rounded-xl border border-gray-200/80 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Low Stock</p>
                    <p class="text-2xl font-black {{ $stats['low_stock'] > 0 ? 'text-amber-600' : 'text-gray-900' }} mt-1">{{ $stats['low_stock'] }}</p>
                    <p class="text-xs text-gray-400 mt-1">Need attention</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                </div>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Recent Orders --}}
        <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200/80">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-semibold text-[#B8860B] hover:underline">View All →</a>
            </div>

            @if ($recentOrders->count())
                <div class="divide-y divide-gray-50">
                    @foreach ($recentOrders as $order)
                        <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50/50">
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $order->product_name }} · {{ $order->reference }}</p>
                            </div>
                            <div class="text-right shrink-0 ml-4">
                                <p class="text-sm font-bold text-gray-900">₦{{ number_format($order->amount) }}</p>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $order->status_badge }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-5 py-12 text-center text-gray-400">
                    <p class="text-sm">No orders yet</p>
                </div>
            @endif
        </div>

        {{-- Low Stock Alert --}}
        <div class="bg-white rounded-xl border border-gray-200/80">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Low Stock</h3>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-semibold text-[#B8860B] hover:underline">All Products →</a>
            </div>

            @if ($lowStockProducts->count())
                <div class="divide-y divide-gray-50">
                    @foreach ($lowStockProducts as $product)
                        <div class="px-5 py-3 flex items-center gap-3 hover:bg-gray-50/50">
                            @if ($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                                     class="w-10 h-10 rounded-lg object-cover border border-gray-100">
                            @endif
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $product->name }}</p>
                                <p class="text-xs mt-0.5">
                                    @if ($product->total_stock <= 0)
                                        <span class="text-red-500 font-semibold">Out of stock</span>
                                    @else
                                        <span class="text-amber-500 font-semibold">{{ $product->total_stock }} left</span>
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-xs text-[#B8860B] font-medium hover:underline">Edit</a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-5 py-12 text-center text-gray-400">
                    <svg class="w-8 h-8 mx-auto mb-2 text-green-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm">All stocked up!</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
