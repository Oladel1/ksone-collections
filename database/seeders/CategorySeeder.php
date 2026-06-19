<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'slug'        => 'footwear',
                'name'        => 'Footwear',
                'subtitle'    => 'Premium leather shoes',
                'description' => 'Premium leather footwear designed for comfort, built with pride. Every pair tells a story of Nigerian craftsmanship.',
                'sort_order'  => 1,
            ],
            [
                'slug'        => 'bags',
                'name'        => 'Bags',
                'subtitle'    => 'Elegant leather bags',
                'description' => 'Handcrafted leather bags that combine elegance with everyday functionality.',
                'sort_order'  => 2,
            ],
            [
                'slug'        => 'belts',
                'name'        => 'Belts',
                'subtitle'    => 'Handcrafted belts',
                'description' => 'Fine leather belts crafted with attention to detail and lasting quality.',
                'sort_order'  => 3,
            ],
            [
                'slug'        => 'wallets',
                'name'        => 'Wallets',
                'subtitle'    => 'Fine leather wallets',
                'description' => 'Compact, elegant wallets made from premium Nigerian leather.',
                'sort_order'  => 4,
            ],
        ];

        foreach ($categories as $data) {
            Category::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
