@extends('admin.layouts.admin')

@section('title', 'Products')
@section('page-title', 'Products')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">All Products</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $products->total() }} products total</p>
        </div>
        @if (auth()->user()->hasPermission('create-products'))
            <a href="{{ route('admin.products.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Product
            </a>
        @endif
    </div>

    {{-- Filters --}}
    <form method="GET" class="flex flex-wrap items-center gap-3 bg-white rounded-xl border border-gray-200/80 p-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..."
               class="flex-1 min-w-[200px] px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none">
        <select name="category_id" class="px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="type" class="px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
            <option value="">All Types</option>
            @foreach ($types as $type)
                <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
            @endforeach
        </select>
        <select name="status" class="px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-black transition-colors">Filter</button>
        @if (request()->hasAny(['search', 'category_id', 'type', 'status']))
            <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Clear</a>
        @endif
    </form>

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($products as $product)
            <div class="bg-white rounded-xl border border-gray-200/80 overflow-hidden hover:shadow-md transition-shadow group">
                {{-- Image --}}
                <div class="relative aspect-square bg-gray-100">
                    @if ($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75A2.25 2.25 0 001.5 5.25v13.5A2.25 2.25 0 003.75 21z"/></svg>
                        </div>
                    @endif

                    {{-- Status badge --}}
                    <div class="absolute top-2 left-2">
                        @if ($product->is_active)
                            <span class="px-2 py-0.5 rounded-md text-xs font-bold bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-2 py-0.5 rounded-md text-xs font-bold bg-gray-100 text-gray-500">Inactive</span>
                        @endif
                    </div>

                    {{-- Stock indicator --}}
                    <div class="absolute top-2 right-2">
                        @if ($product->stock_status === 'out_of_stock')
                            <span class="px-2 py-0.5 rounded-md text-xs font-bold bg-red-100 text-red-600">Out of stock</span>
                        @elseif ($product->stock_status === 'low_stock')
                            <span class="px-2 py-0.5 rounded-md text-xs font-bold bg-amber-100 text-amber-600">Low stock</span>
                        @endif
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-4">
                    <div class="flex items-center gap-2">
                        @if ($product->category)
                            <span class="text-xs font-bold text-[#B8860B] uppercase tracking-wider">{{ $product->category->name }}</span>
                            <span class="text-xs text-gray-300">·</span>
                        @endif
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">{{ $product->type }}</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 mt-1 truncate">{{ $product->name }}</h3>
                    <p class="text-lg font-black text-gray-900 mt-1">₦{{ number_format($product->price) }}</p>

                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-xs text-gray-400">{{ $product->sizes->count() }} sizes</span>
                        <span class="text-xs text-gray-300">·</span>
                        <span class="text-xs text-gray-400">{{ $product->variants->count() }} colors</span>
                        <span class="text-xs text-gray-300">·</span>
                        <span class="text-xs text-gray-400">{{ $product->total_stock }} in stock</span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
                        @if (auth()->user()->hasPermission('edit-products'))
                            <a href="{{ route('admin.products.edit', $product) }}"
                               class="flex-1 text-center px-3 py-1.5 text-xs font-semibold text-[#B8860B] bg-[#B8860B]/10 rounded-lg hover:bg-[#B8860B]/20 transition-colors">
                                Edit
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('edit-products'))
                            <form method="POST" action="{{ route('admin.products.toggle-status', $product) }}" class="shrink-0">
                                @csrf
                                <button type="submit" title="{{ $product->is_active ? 'Deactivate' : 'Activate' }}"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors
                                               {{ $product->is_active ? 'text-gray-500' : 'text-green-600' }}">
                                    {{ $product->is_active ? 'Hide' : 'Show' }}
                                </button>
                            </form>
                        @endif
                        @if (auth()->user()->hasPermission('delete-products'))
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="shrink-0"
                                  onsubmit="return confirm('Delete {{ $product->name }}? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 text-xs font-semibold text-red-500 rounded-lg hover:bg-red-50 transition-colors">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-gray-400">
                <p class="text-sm">No products found</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div>{{ $products->links() }}</div>
</div>
@endsection
