<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Products data — will move to database in future phases.
     */
    private function getProducts(): array
    {
        return [
            [
                'id'          => 1,
                'slug'        => 'black-covered-mule',
                'name'        => 'Black Covered Mule',
                'category'    => 'mule',
                'description' => 'Premium leather mule with a clean finish for everyday comfort.',
                'price'       => 40000,
                'image'       => 'products/product-01-black-covered-mule-40k.jpeg',
                'badge'       => null,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color' => '#1a1a1a'],
                    ['name' => 'Brown',  'color' => '#8B4513'],
                    ['name' => 'Tan',    'color' => '#D2B48C'],
                ],
            ],
            [
                'id'          => 2,
                'slug'        => 'brown-h-strap-slide',
                'name'        => 'Brown H-Strap Slide',
                'category'    => 'slide',
                'description' => 'Bold suede slide with a distinctive H-strap design.',
                'price'       => 70000,
                'image'       => 'products/product-02-brown-h-slide-70k.jpeg',
                'badge'       => 'popular',
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Brown',  'color' => '#8B4513'],
                    ['name' => 'Black',  'color' => '#1a1a1a'],
                    ['name' => 'Tan',    'color' => '#D2B48C'],
                ],
            ],
            [
                'id'          => 3,
                'slug'        => 'brown-classic-loafer',
                'name'        => 'Brown Classic Loafer',
                'category'    => 'loafer',
                'description' => 'Polished brown loafer for smart-casual style and durable wear.',
                'price'       => 85000,
                'image'       => 'products/product-03-brown-loafer-85k.jpeg',
                'badge'       => 'premium',
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Brown',    'color' => '#8B4513'],
                    ['name' => 'Black',    'color' => '#1a1a1a'],
                    ['name' => 'Burgundy', 'color' => '#800020'],
                ],
            ],
            [
                'id'          => 4,
                'slug'        => 'black-textured-loafer',
                'name'        => 'Black Textured Loafer',
                'category'    => 'loafer',
                'description' => 'Sleek black loafer with textured detailing and chunky sole.',
                'price'       => 55000,
                'image'       => 'products/product-04-black-loafer-55k.jpeg',
                'badge'       => null,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color' => '#1a1a1a'],
                    ['name' => 'Brown',  'color' => '#8B4513'],
                    ['name' => 'Navy',   'color' => '#1B2A4A'],
                ],
            ],
            [
                'id'          => 5,
                'slug'        => 'black-padded-slide',
                'name'        => 'Black Padded Slide',
                'category'    => 'slide',
                'description' => 'Comfortable padded slide built for daily wear and easy styling.',
                'price'       => 25000,
                'image'       => 'products/product-05-black-padded-slide-25k.jpeg',
                'badge'       => null,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color' => '#1a1a1a'],
                    ['name' => 'Brown',  'color' => '#8B4513'],
                    ['name' => 'Olive',  'color' => '#556B2F'],
                ],
            ],
            [
                'id'          => 6,
                'slug'        => 'buckle-strap-loafer',
                'name'        => 'Buckle Strap Loafer',
                'category'    => 'loafer',
                'description' => 'Refined buckle-strap loafer with a premium look for class and comfort.',
                'price'       => 25000,
                'image'       => 'products/product-06-buckle-loafer-25k.jpeg',
                'badge'       => null,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color' => '#1a1a1a'],
                    ['name' => 'Brown',  'color' => '#8B4513'],
                    ['name' => 'Tan',    'color' => '#D2B48C'],
                ],
            ],
        ];
    }

    /**
     * Phase 1: Intro page with collection icons.
     */
    public function intro()
    {
        $collections = [
            ['name' => 'Footwear', 'subtitle' => 'Premium leather shoes', 'icon' => 'footwear', 'url' => '#'],
            ['name' => 'Bags',     'subtitle' => 'Elegant leather bags',  'icon' => 'bags',     'url' => '#'],
            ['name' => 'Belts',    'subtitle' => 'Handcrafted belts',     'icon' => 'belts',    'url' => '#'],
            ['name' => 'Wallets',  'subtitle' => 'Fine leather wallets',  'icon' => 'wallets',  'url' => '#'],
        ];

        return view('intro', compact('collections'));
    }

    /**
     * Phase 2: One-page footwear showcase.
     */
    public function footwear()
    {
        $products   = $this->getProducts();
        $categories = ['all', 'mule', 'slide', 'loafer'];

        $whatsapp = '2347035515612';

        return view('footwear', compact('products', 'categories', 'whatsapp'));
    }
}
