{{-- Product Create/Edit Form --}}
@php $isEdit = !is_null($product); @endphp

<form method="POST"
      action="{{ $isEdit ? route('admin.products.update', $product) : route('admin.products.store') }}"
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
        <h3 class="font-bold text-gray-900">Product Details</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                <select name="category_id"
                        class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none"
                        required>
                    <option value="">Select category…</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type *</label>
                <input type="text" name="type" value="{{ old('type', $product->type ?? '') }}"
                       placeholder="e.g. loafer, slide, mule"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none"
                       required>
                <p class="text-xs text-gray-400 mt-1">Sub-type used for filtering within the category page.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Price (₦) *</label>
                <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" min="0"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Badge</label>
                <input type="text" name="badge" value="{{ old('badge', $product->badge ?? '') }}"
                       placeholder="e.g. popular, premium, new"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none">
            </div>

            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none resize-vertical">{{ old('description', $product->description ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}" min="0"
                       class="w-full px-3 py-2.5 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] focus:ring-1 focus:ring-[#B8860B]/20 outline-none">
            </div>

            <div class="flex items-end">
                <label class="flex items-center gap-2 cursor-pointer pb-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-gray-300 text-[#B8860B] focus:ring-[#B8860B]/20">
                    <span class="text-sm font-medium text-gray-700">Active (visible on website)</span>
                </label>
            </div>
        </div>
    </div>

    {{-- Image --}}
    <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6 space-y-4">
        <h3 class="font-bold text-gray-900">Product Image</h3>

        @if ($isEdit && $product->image)
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/' . $product->image) }}" alt="Current" class="w-24 h-24 rounded-lg object-cover border border-gray-200">
                <p class="text-sm text-gray-500">Current image</p>
            </div>
        @endif

        <input type="file" name="image" accept="image/*"
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#B8860B]/10 file:text-[#B8860B] hover:file:bg-[#B8860B]/20">
        <p class="text-xs text-gray-400">JPEG, PNG. Max 5MB.</p>
    </div>

    {{-- Sizes & Stock --}}
    <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6" x-data="sizesManager()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-900">Sizes & Stock</h3>
            <button type="button" @click="addSize()"
                    class="text-xs font-semibold text-[#B8860B] hover:underline flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Size
            </button>
        </div>

        <template x-for="(item, index) in sizes" :key="index">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex-1">
                    <input type="number" :name="'sizes[' + index + '][size]'" x-model="item.size"
                           placeholder="Size (e.g. 42)" min="1"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
                </div>
                <div class="flex-1">
                    <input type="number" :name="'sizes[' + index + '][stock]'" x-model="item.stock"
                           placeholder="Stock qty" min="0"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
                </div>
                <button type="button" @click="removeSize(index)"
                        class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </template>

        <p x-show="sizes.length === 0" class="text-sm text-gray-400 text-center py-4">No sizes added yet</p>
    </div>

    {{-- Variants (Colors) --}}
    <div class="bg-white rounded-xl border border-gray-200/80 p-5 sm:p-6" x-data="variantsManager()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-900">Color Variants</h3>
            <button type="button" @click="addVariant()"
                    class="text-xs font-semibold text-[#B8860B] hover:underline flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Color
            </button>
        </div>

        <template x-for="(item, index) in variants" :key="index">
            <div class="flex items-center gap-3 mb-3">
                <div class="flex-1">
                    <input type="text" :name="'variants[' + index + '][name]'" x-model="item.name"
                           placeholder="Color name (e.g. Black)"
                           class="w-full px-3 py-2 rounded-lg border border-gray-200 text-sm focus:border-[#B8860B] outline-none">
                </div>
                <div class="w-20 flex items-center gap-2">
                    <input type="color" :name="'variants[' + index + '][color_hex]'" x-model="item.color_hex"
                           class="w-8 h-8 rounded border-0 cursor-pointer">
                    <span class="text-xs text-gray-400 font-mono" x-text="item.color_hex"></span>
                </div>
                <button type="button" @click="removeVariant(index)"
                        class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </template>

        <p x-show="variants.length === 0" class="text-sm text-gray-400 text-center py-4">No color variants added yet</p>
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-3">
        <button type="submit"
                class="px-6 py-2.5 bg-[#B8860B] text-white text-sm font-semibold rounded-lg hover:bg-[#a07509] transition-colors shadow-sm">
            {{ $isEdit ? 'Update Product' : 'Create Product' }}
        </button>
        <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700">Cancel</a>
    </div>
</form>

<script>
function sizesManager() {
    return {
        sizes: @json($isEdit ? $product->sizes->map(fn($s) => ['size' => $s->size, 'stock' => $s->stock_quantity]) : []),
        addSize() { this.sizes.push({ size: '', stock: 10 }); },
        removeSize(index) { this.sizes.splice(index, 1); }
    };
}
function variantsManager() {
    return {
        variants: @json($isEdit ? $product->variants->map(fn($v) => ['name' => $v->name, 'color_hex' => $v->color_hex]) : []),
        addVariant() { this.variants.push({ name: '', color_hex: '#1a1a1a' }); },
        removeVariant(index) { this.variants.splice(index, 1); }
    };
}
</script>
