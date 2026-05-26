<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController
{
    /**
     * Display the intro / hub page.
     */
    public function intro(): View
    {
        $collections = [
            [
                'name'  => 'Footwear',
                'slug'  => 'footwear',
                'desc'  => 'Premium handcrafted leather shoes',
                'icon'  => 'footwear',
                'color' => 'from-amber-900/20 to-amber-800/10',
            ],
            [
                'name'  => 'Bags',
                'slug'  => 'bags',
                'desc'  => 'Elegant leather bags & accessories',
                'icon'  => 'bags',
                'color' => 'from-stone-800/20 to-stone-700/10',
            ],
            [
                'name'  => 'Belts',
                'slug'  => 'belts',
                'desc'  => 'Handcrafted belts for every occasion',
                'icon'  => 'belts',
                'color' => 'from-yellow-900/20 to-yellow-800/10',
            ],
            [
                'name'  => 'Wallets',
                'slug'  => 'wallets',
                'desc'  => 'Fine leather wallets & cardholders',
                'icon'  => 'wallets',
                'color' => 'from-zinc-800/20 to-zinc-700/10',
            ],
        ];

        return view('intro', compact('collections'));
    }
}
