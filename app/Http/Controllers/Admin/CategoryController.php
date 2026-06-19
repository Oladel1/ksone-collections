<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::withCount('products');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $categories = $query->ordered()->paginate(12)->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
            'icon_image'  => 'nullable|image|max:2048', // 2MB max
        ]);

        // Handle icon image upload
        $iconPath = null;
        if ($request->hasFile('icon_image')) {
            $file = $request->file('icon_image');
            $filename = 'category-' . Str::slug($validated['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $filename);
            $iconPath = 'categories/' . $filename;
        }

        Category::create([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'subtitle'    => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order'  => $validated['sort_order'] ?? 0,
            'is_active'   => $request->boolean('is_active', true),
            'icon_image'  => $iconPath,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string|max:2000',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
            'icon_image'  => 'nullable|image|max:2048',
        ]);

        // Handle icon image upload
        if ($request->hasFile('icon_image')) {
            $file = $request->file('icon_image');
            $filename = 'category-' . Str::slug($validated['name']) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $filename);
            $category->icon_image = 'categories/' . $filename;
        }

        $category->update([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'subtitle'    => $validated['subtitle'] ?? null,
            'description' => $validated['description'] ?? null,
            'sort_order'  => $validated['sort_order'] ?? 0,
            'is_active'   => $request->boolean('is_active', true),
            'icon_image'  => $category->icon_image,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        // Check if category has products
        if ($category->products()->count() > 0) {
            return back()->with('error', 'Cannot delete a category that still has products. Move or delete the products first.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }

    /**
     * Quick toggle category active status.
     */
    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        return back()->with('success', 'Category status updated.');
    }
}
