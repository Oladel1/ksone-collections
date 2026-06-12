{{-- Footer --}}
<footer class="bg-[#1a1a1a] text-white/80 pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">

            {{-- Brand Column --}}
            <div class="md:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="KS-One" class="w-10 h-10 object-contain invert">
                    <span class="text-xl font-extrabold text-white">KS-ONE</span>
                </div>
                <p class="text-sm leading-relaxed text-white/60">
                    Premium handcrafted footwear, proudly made in Nigeria.
                    Every pair is a statement of quality and craftsmanship.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-xs font-bold tracking-widest uppercase text-brand-500 mb-5">Quick Links</h4>
                <ul class="space-y-3">
                    <li><a href="#home" class="text-sm text-white/60 hover:text-white transition-colors">Home</a></li>
                    <li><a href="#shop" class="text-sm text-white/60 hover:text-white transition-colors">Shop</a></li>
                    <li><a href="#about" class="text-sm text-white/60 hover:text-white transition-colors">About</a></li>
                    <li><a href="#contact" class="text-sm text-white/60 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Categories --}}
            <div>
                <h4 class="text-xs font-bold tracking-widest uppercase text-brand-500 mb-5">Categories</h4>
                <ul class="space-y-3">
                    <li><a href="#shop" class="text-sm text-white/60 hover:text-white transition-colors">Slides</a></li>
                    <li><a href="#shop" class="text-sm text-white/60 hover:text-white transition-colors">Mules</a></li>
                    <li><a href="#shop" class="text-sm text-white/60 hover:text-white transition-colors">Loafers</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4 class="text-xs font-bold tracking-widest uppercase text-brand-500 mb-5">Contact</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="https://wa.me/2347035515612" target="_blank" class="text-sm text-white/60 hover:text-white transition-colors flex items-center gap-2">
                            💬 WhatsApp
                        </a>
                    </li>
                    <li>
                        <a href="tel:+2347035515612" class="text-sm text-white/60 hover:text-white transition-colors flex items-center gap-2">
                            📞 07035515612
                        </a>
                    </li>
                    <li>
                        <a href="https://instagram.com/ksonefootwear" target="_blank" class="text-sm text-white/60 hover:text-white transition-colors flex items-center gap-2">
                            📸 @ksonefootwear
                        </a>
                    </li>
                    <li>
                        <a href="https://tiktok.com/@ks1collections" target="_blank" class="text-sm text-white/60 hover:text-white transition-colors flex items-center gap-2">
                            🎵 @ks1collections
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        {{-- Divider + Copyright --}}
        <div class="border-t border-white/10 pt-6 text-center">
            <p class="text-xs text-white/40">
                © {{ date('Y') }} KS-One Footwear. All rights reserved. Proudly Made in Nigeria 🇳🇬
            </p>
        </div>

    </div>
</footer>
