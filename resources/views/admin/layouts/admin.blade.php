<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — KS-One Admin</title>

    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body class="h-full bg-gray-50 font-sans text-gray-900 antialiased">

    <div class="flex h-full" x-data="{ sidebarOpen: false }">

        {{-- ═══ SIDEBAR ═══ --}}
        {{-- Mobile overlay --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black/50 lg:hidden" @click="sidebarOpen = false"></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0f0f0f] transform transition-transform duration-300 lg:translate-x-0 lg:static lg:z-auto flex flex-col">

            {{-- Logo --}}
            <div class="flex items-center gap-3 px-6 h-16 border-b border-white/[0.08]">
                <img src="{{ asset('images/logo.png') }}" alt="KS-One" class="w-8 h-8 object-contain invert">
                <span class="text-lg font-extrabold text-white tracking-tight">
                    KS-<span class="text-[#B8860B]">ONE</span>
                    <span class="text-xs font-normal text-white/40 ml-1">Admin</span>
                </span>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                @php
                    $nav = [
                        ['route' => 'admin.dashboard',      'icon' => 'dashboard',  'label' => 'Dashboard',     'perm' => 'view-dashboard'],
                        ['route' => 'admin.products.index',  'icon' => 'products',   'label' => 'Products',      'perm' => 'view-products'],
                        ['route' => 'admin.orders.index',    'icon' => 'orders',     'label' => 'Orders',        'perm' => 'view-orders'],
                        ['route' => 'admin.settings.index',  'icon' => 'settings',   'label' => 'Site Settings', 'perm' => 'manage-settings'],
                        ['route' => 'admin.users.index',     'icon' => 'users',      'label' => 'Users',         'perm' => 'view-users'],
                        ['route' => 'admin.roles.index',     'icon' => 'roles',      'label' => 'Roles',         'perm' => 'view-roles'],
                    ];
                @endphp

                @foreach ($nav as $item)
                    @if (auth()->user()->hasPermission($item['perm']))
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                                  {{ request()->routeIs($item['route'] . '*') ? 'bg-[#B8860B]/20 text-[#B8860B]' : 'text-white/60 hover:bg-white/[0.06] hover:text-white' }}">
                            @include('admin.components.icons.' . $item['icon'])
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- View Site Link --}}
            <div class="px-3 pb-4">
                <a href="{{ route('footwear') }}" target="_blank"
                   class="flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-white/40 hover:text-white/70 hover:bg-white/[0.06] transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                    </svg>
                    View Website
                </a>
            </div>
        </aside>


        {{-- ═══ MAIN ═══ --}}
        <div class="flex-1 flex flex-col min-w-0 lg:ml-0">

            {{-- Top bar --}}
            <header class="sticky top-0 z-30 bg-white border-b border-gray-200/80 h-16 flex items-center justify-between px-4 sm:px-6">
                {{-- Mobile toggle --}}
                <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 -ml-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                </button>

                {{-- Page title --}}
                <h1 class="text-lg font-bold text-gray-900 hidden lg:block">
                    @yield('page-title', 'Dashboard')
                </h1>

                <div class="flex-1 lg:hidden"></div>

                {{-- User menu --}}
                <div class="flex items-center gap-3" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <div class="w-8 h-8 rounded-full bg-[#B8860B]/10 flex items-center justify-center">
                            <span class="text-sm font-bold text-[#B8860B]">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium text-gray-700 hidden sm:block">{{ auth()->user()->name }}</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-4 top-14 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->role->name }}</p>
                        </div>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                Sign Out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                {{-- Flash messages --}}
                @if (session('success'))
                    <div class="mb-4 px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-sm text-green-800 flex items-center gap-2"
                         x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                         x-transition:leave="transition ease-in duration-300"
                         x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd"/></svg>
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
