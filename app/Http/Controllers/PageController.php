<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Phase 1: Intro page with collection icons.
     */
    public function intro()
    {
        $collections = [
            ['name' => 'Footwear', 'subtitle' => 'Premium leather shoes', 'icon' => 'footwear', 'url' => route('footwear')],
            ['name' => 'Bags',     'subtitle' => 'Elegant leather bags',  'icon' => 'bags',     'url' => '#'],
            ['name' => 'Belts',    'subtitle' => 'Handcrafted belts',     'icon' => 'belts',    'url' => '#'],
            ['name' => 'Wallets',  'subtitle' => 'Fine leather wallets',  'icon' => 'wallets',  'url' => '#'],
        ];

        return view('intro', compact('collections'));
    }

    /**
     * Phase 2 → 3: One-page footwear showcase — now database-driven.
     */
    public function footwear()
    {
        // Products from database
        $dbProducts = Product::active()->ordered()->with(['sizes', 'variants'])->get();

        // Format products for the Blade template (keep same structure as Phase 2)
        $products = $dbProducts->map(function ($p) {
            return [
                'id'          => $p->id,
                'slug'        => $p->slug,
                'name'        => $p->name,
                'category'    => $p->category,
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

        $categories = array_merge(['all'], $dbProducts->pluck('category')->unique()->values()->toArray());

        // Site settings
        $settings = SiteSetting::allGrouped();
        $s = [];
        foreach ($settings as $group => $items) {
            foreach ($items as $item) {
                $s[$item->key] = $item->value;
            }
        }

        $whatsapp = $s['whatsapp_number'] ?? '2347035515612';

        return view('footwear', compact('products', 'categories', 'whatsapp', 's'));
    }
}
