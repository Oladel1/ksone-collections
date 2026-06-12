<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="KS-One Footwear — Premium handcrafted leather footwear, proudly made in Nigeria.">

    <title>@yield('title', 'KS-One Footwear — Handcrafted in Nigeria')</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Vite assets --}}
    @vite(['resources/css/footwear.css', 'resources/js/footwear.js'])
</head>
<body class="antialiased font-sans text-[#1a1a1a] bg-[#fafafa]">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Floating WhatsApp Button --}}
    <a href="https://wa.me/{{ $whatsapp ?? '2347035515612' }}?text={{ urlencode('Hello KS-One! I\'d like to place an order.') }}"
       target="_blank" rel="noopener"
       class="whatsapp-float fixed bottom-6 right-6 z-50 w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300"
       aria-label="Chat on WhatsApp">
        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/>
            <path d="M12 0C5.373 0 0 5.373 0 12c0 2.116.549 4.106 1.513 5.834L.055 23.495a.5.5 0 00.606.606l5.66-1.458A11.948 11.948 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22a9.955 9.955 0 01-5.382-1.572l-.386-.229-3.355.864.88-3.355-.229-.386A9.955 9.955 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/>
        </svg>
    </a>

    {{-- Paystack inline script (API key to be provided) --}}
    <script src="https://js.paystack.co/v2/inline.js"></script>

    @stack('scripts')
</body>
</html>
