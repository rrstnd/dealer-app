<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Portal') - SUJA MOBILINDO</title>

    {{-- GOOGLE FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
    </style>
</head>

<body class="bg-zinc-100 text-zinc-800 antialiased selection:bg-[#881337] selection:text-white" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex relative overflow-x-hidden">

        {{-- MOBILE / TABLET OVERLAY BACKDROP --}}
        <div x-show="sidebarOpen"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-zinc-950/80 backdrop-blur-xs z-40 lg:hidden"
             style="display: none;">
        </div>

        {{-- SIDEBAR (RESPONSIVE: SLIDE-OVER ON MOBILE/TABLET, PERMANENT ON DESKTOP) --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-50 w-64 min-w-64 bg-zinc-950 text-zinc-300 flex flex-col border-r border-zinc-800/80 transition-transform duration-300 ease-in-out lg:static lg:z-auto">

            {{-- LOGO BRANDING --}}
            <div class="h-20 flex items-center justify-between px-6 border-b border-zinc-800/80 bg-black/40">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="SUJA MOBILINDO"
                         class="w-10 h-10 rounded-full object-cover shadow-sm shrink-0 border border-zinc-800 group-hover:scale-105 transition duration-200">
                    <div>
                        <span class="text-sm font-black tracking-[0.2em] text-white uppercase block leading-none">SUJA <span class="text-zinc-400 font-light">MOBILINDO</span></span>
                        <span class="block text-[9px] font-bold uppercase tracking-[0.2em] text-rose-500 mt-1">PORTAL ADMIN</span>
                    </div>
                </a>

                {{-- MOBILE CLOSE BUTTON --}}
                <button @click="sidebarOpen = false" class="lg:hidden text-zinc-400 hover:text-white p-1 rounded-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- NAVIGATION --}}
            <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">

                <div class="px-3 pb-2 text-[10px] uppercase font-bold tracking-[0.2em] text-zinc-500">
                    Menu Utama
                </div>

                {{-- DASHBOARD --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 text-xs tracking-wider transition border-l-2 {{ request()->routeIs('admin.dashboard*') ? 'bg-zinc-900 text-white border-[#881337] font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/60 border-transparent font-medium' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.dashboard*') ? 'text-rose-500' : 'text-zinc-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                {{-- INVENTORY / VEHICLES --}}
                <a href="{{ route('admin.vehicles.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 text-xs tracking-wider transition border-l-2 {{ request()->routeIs('admin.vehicles*') ? 'bg-zinc-900 text-white border-[#881337] font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/60 border-transparent font-medium' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.vehicles*') ? 'text-rose-500' : 'text-zinc-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.4-1.7-1.1-2.2l-3.4-2.3c-.5-.4-1.2-.6-1.9-.6H7.4c-.7 0-1.4.2-1.9.6L2.1 10.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2m15 0a3 3 0 11-6 0m6 0a3 3 0 10-6 0M4 17a3 3 0 11-6 0m6 0a3 3 0 10-6 0M5 9l2-4h10l2 4"/>
                    </svg>
                    <span>Upload Kendaraan</span>
                </a>

                {{-- PENJUALAN / SALES (IN OUT KENDARAAN) --}}
                <a href="{{ route('admin.sales.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 text-xs tracking-wider transition border-l-2 {{ request()->routeIs('admin.sales*') ? 'bg-zinc-900 text-white border-[#881337] font-bold' : 'text-zinc-400 hover:text-white hover:bg-zinc-900/60 border-transparent font-medium' }}">
                    <svg class="w-4 h-4 {{ request()->routeIs('admin.sales*') ? 'text-rose-500' : 'text-zinc-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                    <span>In Out Kendaraan</span>
                </a>

                <div class="pt-6">
                    <div class="px-3 pb-2 text-[10px] uppercase font-bold tracking-[0.2em] text-zinc-500">
                        Pintasan Eksternal
                    </div>

                    <a href="{{ route('home') }}" target="_blank"
                       class="flex items-center justify-between px-3.5 py-2.5 text-xs font-semibold text-zinc-400 hover:text-white hover:bg-zinc-900/60 transition border border-zinc-800/80 group">
                        <span class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Lihat Web Showroom</span>
                        </span>
                        <svg class="w-3.5 h-3.5 text-zinc-500 group-hover:text-rose-500 group-hover:translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>

            </nav>

            {{-- USER PROFILE AT BOTTOM --}}
            <div class="border-t border-zinc-800/80 p-3.5 bg-black/30">
                <div class="flex items-center justify-between gap-3 bg-zinc-900/80 border border-zinc-800/80 p-2.5">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-8 h-8 bg-[#881337] text-white font-black text-[11px] flex items-center justify-center shrink-0">
                            AD
                        </div>
                        <div class="truncate">
                            <p class="text-xs font-bold text-white leading-none truncate">{{ auth()->user()->name ?? 'Admin Showroom' }}</p>
                            <p class="text-[10px] text-zinc-400 mt-1 uppercase tracking-wider">Super Admin</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Keluar / Logout" class="p-1.5 text-zinc-400 hover:text-rose-400 hover:bg-zinc-800 transition cursor-pointer">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- MAIN CONTENT AREA --}}
        <main class="flex-1 flex flex-col min-w-0 bg-zinc-100 min-h-screen">

            {{-- TOPBAR HEADER --}}
            <header class="h-20 bg-white border-b border-zinc-200/90 flex items-center justify-between px-4 sm:px-8 sticky top-0 z-30 shadow-2xs">

                <div class="flex items-center gap-3">
                    {{-- HAMBURGER TOGGLE BUTTON (MOBILE & TABLET) --}}
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden text-zinc-700 hover:text-zinc-950 p-2 rounded-md border border-zinc-200 bg-zinc-50 hover:bg-zinc-100 transition shrink-0"
                            title="Buka Menu Admin">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>

                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 bg-[#881337] shrink-0"></span>
                            <h2 class="font-bold text-sm sm:text-base md:text-lg text-zinc-900 tracking-[0.15em] uppercase truncate">
                                @yield('page-title', 'Dashboard Overview')
                            </h2>
                        </div>
                        <p class="text-[10px] sm:text-[11px] font-mono-code text-zinc-400 mt-0.5 uppercase tracking-wider hidden sm:block">
                            SUJA MOBILINDO &bull; MANAGEMENT SHOWROOM PLATFORM
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                    <a href="{{ route('home') }}" target="_blank"
                       class="hidden sm:inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-zinc-950 px-3 py-1.5 sm:px-3.5 sm:py-2 border border-zinc-200 hover:border-zinc-900 bg-zinc-50 hover:bg-white transition">
                        <span>Web Publik</span>
                        <span class="text-rose-600">↗</span>
                    </a>

                    <div class="text-right pl-2 sm:pl-3 border-l border-zinc-200">
                        <div class="flex items-center justify-end gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <p class="text-xs font-bold text-zinc-900 leading-none truncate max-w-[120px] sm:max-w-none">
                                {{ auth()->user()->name ?? 'Administrator' }}
                            </p>
                        </div>
                        <p class="text-[10px] text-zinc-400 mt-1 uppercase tracking-wider font-mono-code hidden md:block">
                            {{ auth()->user()->email ?? 'admin@dealer.com' }}
                        </p>
                    </div>
                </div>

            </header>

            {{-- PAGE CONTENT BODY --}}
            <section class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto min-w-0">
                @yield('content')
            </section>

        </main>

    </div>

    @stack('scripts')
</body>
</html>
