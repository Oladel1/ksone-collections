<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['sizes', 'variants']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->ordered()->paginate(12)->withQueryString();
        $categories = Product::distinct()->pluck('category');

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'price'       => 'required|integer|min:0',
            'badge'       => 'nullable|string|max:50',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|max:5120', // 5MB max
            'sizes'             => 'nullable|array',
            'sizes.*.size'      => 'required|integer|min:1',
            'sizes.*.stock'     => 'required|integer|min:0',
            'variants'               => 'nullable|array',
            'variants.*.name'        => 'required|string|max:100',
            'variants.*.color_hex'   => 'required|string|max:7',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product-' . Str::slug($validated['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $imagePath = 'products/' . $filename;
        }

        $product = Product::create([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'category'    => strtolower($validated['category']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'badge'       => $validated['badge'] ?: null,
            'sort_order'  => $validated['sort_order'] ?? 0,
            'is_active'   => $request->boolean('is_active', true),
            'image'       => $imagePath,
        ]);

        // Create sizes
        if (!empty($validated['sizes'])) {
            foreach ($validated['sizes'] as $size) {
                $product->sizes()->create([
                    'size'           => $size['size'],
                    'stock_quantity' => $size['stock'],
                ]);
            }
        }

        // Create variants
        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $i => $variant) {
                $product->variants()->create([
                    'name'       => $variant['name'],
                    'color_hex'  => $variant['color_hex'],
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['sizes', 'variants']);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
            'price'       => 'required|integer|min:0',
            'badge'       => 'nullable|string|max:50',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
            'image'       => 'nullable|image|max:5120',
            'sizes'             => 'nullable|array',
            'sizes.*.size'      => 'required|integer|min:1',
            'sizes.*.stock'     => 'required|integer|min:0',
            'variants'               => 'nullable|array',
            'variants.*.name'        => 'required|string|max:100',
            'variants.*.color_hex'   => 'required|string|max:7',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = 'product-' . Str::slug($validated['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $product->image = 'products/' . $filename;
        }

        $product->update([
            'name'        => $validated['name'],
            'category'    => strtolower($validated['category']),
            'description' => $validated['description'] ?? null,
            'price'       => $validated['price'],
            'badge'       => $validated['badge'] ?: null,
            'sort_order'  => $validated['sort_order'] ?? 0,
            'is_active'   => $request->boolean('is_active', true),
            'image'       => $product->image,
        ]);

        // Sync sizes
        $product->sizes()->delete();
        if (!empty($validated['sizes'])) {
            foreach ($validated['sizes'] as $size) {
                $product->sizes()->create([
                    'size'           => $size['size'],
                    'stock_quantity' => $size['stock'],
                ]);
            }
        }

        // Sync variants
        $product->variants()->delete();
        if (!empty($validated['variants'])) {
            foreach ($validated['variants'] as $i => $variant) {
                $product->variants()->create([
                    'name'       => $variant['name'],
                    'color_hex'  => $variant['color_hex'],
                    'sort_order' => $i,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Quick toggle product active status.
     */
    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);

        return back()->with('success', 'Product status updated.');
    }
}
