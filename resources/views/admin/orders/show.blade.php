@extends('admin.layouts.admin')

@section('title', 'Order ' . $order->reference)
@section('page-title', 'Order Details')

@section('content')
<div class="max-w-3xl space-y-6">

    <a href="{{ route('admin.orders.index') }}" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/></svg>
        Back to Orders
    </a>

    {{-- Order Info --}}
    <div class="bg-white rounded-xl border border-gray-200/80 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-bold text-gray-900">{{ $order->reference }}</h2>
                <p class="text-sm text-gray-400 mt-1">{{ $order->created_at->format('F d, Y \a\t H:i') }}</p>
            </div>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $order->status_badge }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- Customer --}}
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Customer</h4>
                <p class="text-sm font-medium text-gray-900">{{ $order->customer_name }}</p>
                <p class="text-sm text-gray-500">{{ $order->customer_email }}</p>
                @if ($order->customer_phone)
                    <p class="text-sm text-gray-500">{{ $order->customer_phone }}</p>
                @endif
            </div>

            {{-- Product --}}
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Product</h4>
                <div class="flex items-center gap-3">
                    @if ($order->product_image)
                        <img src="{{ asset('images/' . $order->product_image) }}" alt="" class="w-12 h-12 rounded-lg object-cover border">
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $order->product_name }}</p>
                        <p class="text-xs text-gray-500">Color: {{ $order->variant ?? '—' }} · Size: {{ $order->size ?? '—' }}</p>
                    </div>
                </div>
            </div>

            {{-- Payment --}}
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Payment</h4>
                <p class="text-xl font-black text-gray-900">₦{{ number_format($order->amount) }}</p>
                <p class="text-xs text-gray-500">{{ strtoupper($order->currency) }} · {{ ucfirst($order->channel) }}</p>
                @if ($order->paid_at)
                    <p class="text-xs text-gray-400 mt-1">Paid: {{ $order->paid_at->format('M d, Y H:i') }}</p>
                @endif
            </div>

            {{-- Gateway --}}
            <div>
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Gateway Response</h4>
                <p class="text-sm text-gray-500">{{ $order->gateway_response ?? '—' }}</p>
            </div>
        </div>
    </div>

    {{-- Update Status --}}
    @if (auth()->user()->hasPermission('manage-orders'))
        <div class="bg-white rounded-xl border border-gray-200/80 p-6">
            <h3 class="font-bold text-gray-900 mb-4">Update Status</h3>
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="flex items-center gap-3">
                @csrf @method('PATCH')
                <select name="status" class="flex-1 px-3 py-2 rounded-lg border border-gray-200 text-sm">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="success" {{ $order->status === 'success' ? 'selected' : '' }}>Success</option>
                    <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ $order->status === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-black transition-colors">
                    Update
                </button>
            </form>
        </div>
    @endif
</div>
@endsection
