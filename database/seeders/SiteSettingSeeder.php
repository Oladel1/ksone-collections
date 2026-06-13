<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // ── Hero Section ─────────────────────
            ['key' => 'hero_badge',         'value' => 'Proudly Made in Nigeria',               'group' => 'hero',    'type' => 'text',     'label' => 'Badge Text',           'sort_order' => 1],
            ['key' => 'hero_headline',      'value' => "Step Into\nHandcrafted\nExcellence",    'group' => 'hero',    'type' => 'textarea', 'label' => 'Headline (line breaks = new line)', 'sort_order' => 2],
            ['key' => 'hero_subtitle',      'value' => 'Premium leather footwear designed for comfort, built with pride. Every pair tells a story of Nigerian craftsmanship.', 'group' => 'hero', 'type' => 'textarea', 'label' => 'Subtitle', 'sort_order' => 3],
            ['key' => 'hero_cta_shop',      'value' => 'Shop Collection',                       'group' => 'hero',    'type' => 'text',     'label' => 'Shop Button Text',     'sort_order' => 4],
            ['key' => 'hero_cta_whatsapp',  'value' => 'Order on WhatsApp',                     'group' => 'hero',    'type' => 'text',     'label' => 'WhatsApp Button Text', 'sort_order' => 5],

            // ── Shop Section ─────────────────────
            ['key' => 'shop_label',         'value' => 'Collection',                             'group' => 'shop',    'type' => 'text',     'label' => 'Section Label',        'sort_order' => 1],
            ['key' => 'shop_title',         'value' => 'Our Footwear',                           'group' => 'shop',    'type' => 'text',     'label' => 'Section Title',        'sort_order' => 2],
            ['key' => 'shop_subtitle',      'value' => 'Each pair is handcrafted with premium materials for comfort and style.', 'group' => 'shop', 'type' => 'textarea', 'label' => 'Section Subtitle', 'sort_order' => 3],

            // ── About Section ────────────────────
            ['key' => 'about_label',        'value' => 'Our Story',                              'group' => 'about',   'type' => 'text',     'label' => 'Section Label',        'sort_order' => 1],
            ['key' => 'about_title',        'value' => "Crafted With Pride,\nWorn With Confidence", 'group' => 'about', 'type' => 'textarea', 'label' => 'Section Title',     'sort_order' => 2],
            ['key' => 'about_text_1',       'value' => 'KS-one Footwear is a proudly Nigerian brand dedicated to crafting premium leather shoes that combine style, comfort, and durability.', 'group' => 'about', 'type' => 'textarea', 'label' => 'Paragraph 1', 'sort_order' => 3],
            ['key' => 'about_text_2',       'value' => 'Every pair is meticulously handcrafted by skilled artisans using the finest local materials — because we believe world-class footwear should come from home.', 'group' => 'about', 'type' => 'textarea', 'label' => 'Paragraph 2', 'sort_order' => 4],
            ['key' => 'about_image',        'value' => 'products/product-01-black-covered-mule-40k.jpeg', 'group' => 'about', 'type' => 'image', 'label' => 'About Image', 'sort_order' => 5],

            // Feature cards
            ['key' => 'about_feature_1_emoji', 'value' => '🇳🇬',                  'group' => 'about', 'type' => 'text', 'label' => 'Feature 1 Emoji',       'sort_order' => 6],
            ['key' => 'about_feature_1_title', 'value' => 'Made in Nigeria',       'group' => 'about', 'type' => 'text', 'label' => 'Feature 1 Title',       'sort_order' => 7],
            ['key' => 'about_feature_1_text',  'value' => '100% locally crafted with pride', 'group' => 'about', 'type' => 'text', 'label' => 'Feature 1 Text', 'sort_order' => 8],

            ['key' => 'about_feature_2_emoji', 'value' => '✋',                    'group' => 'about', 'type' => 'text', 'label' => 'Feature 2 Emoji',       'sort_order' => 9],
            ['key' => 'about_feature_2_title', 'value' => 'Handcrafted',           'group' => 'about', 'type' => 'text', 'label' => 'Feature 2 Title',       'sort_order' => 10],
            ['key' => 'about_feature_2_text',  'value' => 'Every pair made by skilled artisans', 'group' => 'about', 'type' => 'text', 'label' => 'Feature 2 Text', 'sort_order' => 11],

            ['key' => 'about_feature_3_emoji', 'value' => '🪡',                    'group' => 'about', 'type' => 'text', 'label' => 'Feature 3 Emoji',       'sort_order' => 12],
            ['key' => 'about_feature_3_title', 'value' => 'Premium Leather',       'group' => 'about', 'type' => 'text', 'label' => 'Feature 3 Title',       'sort_order' => 13],
            ['key' => 'about_feature_3_text',  'value' => 'Only the finest materials used', 'group' => 'about', 'type' => 'text', 'label' => 'Feature 3 Text', 'sort_order' => 14],

            ['key' => 'about_feature_4_emoji', 'value' => '🚚',                    'group' => 'about', 'type' => 'text', 'label' => 'Feature 4 Emoji',       'sort_order' => 15],
            ['key' => 'about_feature_4_title', 'value' => 'Nationwide Delivery',   'group' => 'about', 'type' => 'text', 'label' => 'Feature 4 Title',       'sort_order' => 16],
            ['key' => 'about_feature_4_text',  'value' => 'We deliver across Nigeria', 'group' => 'about', 'type' => 'text', 'label' => 'Feature 4 Text',    'sort_order' => 17],

            // ── Contact Section ──────────────────
            ['key' => 'contact_label',      'value' => 'Get In Touch',                           'group' => 'contact', 'type' => 'text',     'label' => 'Section Label',        'sort_order' => 1],
            ['key' => 'contact_title',      'value' => 'Contact Us',                             'group' => 'contact', 'type' => 'text',     'label' => 'Section Title',        'sort_order' => 2],
            ['key' => 'contact_subtitle',   'value' => 'Have a question or want to place an order? Reach out through any of these channels.', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Section Subtitle', 'sort_order' => 3],
            ['key' => 'whatsapp_number',    'value' => '2347035515612',                          'group' => 'contact', 'type' => 'text',     'label' => 'WhatsApp Number (with country code)', 'sort_order' => 4],
            ['key' => 'phone_display',      'value' => '07035515612',                            'group' => 'contact', 'type' => 'text',     'label' => 'Phone Display',        'sort_order' => 5],
            ['key' => 'instagram_handle',   'value' => 'ksonefootwear',                          'group' => 'contact', 'type' => 'text',     'label' => 'Instagram Handle',     'sort_order' => 6],
            ['key' => 'tiktok_handle',      'value' => 'ks1collections',                         'group' => 'contact', 'type' => 'text',     'label' => 'TikTok Handle',        'sort_order' => 7],

            // ── Marquee Strip ────────────────────
            ['key' => 'marquee_items',      'value' => 'HANDCRAFTED,MADE IN NIGERIA,PREMIUM LEATHER,FREE SIZING,WHATSAPP ORDERS,NATIONWIDE DELIVERY', 'group' => 'marquee', 'type' => 'textarea', 'label' => 'Marquee Items (comma-separated)', 'sort_order' => 1],

            // ── Footer ───────────────────────────
            ['key' => 'footer_description', 'value' => 'Premium handcrafted footwear, proudly made in Nigeria. Every pair is a statement of quality and craftsmanship.', 'group' => 'footer', 'type' => 'textarea', 'label' => 'Brand Description', 'sort_order' => 1],
            ['key' => 'footer_copyright',   'value' => 'KS-One Footwear. All rights reserved. Proudly Made in Nigeria 🇳🇬', 'group' => 'footer', 'type' => 'text', 'label' => 'Copyright Text', 'sort_order' => 2],
        ];

        foreach ($settings as $s) {
            SiteSetting::firstOrCreate(['key' => $s['key']], $s);
        }
    }
}
