@extends('layouts.footwear')

@section('title', 'KS-One Footwear — Handcrafted in Nigeria')

@section('content')

{{-- ═══════ HERO SECTION ═══════ --}}
<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-16">

    {{-- Background gradient --}}
    <div class="absolute inset-0" style="background: linear-gradient(180deg, #fafafa 0%, #f7f3eb 40%, #faf6ee 70%, #fafafa 100%);"></div>

    {{-- Radial glow --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[1000px] h-[600px] rounded-full"
         style="background: radial-gradient(ellipse, rgba(184,134,11,0.05) 0%, transparent 70%);"></div>

    <div class="relative z-10 text-center px-6 max-w-3xl mx-auto">

        {{-- Badge --}}
        <div class="animate-fade-in-up ad-1 inline-flex items-center gap-2 px-6 py-3 rounded-full
                     bg-brand-50 border border-brand-200/60 mb-8">
            <span class="text-base">🇳🇬</span>
            <span class="text-xs sm:text-sm font-semibold tracking-[0.2em] uppercase text-brand-700">
                Proudly Made in Nigeria
            </span>
        </div>

        {{-- Headline --}}
        <h1 class="animate-fade-in-up ad-2
                    text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black leading-[1.1] tracking-tight"
            style="letter-spacing: -2px;">
            Step Into<br>
            <span class="text-brand-500">Handcrafted</span><br>
            Excellence
        </h1>

        {{-- Subtitle --}}
        <p class="animate-fade-in-up ad-3
                  text-[#555] text-base sm:text-lg max-w-lg mx-auto mt-7 leading-relaxed">
            Premium leather footwear designed for comfort, built with pride.
            Every pair tells a story of Nigerian craftsmanship.
        </p>

        {{-- CTAs --}}
        <div class="animate-fade-in-up ad-4 flex flex-col sm:flex-row items-center justify-center gap-4 mt-10">
            <a href="#shop"
               class="px-8 py-4 bg-[#1a1a1a] text-white text-sm font-semibold tracking-wider uppercase
                      rounded-full hover:bg-black transition-colors duration-300 shadow-lg hover:shadow-xl">
                Shop Collection
            </a>
            <a href="https://wa.me/{{ $whatsapp }}?text={{ urlencode('Hello KS-One! I\'d like to place an order.') }}"
               target="_blank"
               class="px-8 py-4 bg-[#25D366] text-white text-sm font-semibold tracking-wider uppercase
                      rounded-full hover:bg-[#20bd5a] transition-colors duration-300 shadow-lg hover:shadow-xl
                      flex items-center gap-2">
                💬 Order on WhatsApp
            </a>
        </div>

    </div>
</section>


{{-- ═══════ MARQUEE STRIP ═══════ --}}
<div class="bg-[#1a1a1a] py-4 overflow-hidden">
    <div class="marquee-track flex items-center gap-12 whitespace-nowrap">
        @for ($i = 0; $i < 3; $i++)
            <span class="flex items-center gap-12">
                <span class="flex items-center gap-2 text-white/80 text-xs sm:text-sm font-bold tracking-[0.25em] uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> HANDCRAFTED
                </span>
                <span class="flex items-center gap-2 text-white/80 text-xs sm:text-sm font-bold tracking-[0.25em] uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> MADE IN NIGERIA
                </span>
                <span class="flex items-center gap-2 text-white/80 text-xs sm:text-sm font-bold tracking-[0.25em] uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> PREMIUM LEATHER
                </span>
                <span class="flex items-center gap-2 text-white/80 text-xs sm:text-sm font-bold tracking-[0.25em] uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> FREE SIZING
                </span>
                <span class="flex items-center gap-2 text-white/80 text-xs sm:text-sm font-bold tracking-[0.25em] uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> WHATSAPP ORDERS
                </span>
                <span class="flex items-center gap-2 text-white/80 text-xs sm:text-sm font-bold tracking-[0.25em] uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500"></span> NATIONWIDE DELIVERY
                </span>
            </span>
        @endfor
    </div>
</div>


{{-- ═══════ SHOP SECTION ═══════ --}}
<section id="shop" class="py-20 sm:py-28">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Section Header --}}
        <div class="text-center mb-14 scroll-reveal">
            <span class="text-xs sm:text-sm font-bold tracking-[0.3em] uppercase text-brand-500">Collection</span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-black mt-3 tracking-tight" style="letter-spacing: -1px;">
                Our Footwear
            </h2>
            <p class="text-[#555] text-base sm:text-lg max-w-md mx-auto mt-4 leading-relaxed">
                Each pair is handcrafted with premium materials for comfort and style.
            </p>
        </div>

        {{-- Filter Tabs --}}
        <div class="flex flex-wrap items-center justify-center gap-3 mb-12 scroll-reveal">
            <button data-filter="all"
                    class="filter-btn active px-6 py-2.5 rounded-full text-sm font-semibold tracking-wider uppercase
                           bg-[#1a1a1a] text-white transition-all duration-300">
                All
            </button>
            <button data-filter="mule"
                    class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold tracking-wider uppercase
                           bg-white text-[#555] border border-black/[0.1] hover:border-brand-500 hover:text-brand-500 transition-all duration-300">
                Mules
            </button>
            <button data-filter="slide"
                    class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold tracking-wider uppercase
                           bg-white text-[#555] border border-black/[0.1] hover:border-brand-500 hover:text-brand-500 transition-all duration-300">
                Slides
            </button>
            <button data-filter="loafer"
                    class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold tracking-wider uppercase
                           bg-white text-[#555] border border-black/[0.1] hover:border-brand-500 hover:text-brand-500 transition-all duration-300">
                Loafers
            </button>
        </div>

        {{-- Products Grid --}}
        <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">

            @foreach ($products as $product)
                <div class="product-card scroll-reveal"
                     data-category="{{ $product['category'] }}">

                    <div class="bg-white rounded-2xl border border-black/[0.06] overflow-hidden
                                shadow-[0_1px_3px_rgba(0,0,0,0.04)] hover:shadow-[0_12px_40px_rgba(0,0,0,0.08)]
                                transition-all duration-400 hover:-translate-y-1 group">

                        {{-- Product Image --}}
                        <div class="relative overflow-hidden aspect-[4/5]">
                            <img src="{{ asset('images/' . $product['image']) }}"
                                 alt="{{ $product['name'] }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                 loading="lazy">

                            {{-- Badge --}}
                            @if ($product['badge'])
                                <span class="absolute top-4 left-4 px-3 py-1.5 rounded-md text-xs font-bold tracking-wider uppercase text-white
                                    {{ $product['badge'] === 'popular' ? 'bg-[#1a1a1a]' : 'bg-brand-500' }}">
                                    {{ $product['badge'] }}
                                </span>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="p-5 sm:p-6">

                            {{-- Category --}}
                            <span class="text-xs font-bold tracking-[0.2em] uppercase text-brand-500">
                                {{ $product['category'] }}
                            </span>

                            {{-- Name --}}
                            <h3 class="text-lg font-bold text-[#1a1a1a] mt-1.5">
                                {{ $product['name'] }}
                            </h3>

                            {{-- Description --}}
                            <p class="text-sm text-[#888] mt-1.5 leading-relaxed">
                                {{ $product['description'] }}
                            </p>

                            {{-- Variants (Color) --}}
                            @if (!empty($product['variants']))
                                <div class="mt-4">
                                    <span class="text-xs font-semibold text-[#888] uppercase tracking-wider">
                                        Color: <span class="variant-label text-[#555]" data-product="{{ $product['id'] }}">—</span>
                                    </span>
                                    <div class="flex flex-wrap items-center gap-2 mt-2">
                                        @foreach ($product['variants'] as $variant)
                                            <button class="variant-btn w-8 h-8 rounded-full border-2 border-black/[0.08]
                                                           hover:border-brand-500 transition-all duration-200
                                                           flex items-center justify-center relative
                                                           focus:outline-none"
                                                    data-variant="{{ $variant['name'] }}"
                                                    data-product="{{ $product['id'] }}"
                                                    title="{{ $variant['name'] }}"
                                                    style="background-color: {{ $variant['color'] }};">
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Sizes --}}
                            <div class="mt-3">
                                <span class="text-xs font-semibold text-[#888] uppercase tracking-wider">Size</span>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach ($product['sizes'] as $size)
                                        <button class="size-btn w-9 h-9 rounded-lg border border-black/[0.1] text-xs font-semibold text-[#555]
                                                       hover:border-brand-500 hover:text-brand-500 transition-all duration-200
                                                       flex items-center justify-center"
                                                data-size="{{ $size }}"
                                                data-product="{{ $product['id'] }}">
                                            {{ $size }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Price + Order --}}
                            <div class="flex items-center justify-between mt-5 pt-4 border-t border-black/[0.06]">
                                <span class="text-xl font-black text-[#1a1a1a]">
                                    ₦{{ number_format($product['price']) }}
                                </span>
                                <div class="flex items-center gap-2">
                                    <button class="pay-btn px-5 py-2.5 bg-[#1a1a1a] text-white text-sm font-semibold
                                                   rounded-full hover:bg-black transition-all duration-300
                                                   flex items-center gap-1.5 shadow-sm hover:shadow-md"
                                            data-product-id="{{ $product['id'] }}"
                                            data-product-name="{{ $product['name'] }}"
                                            data-product-price="{{ $product['price'] }}"
                                            data-product-image="{{ asset('images/' . $product['image']) }}">
                                        🛒 Buy Now
                                    </button>
                                    <button class="order-btn w-10 h-10 bg-[#25D366] text-white text-sm
                                                   rounded-full hover:bg-[#20bd5a] transition-all duration-300
                                                   flex items-center justify-center shadow-sm hover:shadow-md
                                                   disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-[#25D366] disabled:shadow-none"
                                            data-product-id="{{ $product['id'] }}"
                                            data-product-name="{{ $product['name'] }}"
                                            data-product-price="{{ $product['price'] }}"
                                            data-whatsapp="{{ $whatsapp }}"
                                            title="Order via WhatsApp"
                                            disabled>
                                        💬
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>


{{-- ═══════ ABOUT SECTION ═══════ --}}
<section id="about" class="py-20 sm:py-28 bg-gradient-to-b from-[#fafafa] via-[#f5f0e6] to-[#fafafa]">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Image --}}
            <div class="scroll-reveal">
                <div class="rounded-2xl overflow-hidden shadow-xl">
                    <img src="{{ asset('images/products/product-01-black-covered-mule-40k.jpeg') }}"
                         alt="KS-One Workshop"
                         class="w-full h-[400px] sm:h-[500px] object-cover">
                </div>
            </div>

            {{-- Text --}}
            <div class="scroll-reveal">
                <span class="text-xs sm:text-sm font-bold tracking-[0.3em] uppercase text-brand-500">Our Story</span>

                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black mt-3 tracking-tight leading-tight" style="letter-spacing: -1px;">
                    Crafted With Pride,<br>Worn With Confidence
                </h2>

                <p class="text-[#555] text-base sm:text-lg mt-6 leading-relaxed">
                    KS-one Footwear is a proudly Nigerian brand dedicated to crafting premium
                    leather shoes that combine style, comfort, and durability.
                </p>
                <p class="text-[#555] text-base sm:text-lg mt-4 leading-relaxed">
                    Every pair is meticulously handcrafted by skilled artisans using the finest
                    local materials — because we believe world-class footwear should come from home.
                </p>

                {{-- Feature Cards --}}
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div class="bg-white rounded-xl p-5 border border-black/[0.06] shadow-sm">
                        <span class="text-2xl">🇳🇬</span>
                        <h4 class="font-bold text-sm mt-2.5">Made in Nigeria</h4>
                        <p class="text-xs text-[#888] mt-1">100% locally crafted with pride</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 border border-black/[0.06] shadow-sm">
                        <span class="text-2xl">✋</span>
                        <h4 class="font-bold text-sm mt-2.5">Handcrafted</h4>
                        <p class="text-xs text-[#888] mt-1">Every pair made by skilled artisans</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 border border-black/[0.06] shadow-sm">
                        <span class="text-2xl">🪡</span>
                        <h4 class="font-bold text-sm mt-2.5">Premium Leather</h4>
                        <p class="text-xs text-[#888] mt-1">Only the finest materials used</p>
                    </div>
                    <div class="bg-white rounded-xl p-5 border border-black/[0.06] shadow-sm">
                        <span class="text-2xl">🚚</span>
                        <h4 class="font-bold text-sm mt-2.5">Nationwide Delivery</h4>
                        <p class="text-xs text-[#888] mt-1">We deliver across Nigeria</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ═══════ CONTACT SECTION ═══════ --}}
<section id="contact" class="py-20 sm:py-28">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="text-center mb-14 scroll-reveal">
            <span class="text-xs sm:text-sm font-bold tracking-[0.3em] uppercase text-brand-500">Get In Touch</span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-black mt-3 tracking-tight" style="letter-spacing: -1px;">
                Contact Us
            </h2>
            <p class="text-[#555] text-base sm:text-lg max-w-md mx-auto mt-4 leading-relaxed">
                Have a question or want to place an order? Reach out through any of these channels.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 max-w-5xl mx-auto">

            {{-- Contact Cards --}}
            <div class="flex flex-col gap-4 scroll-reveal">
                {{-- WhatsApp --}}
                <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                   class="flex items-center gap-4 p-5 bg-white rounded-xl border border-black/[0.06]
                          hover:border-brand-300 hover:shadow-md transition-all duration-300 group">
                    <span class="w-12 h-12 rounded-full bg-[#25D366]/10 flex items-center justify-center text-xl">💬</span>
                    <div>
                        <h4 class="font-bold text-sm group-hover:text-brand-500 transition-colors">WhatsApp</h4>
                        <p class="text-xs text-[#888] mt-0.5">07035515612 — fastest way to order</p>
                    </div>
                </a>

                {{-- Phone --}}
                <a href="tel:+2347035515612"
                   class="flex items-center gap-4 p-5 bg-white rounded-xl border border-black/[0.06]
                          hover:border-brand-300 hover:shadow-md transition-all duration-300 group">
                    <span class="w-12 h-12 rounded-full bg-brand-50 flex items-center justify-center text-xl">📞</span>
                    <div>
                        <h4 class="font-bold text-sm group-hover:text-brand-500 transition-colors">Phone</h4>
                        <p class="text-xs text-[#888] mt-0.5">07035515612</p>
                    </div>
                </a>

                {{-- Instagram --}}
                <a href="https://instagram.com/ksonefootwear" target="_blank"
                   class="flex items-center gap-4 p-5 bg-white rounded-xl border border-black/[0.06]
                          hover:border-brand-300 hover:shadow-md transition-all duration-300 group">
                    <span class="w-12 h-12 rounded-full bg-pink-50 flex items-center justify-center text-xl">📸</span>
                    <div>
                        <h4 class="font-bold text-sm group-hover:text-brand-500 transition-colors">Instagram</h4>
                        <p class="text-xs text-[#888] mt-0.5">@ksonefootwear</p>
                    </div>
                </a>

                {{-- TikTok --}}
                <a href="https://tiktok.com/@ks1collections" target="_blank"
                   class="flex items-center gap-4 p-5 bg-white rounded-xl border border-black/[0.06]
                          hover:border-brand-300 hover:shadow-md transition-all duration-300 group">
                    <span class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-xl">🎵</span>
                    <div>
                        <h4 class="font-bold text-sm group-hover:text-brand-500 transition-colors">TikTok</h4>
                        <p class="text-xs text-[#888] mt-0.5">@ks1collections</p>
                    </div>
                </a>
            </div>

            {{-- Message Form --}}
            <div class="scroll-reveal">
                <div class="bg-white rounded-2xl border border-black/[0.06] p-6 sm:p-8 shadow-sm">
                    <h3 class="text-xl font-bold mb-6">Send a Message</h3>

                    <form id="contact-form" class="space-y-5">
                        <div>
                            <label for="form-name" class="block text-sm font-semibold text-[#555] mb-2">Your Name</label>
                            <input type="text" id="form-name" name="name" placeholder="Enter your name"
                                   class="w-full px-4 py-3 rounded-xl border border-black/[0.1] bg-[#fafafa]
                                          text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20
                                          outline-none transition-all duration-200"
                                   required>
                        </div>
                        <div>
                            <label for="form-message" class="block text-sm font-semibold text-[#555] mb-2">Message</label>
                            <textarea id="form-message" name="message" rows="4"
                                      placeholder="What would you like to order or ask?"
                                      class="w-full px-4 py-3 rounded-xl border border-black/[0.1] bg-[#fafafa]
                                             text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20
                                             outline-none transition-all duration-200 resize-vertical"
                                      required></textarea>
                        </div>
                        <button type="submit"
                                class="w-full px-6 py-4 bg-[#25D366] text-white text-sm font-semibold tracking-wider uppercase
                                       rounded-full hover:bg-[#20bd5a] transition-all duration-300 shadow-md hover:shadow-lg
                                       flex items-center justify-center gap-2">
                            💬 Send via WhatsApp
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>



{{-- ═══════ PAYMENT MODAL ═══════ --}}
<div id="payment-modal" class="fixed inset-0 z-[100] hidden">
    {{-- Backdrop --}}
    <div id="modal-backdrop" class="absolute inset-0 bg-black/50 backdrop-blur-sm"></div>

    {{-- Modal Card --}}
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden
                    transform transition-all duration-300 scale-95 opacity-0" id="modal-card">

            {{-- Close button --}}
            <button id="modal-close"
                    class="absolute top-4 right-4 w-8 h-8 rounded-full bg-black/5 hover:bg-black/10
                           flex items-center justify-center text-[#888] hover:text-[#1a1a1a] transition-all z-10">
                ✕
            </button>

            {{-- Product Summary --}}
            <div class="flex items-center gap-4 p-6 bg-[#fafafa] border-b border-black/[0.06]">
                <img id="modal-product-image" src="" alt=""
                     class="w-16 h-16 rounded-xl object-cover border border-black/[0.06]">
                <div>
                    <h3 id="modal-product-name" class="font-bold text-base text-[#1a1a1a]"></h3>
                    <p class="text-sm text-[#888] mt-0.5">
                        Color: <span id="modal-product-variant" class="font-semibold text-[#555]">—</span>
                        · Size: <span id="modal-product-size" class="font-semibold text-[#555]">—</span>
                    </p>
                    <p id="modal-product-price" class="text-lg font-black text-brand-600 mt-1"></p>
                </div>
            </div>

            {{-- Form --}}
            <div class="p-6">
                <h4 class="font-bold text-sm text-[#1a1a1a] mb-4">Complete Your Order</h4>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-[#555] mb-1.5">Full Name</label>
                        <input type="text" id="pay-name" placeholder="Your full name"
                               class="w-full px-4 py-3 rounded-xl border border-black/[0.1] bg-[#fafafa]
                                      text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20
                                      outline-none transition-all duration-200" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[#555] mb-1.5">Email Address</label>
                        <input type="email" id="pay-email" placeholder="your@email.com"
                               class="w-full px-4 py-3 rounded-xl border border-black/[0.1] bg-[#fafafa]
                                      text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20
                                      outline-none transition-all duration-200" required>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-[#555] mb-1.5">Phone Number</label>
                        <input type="tel" id="pay-phone" placeholder="08012345678"
                               class="w-full px-4 py-3 rounded-xl border border-black/[0.1] bg-[#fafafa]
                                      text-sm focus:border-brand-500 focus:ring-1 focus:ring-brand-500/20
                                      outline-none transition-all duration-200" required>
                    </div>
                </div>

                {{-- Pay Button --}}
                <button id="pay-submit"
                        class="w-full mt-6 px-6 py-4 bg-[#1a1a1a] text-white text-sm font-semibold tracking-wider uppercase
                               rounded-full hover:bg-black transition-all duration-300 shadow-lg hover:shadow-xl
                               flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    <span id="pay-btn-text">Pay ₦0</span>
                </button>

                <p class="text-xs text-center text-[#aaa] mt-3">
                    Secured by <strong>Paystack</strong> · Test mode
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ═══════ SUCCESS TOAST ═══════ --}}
<div id="success-toast"
     class="fixed top-6 left-1/2 -translate-x-1/2 z-[110] hidden
            bg-white border border-green-200 shadow-xl rounded-2xl px-6 py-4 max-w-sm w-full mx-4
            transform -translate-y-4 opacity-0 transition-all duration-300">
    <div class="flex items-start gap-3">
        <span class="text-2xl">✅</span>
        <div>
            <h4 class="font-bold text-sm text-[#1a1a1a]">Payment Successful!</h4>
            <p class="text-xs text-[#888] mt-1" id="success-message">
                Your order has been placed. We'll confirm via WhatsApp shortly.
            </p>
            <p class="text-xs text-[#888] mt-0.5">
                Ref: <span id="success-ref" class="font-mono font-semibold text-[#555]"></span>
            </p>
        </div>
    </div>
</div>

@endsection
