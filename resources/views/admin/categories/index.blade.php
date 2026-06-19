@extends('admin.layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-900">All Categories</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $categories->total() }} categories total</p>
        </div>
        @if (auth()->user()->hasPermission('create-categories'))
            <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Category
            </a>
        @endif
    </div>

    {{-- Filters --}}
    <form method="GET" class="flex flex-wrap items-center gap-3 bg-white rounded-xl border border-gray-200/80 p-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..."
               class="flex-1 min-w-[200px] px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none">
        <select name="status" class="px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
            <option value="">All Status</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-black transition-colors">Filter</button>
        @if (request()->hasAny(['search', 'status']))
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Clear</a>
        @endif
    </form>

    {{-- Categories Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($categories as $category)
            <div class="bg-white rounded-xl border border-gray-200/80 overflow-hidden hover:shadow-md transition-shadow group">
                {{-- Icon / Image --}}
                <div class="relative aspect-[4/3] bg-gray-50 flex items-center justify-center">
                    @if ($category->icon_image)
                        <img src="{{ asset('images/' . $category->icon_image) }}" alt="{{ $category->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-20 h-20 rounded-2xl bg-gray-100 border border-gray-200/60 flex items-center justify-center">
                            <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 01-1.125-1.125v-3.75zM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-8.25zM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 01-1.125-1.125v-2.25z"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Status badge --}}
                    <div class="absolute top-2 left-2">
                        @if ($category->is_active)
                            <span class="px-2 py-0.5 rounded-md text-xs font-bold bg-green-100 text-green-700">Active</span>
                        @else
                            <span class="px-2 py-0.5 rounded-md text-xs font-bold bg-gray-100 text-gray-500">Inactive</span>
                        @endif
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-4">
                    <h3 class="text-base font-bold text-gray-900">{{ $category->name }}</h3>
                    @if ($category->subtitle)
                        <p class="text-sm text-gray-500 mt-0.5">{{ $category->subtitle }}</p>
                    @endif

                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-xs text-gray-400">{{ $category->products_count }} product{{ $category->products_count !== 1 ? 's' : '' }}</span>
                        <span class="text-xs text-gray-300">·</span>
                        <span class="text-xs text-gray-400">Order: {{ $category->sort_order }}</span>
                    </div>

                    {{-- View on site --}}
                    <a href="{{ url('/c/' . $category->slug) }}" target="_blank"
                       class="inline-flex items-center gap-1 text-xs text-[#B8860B] font-medium mt-2 hover:underline">
                        View Page
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    </a>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
                        @if (auth()->user()->hasPermission('edit-categories'))
                            <a href="{{ route('admin.categories.edit', $category) }}"
                               class="flex-1 text-center px-3 py-1.5 text-xs font-semibold text-[#B8860B] bg-[#B8860B]/10 rounded-lg hover:bg-[#B8860B]/20 transition-colors">
                                Edit
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('edit-categories'))
                            <form method="POST" action="{{ route('admin.categories.toggle-status', $category) }}" class="shrink-0">
                                @csrf
                                <button type="submit" title="{{ $category->is_active ? 'Deactivate' : 'Activate' }}"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors
                                               {{ $category->is_active ? 'text-gray-500' : 'text-green-600' }}">
                                    {{ $category->is_active ? 'Hide' : 'Show' }}
                                </button>
                            </form>
                        @endif
                        @if (auth()->user()->hasPermission('delete-categories'))
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="shrink-0"
                                  onsubmit="return confirm('Delete {{ $category->name }}? Products in this category will become uncategorized.')">
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
                <p class="text-sm">No categories found</p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div>{{ $categories->links() }}</div>
</div>
@endsection
