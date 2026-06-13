@extends('admin.layouts.admin')

@section('title', 'Orders')
@section('page-title', 'Orders')

@section('content')
<div class="space-y-6">

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-gray-200/80 p-4">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Orders</p>
            <p class="text-xl font-black text-gray-900 mt-1">{{ $stats['total'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200/80 p-4">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Successful</p>
            <p class="text-xl font-black text-green-600 mt-1">{{ $stats['success'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200/80 p-4">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Pending</p>
            <p class="text-xl font-black text-yellow-600 mt-1">{{ $stats['pending'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200/80 p-4">
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Revenue</p>
            <p class="text-xl font-black text-gray-900 mt-1">₦{{ number_format($stats['revenue']) }}</p>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" class="flex flex-wrap items-center gap-3 bg-white rounded-xl border border-gray-200/80 p-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, ref..."
               class="flex-1 min-w-[200px] px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
        <select name="status" class="px-3 py-2 rounded-lg border border-gray-200 text-sm">
            <option value="">All Status</option>
            <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Success</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
            <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
        </select>
        <input type="date" name="date_from" value="{{ request('date_from') }}" class="px-3 py-2 rounded-lg border border-gray-200 text-sm">
        <input type="date" name="date_to" value="{{ request('date_to') }}" class="px-3 py-2 rounded-lg border border-gray-200 text-sm">
        <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg">Filter</button>
        @if (request()->hasAny(['search', 'status', 'date_from', 'date_to']))
            <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Clear</a>
        @endif
    </form>

    {{-- Orders Table --}}
    <div class="bg-white rounded-xl border border-gray-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Reference</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Customer</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Product</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Amount</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Status</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider">Date</th>
                        <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wider"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($orders as $order)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-5 py-3 font-mono text-xs text-gray-500">{{ $order->reference }}</td>
                            <td class="px-5 py-3">
                                <p class="font-medium text-gray-900">{{ $order->customer_name }}</p>
                                <p class="text-xs text-gray-400">{{ $order->customer_email }}</p>
                            </td>
                            <td class="px-5 py-3">
                                <p class="text-gray-900">{{ $order->product_name }}</p>
                                <p class="text-xs text-gray-400">{{ $order->variant }} · Size {{ $order->size }}</p>
                            </td>
                            <td class="px-5 py-3 font-bold text-gray-900">₦{{ number_format($order->amount) }}</td>
                            <td class="px-5 py-3">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order->status_badge }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-5 py-3">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-xs font-semibold text-[#B8860B] hover:underline">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-12 text-center text-gray-400">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>{{ $orders->links() }}</div>
</div>
@endsection
