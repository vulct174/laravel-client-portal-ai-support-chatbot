<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Client Portal') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="font-sans antialiased text-[#92929f] bg-[#151521]">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="bg-[#151521]/80 backdrop-blur-md border-b border-[#2B2B40] sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center text-white font-bold text-xl">P</div>
                                <span class="text-white text-xl font-bold tracking-wide">PortalPro</span>
                            </a>
                        </div>
                    </div>

                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ms-6 space-x-6">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-white hover:text-[#3699FF] transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-white hover:text-[#3699FF] transition">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-2 bg-[#3699FF] hover:bg-[#0073E9] border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150">
                                        Get Started
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#92929f] hover:text-white hover:bg-[#2B2B40] focus:outline-none transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#1E1E2D] border-b border-[#2B2B40]">
                <div class="pt-2 pb-3 space-y-1 px-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="block py-2 text-base font-medium text-white">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="block py-2 text-base font-medium text-white">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="block py-2 text-base font-medium text-[#3699FF]">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="relative py-20 lg:py-32 overflow-hidden">
            <div class="absolute inset-0 bg-[#151521] -z-10"></div>
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-[#3699FF]/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-72 h-72 bg-[#7239EA]/10 rounded-full blur-3xl"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-white mb-6">
                    Support Made <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#3699FF] to-[#7239EA]">Simple & Smart</span>
                </h1>
                <p class="text-xl text-[#92929f] mb-10 max-w-2xl mx-auto">
                    Experience the future of client support. Streamline your requests, track progress in real-time, and get solutions faster than ever.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-[#3699FF] hover:bg-[#0073E9] md:text-lg md:px-10 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Get Started Free
                    </a>
                    <a href="#features" class="inline-flex items-center justify-center px-8 py-3 border border-[#2B2B40] text-base font-medium rounded-lg text-white bg-[#1E1E2D] hover:bg-[#2B2B40] md:text-lg md:px-10 transition">
                        Learn More
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="py-20 bg-[#1E1E2D] border-y border-[#2B2B40]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-base text-[#3699FF] font-semibold tracking-wide uppercase">Features</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                        Everything you need to succeed
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Feature 1 -->
                    <div class="relative p-8 bg-[#151521] rounded-2xl border border-[#2B2B40] transition hover:border-[#3699FF]/50 group">
                        <div class="w-12 h-12 bg-[#3699FF]/10 rounded-xl flex items-center justify-center mb-6 text-[#3699FF]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#3699FF] transition-colors">Real-time Updates</h3>
                        <p class="text-[#92929f]">Stay informed with instant notifications on your ticket status. Never miss an update from our support team.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="relative p-8 bg-[#151521] rounded-2xl border border-[#2B2B40] transition hover:border-[#7239EA]/50 group">
                        <div class="w-12 h-12 bg-[#7239EA]/10 rounded-xl flex items-center justify-center mb-6 text-[#7239EA]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#7239EA] transition-colors">Secure & Private</h3>
                        <p class="text-[#92929f]">Your data is protected with enterprise-grade security. We prioritize your privacy and data integrity.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="relative p-8 bg-[#151521] rounded-2xl border border-[#2B2B40] transition hover:border-[#F6C000]/50 group">
                         <div class="w-12 h-12 bg-[#F6C000]/10 rounded-xl flex items-center justify-center mb-6 text-[#F6C000]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-[#F6C000] transition-colors">Fast Resolution</h3>
                        <p class="text-[#92929f]">Our dedicated team and smart tools ensure your issues are resolved quickly and efficiently.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Section -->
        <section class="py-20 bg-[#151521]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-base text-[#3699FF] font-semibold tracking-wide uppercase">Pricing</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">
                        Choose the perfect plan
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6">
                    @foreach($packs as $pack)
                        <div class="flex flex-col p-6 bg-[#1E1E2D] rounded-2xl shadow-lg border border-[#2B2B40] hover:border-[#3699FF] transition duration-300 transform hover:-translate-y-1">
                            <h3 class="text-lg font-semibold text-white">{{ $pack->name }}</h3>
                            <p class="mt-2 text-sm text-[#92929f] min-h-[40px]">{{ $pack->description }}</p>
                            <div class="mt-4 flex items-baseline text-white">
                                <span class="text-3xl font-extrabold tracking-tight">${{ number_format($pack->price, 0) }}</span>
                                <span class="ml-1 text-xl font-semibold text-[#92929f]">/mo</span>
                            </div>
                            <ul role="list" class="mt-6 space-y-4 flex-1">
                                @if($pack->features)
                                    @foreach($pack->features ?? [] as $feature)
                                        <li class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="ml-3 text-sm text-[#92929f]">{{ $feature }}</p>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="mt-8">
                                <a href="{{ route('register') }}" class="block w-full bg-[#3699FF] border border-transparent rounded-lg py-2 text-sm font-semibold text-white text-center hover:bg-[#0073E9] transition">
                                    Choose {{ $pack->name }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-[#1E1E2D] border-t border-[#2B2B40] mt-auto">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                         <span class="text-xl font-bold text-white">PortalPro</span>
                    </div>
                    <p class="text-base text-[#92929f]">
                        &copy; {{ date('Y') }} PortalPro. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
