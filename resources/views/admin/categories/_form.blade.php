{{-- Category Create/Edit Form --}}
@php $isEdit = !is_null($category); @endphp

<form method="POST"
      action="{{ $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
      enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if ($isEdit) @method('PUT') @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-800">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Basic Info --}}
    <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6 space-y-5">
        <h3 class="font-bold text-gray-900">Category Details</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Category Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                       placeholder="e.g. Footwear, Bags, Belts"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none"
                       required>
                <p class="text-xs text-gray-400 mt-1">This will appear on the home page and as the page title.</p>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $category->subtitle ?? '') }}"
                       placeholder="e.g. Premium leather shoes"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none">
                <p class="text-xs text-gray-400 mt-1">Short text shown below the name on the home page.</p>
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3"
                          placeholder="Longer description for the category page..."
                          class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none resize-vertical">{{ old('description', $category->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none">
                <p class="text-xs text-gray-400 mt-1">Controls display order on the home page.</p>
            </div>

            <div class="flex items-end">
                <label class="flex items-center gap-2 cursor-pointer pb-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-300 text-[#B8860B] focus:ring-[#B8860B]/20">
                    <span class="text-sm font-medium text-gray-700">Active (visible on website)</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Icon Image --}}
    <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6 space-y-4">
        <h3 class="font-bold text-gray-900">Category Icon</h3>
        <p class="text-sm text-gray-500">Upload an icon or image that represents this category on the home page.</p>

        @if ($isEdit && $category->icon_image)
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/' . $category->icon_image) }}" alt="Current icon"
                     class="w-20 h-20 rounded-xl object-cover border border-gray-200 bg-gray-50">
                <p class="text-sm text-gray-500">Current icon</p>
            </div>
        @endif

        <input type="file" name="icon_image" accept="image/*"
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#B8860B]/10 file:text-[#B8860B] hover:file:bg-[#B8860B]/20">
        <p class="text-xs text-gray-400">PNG or SVG recommended. Max 2MB. Square aspect ratio works best.</p>
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-3">
        <button type="submit"
                class="px-6 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
            {{ $isEdit ? 'Update Category' : 'Create Category' }}
        </button>
        <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700">Cancel</a>
    </div>
</form>
