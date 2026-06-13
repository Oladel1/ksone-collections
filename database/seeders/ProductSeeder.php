<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'slug'        => 'black-covered-mule',
                'name'        => 'Black Covered Mule',
                'category'    => 'mule',
                'description' => 'Premium leather mule with a clean finish for everyday comfort.',
                'price'       => 40000,
                'image'       => 'products/product-01-black-covered-mule-40k.jpeg',
                'badge'       => null,
                'sort_order'  => 1,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color_hex' => '#1a1a1a'],
                    ['name' => 'Brown',  'color_hex' => '#8B4513'],
                    ['name' => 'Tan',    'color_hex' => '#D2B48C'],
                ],
            ],
            [
                'slug'        => 'brown-h-strap-slide',
                'name'        => 'Brown H-Strap Slide',
                'category'    => 'slide',
                'description' => 'Bold suede slide with a distinctive H-strap design.',
                'price'       => 70000,
                'image'       => 'products/product-02-brown-h-slide-70k.jpeg',
                'badge'       => 'popular',
                'sort_order'  => 2,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Brown',  'color_hex' => '#8B4513'],
                    ['name' => 'Black',  'color_hex' => '#1a1a1a'],
                    ['name' => 'Tan',    'color_hex' => '#D2B48C'],
                ],
            ],
            [
                'slug'        => 'brown-classic-loafer',
                'name'        => 'Brown Classic Loafer',
                'category'    => 'loafer',
                'description' => 'Polished brown loafer for smart-casual style and durable wear.',
                'price'       => 85000,
                'image'       => 'products/product-03-brown-loafer-85k.jpeg',
                'badge'       => 'premium',
                'sort_order'  => 3,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Brown',    'color_hex' => '#8B4513'],
                    ['name' => 'Black',    'color_hex' => '#1a1a1a'],
                    ['name' => 'Burgundy', 'color_hex' => '#800020'],
                ],
            ],
            [
                'slug'        => 'black-textured-loafer',
                'name'        => 'Black Textured Loafer',
                'category'    => 'loafer',
                'description' => 'Sleek black loafer with textured detailing and chunky sole.',
                'price'       => 55000,
                'image'       => 'products/product-04-black-loafer-55k.jpeg',
                'badge'       => null,
                'sort_order'  => 4,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color_hex' => '#1a1a1a'],
                    ['name' => 'Brown',  'color_hex' => '#8B4513'],
                    ['name' => 'Navy',   'color_hex' => '#1B2A4A'],
                ],
            ],
            [
                'slug'        => 'black-padded-slide',
                'name'        => 'Black Padded Slide',
                'category'    => 'slide',
                'description' => 'Comfortable padded slide built for daily wear and easy styling.',
                'price'       => 25000,
                'image'       => 'products/product-05-black-padded-slide-25k.jpeg',
                'badge'       => null,
                'sort_order'  => 5,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color_hex' => '#1a1a1a'],
                    ['name' => 'Brown',  'color_hex' => '#8B4513'],
                    ['name' => 'Olive',  'color_hex' => '#556B2F'],
                ],
            ],
            [
                'slug'        => 'buckle-strap-loafer',
                'name'        => 'Buckle Strap Loafer',
                'category'    => 'loafer',
                'description' => 'Refined buckle-strap loafer with a premium look for class and comfort.',
                'price'       => 25000,
                'image'       => 'products/product-06-buckle-loafer-25k.jpeg',
                'badge'       => null,
                'sort_order'  => 6,
                'sizes'       => [39, 40, 41, 42, 43, 44, 45],
                'variants'    => [
                    ['name' => 'Black',  'color_hex' => '#1a1a1a'],
                    ['name' => 'Brown',  'color_hex' => '#8B4513'],
                    ['name' => 'Tan',    'color_hex' => '#D2B48C'],
                ],
            ],
        ];

        foreach ($products as $data) {
            $sizes    = $data['sizes'];
            $variants = $data['variants'];
            unset($data['sizes'], $data['variants']);

            $product = Product::firstOrCreate(['slug' => $data['slug']], $data);

            // Sizes with default stock
            foreach ($sizes as $size) {
                ProductSize::firstOrCreate(
                    ['product_id' => $product->id, 'size' => $size],
                    ['stock_quantity' => 10] // default stock
                );
            }

            // Variants
            foreach ($variants as $i => $variant) {
                ProductVariant::firstOrCreate(
                    ['product_id' => $product->id, 'name' => $variant['name']],
                    ['color_hex' => $variant['color_hex'], 'sort_order' => $i]
                );
            }
        }
    }
}
