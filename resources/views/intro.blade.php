@extends('layouts.app')

@section('title', 'KS One Collections — Premium Handcrafted Products')

@section('content')
<div class="relative min-h-screen bg-charcoal-950 text-white overflow-hidden">

    {{-- ── Background Texture ─────────────────────────────────────── --}}
    <div class="absolute inset-0 opacity-[0.03]"
         style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    {{-- ── Subtle Gold Gradient Glow ──────────────────────────────── --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[600px] bg-gradient-radial from-gold-500/[0.06] to-transparent rounded-full blur-3xl"></div>

    {{-- ── Content ────────────────────────────────────────────────── --}}
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-6 py-16">

        {{-- Brand Mark --}}
        <div class="animate-fade-in mb-6">
            <div class="w-20 h-20 mx-auto border-2 border-gold-400/30 rounded-full flex items-center justify-center">
                <span class="text-3xl font-serif font-bold text-gold-400 tracking-tight">K</span>
            </div>
        </div>

        {{-- Brand Name --}}
        <h1 class="animate-fade-in-up opacity-0 animation-delay-100
                    font-serif text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight text-center leading-tight">
            KS <span class="text-gold-400">One</span>
        </h1>

        <p class="animate-fade-in-up opacity-0 animation-delay-200
                  font-sans text-sm sm:text-base tracking-[0.35em] uppercase text-charcoal-400 mt-3 text-center">
            Collections
        </p>

        {{-- Tagline --}}
        <p class="animate-fade-in-up opacity-0 animation-delay-300
                  font-sans text-charcoal-300 text-base sm:text-lg max-w-md text-center mt-6 leading-relaxed">
            Premium handcrafted goods, proudly made in Nigeria.
            <br class="hidden sm:block">
            Explore our collections.
        </p>

        {{-- Decorative Divider --}}
        <div class="animate-fade-in opacity-0 animation-delay-400 flex items-center gap-4 mt-10 mb-12">
            <div class="w-12 h-px bg-gradient-to-r from-transparent to-gold-400/40"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-gold-400/60"></div>
            <div class="w-12 h-px bg-gradient-to-l from-transparent to-gold-400/40"></div>
        </div>

        {{-- ── Collection Icons Grid ──────────────────────────────── --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8 max-w-3xl w-full">

            @foreach ($collections as $i => $collection)
            <a href="#"
               class="animate-scale-in opacity-0 animation-delay-{{ ($i + 5) * 100 }}
                      group relative flex flex-col items-center gap-4 p-6 sm:p-8
                      rounded-2xl border border-white/[0.06]
                      bg-gradient-to-b {{ $collection['color'] }}
                      backdrop-blur-sm
                      transition-all duration-500 ease-out
                      hover:border-gold-400/30 hover:bg-white/[0.04]
                      hover:shadow-[0_0_40px_rgba(212,149,43,0.08)]
                      hover:-translate-y-1"
            >
                {{-- Icon --}}
                <div class="w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center
                            rounded-xl bg-white/[0.04] border border-white/[0.06]
                            group-hover:border-gold-400/20 group-hover:bg-gold-400/[0.06]
                            transition-all duration-500">
                    @include('components.icons.' . $collection['icon'])
                </div>

                {{-- Label --}}
                <div class="text-center">
                    <h3 class="font-serif text-base sm:text-lg font-semibold text-white/90
                               group-hover:text-gold-300 transition-colors duration-300">
                        {{ $collection['name'] }}
                    </h3>
                    <p class="font-sans text-xs text-charcoal-400 mt-1 hidden sm:block">
                        {{ $collection['desc'] }}
                    </p>
                </div>

                {{-- Hover Arrow --}}
                <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <svg class="w-4 h-4 text-gold-400/60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25" />
                    </svg>
                </div>
            </a>
            @endforeach

        </div>

        {{-- Footer Tag --}}
        <div class="animate-fade-in opacity-0 animation-delay-800 mt-16 text-center">
            <p class="font-sans text-xs tracking-widest uppercase text-charcoal-500">
                🇳🇬 Proudly Made in Nigeria
            </p>
        </div>

    </div>
</div>
@endsection
