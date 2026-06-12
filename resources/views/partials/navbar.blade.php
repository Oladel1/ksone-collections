{{-- Sticky Navigation --}}
<nav id="navbar" class="navbar fixed top-0 left-0 right-0 z-40
                         bg-white/92 backdrop-blur-md border-b border-black/[0.06]
                         transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">

        {{-- Logo --}}
        <a href="#home" class="flex items-center gap-3 group">
            <img src="{{ asset('images/logo.png') }}" alt="KS-One" class="w-9 h-9 object-contain">
            <span class="text-xl font-extrabold tracking-tight">
                KS-<span class="text-brand-500">ONE</span>
            </span>
        </a>

        {{-- Desktop Nav --}}
        <div class="hidden md:flex items-center gap-10">
            <a href="#home"    class="nav-link text-sm font-semibold tracking-widest uppercase text-[#555] hover:text-brand-500 transition-colors">Home</a>
            <a href="#shop"    class="nav-link text-sm font-semibold tracking-widest uppercase text-[#555] hover:text-brand-500 transition-colors">Shop</a>
            <a href="#about"   class="nav-link text-sm font-semibold tracking-widest uppercase text-[#555] hover:text-brand-500 transition-colors">About</a>
            <a href="#contact" class="nav-link text-sm font-semibold tracking-widest uppercase text-[#555] hover:text-brand-500 transition-colors">Contact</a>
        </div>

        {{-- Mobile Hamburger --}}
        <button id="nav-toggle" class="md:hidden flex flex-col gap-1.5 p-2" aria-label="Toggle menu">
            <span class="hamburger-line block w-6 h-0.5 bg-[#1a1a1a] transition-all duration-300"></span>
            <span class="hamburger-line block w-6 h-0.5 bg-[#1a1a1a] transition-all duration-300"></span>
            <span class="hamburger-line block w-4 h-0.5 bg-[#1a1a1a] transition-all duration-300"></span>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-nav" class="mobile-nav md:hidden hidden bg-white border-t border-black/[0.06]">
        <div class="px-6 py-6 flex flex-col gap-4">
            <a href="#home"    class="mobile-link text-lg font-semibold text-[#1a1a1a] hover:text-brand-500 transition-colors">Home</a>
            <a href="#shop"    class="mobile-link text-lg font-semibold text-[#1a1a1a] hover:text-brand-500 transition-colors">Shop</a>
            <a href="#about"   class="mobile-link text-lg font-semibold text-[#1a1a1a] hover:text-brand-500 transition-colors">About</a>
            <a href="#contact" class="mobile-link text-lg font-semibold text-[#1a1a1a] hover:text-brand-500 transition-colors">Contact</a>
        </div>
    </div>
</nav>
