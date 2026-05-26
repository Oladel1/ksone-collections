@extends('layouts.app')

@section('title', 'KS-ONE Collections — Premium Handcrafted Goods')

@section('content')
<div class="relative min-h-screen overflow-hidden">

    {{-- Warm gradient background --}}
    <div class="absolute inset-0"
         style="background: linear-gradient(180deg, #fafafa 0%, #f7f3eb 40%, #faf6ee 70%, #fafafa 100%);">
    </div>

    {{-- Soft radial glow --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] rounded-full"
         style="background: radial-gradient(ellipse, rgba(184,134,11,0.04) 0%, transparent 70%);">
    </div>

    {{-- Content --}}
    <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-6 py-16">

        {{-- Logo --}}
        <div class="animate-fade-in ad-1 mb-4">
            <img src="{{ asset('images/logo.png') }}"
                 alt="KS-One Logo"
                 class="w-16 h-16 sm:w-20 sm:h-20 object-contain">
        </div>

        {{-- Brand Name --}}
        <h1 class="animate-fade-in-up ad-2
                    font-sans text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-center leading-tight"
            style="letter-spacing: -1.5px;">
            KS-<span class="text-brand-500">ONE</span>
        </h1>

        {{-- Proudly Made in Nigeria Badge --}}
        <div class="animate-fade-in-up ad-3
                     mt-5 inline-flex items-center gap-2 px-5 py-2.5 rounded-full
                     bg-brand-50 border border-brand-200/60">
            <span class="text-sm">🇳🇬</span>
            <span class="font-sans text-xs sm:text-sm font-semibold tracking-[0.2em] uppercase text-brand-700">
                Proudly Made in Nigeria
            </span>
        </div>

        {{-- Tagline --}}
        <p class="animate-fade-in-up ad-4
                  font-sans text-[#555] text-base sm:text-lg max-w-md text-center mt-6 leading-relaxed">
            Premium handcrafted goods for the modern individual.
            <br class="hidden sm:block">
            Explore our collections.
        </p>

        {{-- Decorative Divider --}}
        <div class="animate-fade-in ad-5 flex items-center gap-3 mt-10 mb-12">
            <div class="w-10 h-px bg-gradient-to-r from-transparent to-brand-300/60"></div>
            <div class="w-1.5 h-1.5 rounded-full bg-brand-500/50"></div>
            <div class="w-10 h-px bg-gradient-to-l from-transparent to-brand-300/60"></div>
        </div>

        {{-- Collection Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5 sm:gap-6 max-w-3xl w-full">

            @foreach ($collections as $collection)
                <a href="#"
                   class="animate-scale-in ad-{{ $loop->iteration + 4 }}
                          collection-card group relative flex flex-col items-center gap-4 p-6 sm:p-8
                          rounded-2xl border border-black/[0.06]
                          bg-white/80 backdrop-blur-sm
                          shadow-[0_1px_3px_rgba(0,0,0,0.04)]">

                    {{-- Icon --}}
                    <div class="card-icon w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center
                                rounded-xl bg-[#f5f5f5] border border-black/[0.05]
                                transition-all duration-400">
                        @include('components.icons.' . $collection['icon'])
                    </div>

                    {{-- Label --}}
                    <div class="text-center">
                        <h3 class="card-title font-sans text-base sm:text-lg font-bold text-[#1a1a1a]
                                   transition-colors duration-300">
                            {{ $collection['name'] }}
                        </h3>
                        <p class="font-sans text-xs text-[#888] mt-1 hidden sm:block">
                            {{ $collection['subtitle'] }}
                        </p>
                    </div>

                    {{-- Hover Arrow --}}
                    <div class="card-arrow absolute bottom-3 right-3 opacity-0 translate-x-1 -translate-y-1 transition-all duration-300">
                        <svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/>
                        </svg>
                    </div>
                </a>
            @endforeach

        </div>

        {{-- Footer --}}
        <div class="animate-fade-in ad-9 mt-16 text-center">
            <p class="font-sans text-xs font-medium tracking-widest uppercase text-[#999]">
                © KS-ONE Collections
            </p>
        </div>

    </div>
</div>
@endsection
