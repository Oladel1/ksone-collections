<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Intro page — collection icons as navigation links.
     */
    public function intro()
    {
        $collections = [
            [
                'name'     => 'Footwear',
                'subtitle' => 'Premium leather shoes',
                'icon'     => 'footwear',
                'url'      => '#',
            ],
            [
                'name'     => 'Bags',
                'subtitle' => 'Elegant leather bags',
                'icon'     => 'bags',
                'url'      => '#',
            ],
            [
                'name'     => 'Belts',
                'subtitle' => 'Handcrafted belts',
                'icon'     => 'belts',
                'url'      => '#',
            ],
            [
                'name'     => 'Wallets',
                'subtitle' => 'Fine leather wallets',
                'icon'     => 'wallets',
                'url'      => '#',
            ],
        ];

        return view('intro', compact('collections'));
    }
}
