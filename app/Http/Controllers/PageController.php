<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Phase 1: Intro page with dynamic category icons.
     */
    public function intro()
    {
        $categories = Category::active()->ordered()->withCount('products')->get();

        $collections = $categories->map(function ($cat) {
            return [
                'name'     => $cat->name,
                'subtitle' => $cat->subtitle ?? '',
                'slug'     => $cat->slug,
                'icon_image' => $cat->icon_image,
                'url'      => route('category', $cat->slug),
                'count'    => $cat->products_count,
            ];
        })->toArray();

        return view('intro', compact('collections'));
    }

    /**
     * Dynamic category page — works for Footwear, Bags, Belts, etc.
     */
    public function category(Category $category)
    {
        if (!$category->is_active) {
            abort(404);
        }

        // Products from database belonging to this category
        $dbProducts = Product::where('category_id', $category->id)
            ->active()
            ->ordered()
            ->with(['sizes', 'variants'])
            ->get();

        // Format products for the Blade template
        $products = $dbProducts->map(function ($p) {
            return [
                'id'          => $p->id,
                'slug'        => $p->slug,
                'name'        => $p->name,
                'type'        => $p->type,
                'description' => $p->description,
                'price'       => $p->price,
                'image'       => $p->image,
                'badge'       => $p->badge,
                'sizes'       => $p->sizes->pluck('size')->toArray(),
                'variants'    => $p->variants->map(fn ($v) => [
                    'name'  => $v->name,
                    'color' => $v->color_hex,
                ])->toArray(),
            ];
        })->toArray();

        $types = array_merge(['all'], $dbProducts->pluck('type')->unique()->values()->toArray());

        // Site settings
        $settings = SiteSetting::allGrouped();
        $s = [];
        foreach ($settings as $group => $items) {
            foreach ($items as $item) {
                $s[$item->key] = $item->value;
            }
        }

        $whatsapp = $s['whatsapp_number'] ?? '2347035515612';

        return view('category', compact('category', 'products', 'types', 'whatsapp', 's'));
    }
}
