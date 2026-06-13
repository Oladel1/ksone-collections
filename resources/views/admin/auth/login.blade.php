<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — KS-One</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css'])
</head>
<body class="h-full bg-[#0f0f0f] font-sans antialiased">

    <div class="min-h-full flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-sm">

            {{-- Logo --}}
            <div class="text-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="KS-One" class="w-14 h-14 mx-auto mb-4 invert">
                <h1 class="text-2xl font-extrabold text-white tracking-tight">
                    KS-<span class="text-[#B8860B]">ONE</span>
                    <span class="text-white/40 text-sm font-normal ml-1">Admin</span>
                </h1>
                <p class="text-white/40 text-sm mt-2">Sign in to manage your store</p>
            </div>

            {{-- Login Card --}}
            <div class="bg-white/[0.05] backdrop-blur border border-white/[0.08] rounded-2xl p-6 sm:p-8">

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="mb-5 px-4 py-3 rounded-lg bg-red-500/10 border border-red-500/20 text-sm text-red-400">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-5 px-4 py-3 rounded-lg bg-red-500/10 border border-red-500/20 text-sm text-red-400">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="block text-xs font-semibold text-white/60 mb-1.5 uppercase tracking-wider">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.06] border border-white/[0.1]
                                      text-white text-sm placeholder-white/30
                                      focus:border-[#B8860B]/50 focus:ring-1 focus:ring-[#B8860B]/30
                                      outline-none transition-all duration-200"
                               placeholder="admin@example.com" required autofocus>
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold text-white/60 mb-1.5 uppercase tracking-wider">Password</label>
                        <input type="password" id="password" name="password"
                               class="w-full px-4 py-3 rounded-xl bg-white/[0.06] border border-white/[0.1]
                                      text-white text-sm placeholder-white/30
                                      focus:border-[#B8860B]/50 focus:ring-1 focus:ring-[#B8860B]/30
                                      outline-none transition-all duration-200"
                               placeholder="••••••••" required>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember"
                                   class="w-4 h-4 rounded border-white/20 bg-white/[0.06] text-[#B8860B]
                                          focus:ring-[#B8860B]/30 focus:ring-offset-0">
                            <span class="text-sm text-white/50">Remember me</span>
                        </label>
                    </div>

                    <button type="submit"
                            class="w-full py-3.5 rounded-xl bg-[#B8860B] text-white text-sm font-semibold tracking-wider uppercase
                                   hover:bg-[#a07509] transition-all duration-300 shadow-lg shadow-[#B8860B]/20">
                        Sign In
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <p class="text-center text-xs text-white/20 mt-6">
                © {{ date('Y') }} KS-One Collections
            </p>
        </div>
    </div>

</body>
</html>
