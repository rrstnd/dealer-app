<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Portal - Suja MobilIndo')</title>

    {{-- GOOGLE FONTS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50/80 text-slate-800 antialiased">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 min-w-64 shrink-0 bg-slate-900 text-slate-300 flex flex-col border-r border-slate-800">

            {{-- LOGO --}}
            <div class="h-20 flex items-center px-6 border-b border-slate-800/80">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-blue-600 text-white font-black text-xl flex items-center justify-center shadow-lg shadow-blue-600/30 group-hover:scale-105 transition">
                        S
                    </div>
                    <div>
                        <span class="text-base font-extrabold tracking-tight text-white block">Suja <span class="text-blue-500">MobilIndo</span></span>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-slate-400 -mt-1">Admin Portal</span>
                    </div>
                </a>
            </div>

            {{-- NAVIGATION --}}
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">

                <div class="px-3 pb-2 text-[10px] uppercase font-extrabold tracking-wider text-slate-400">Main Menu</div>

                {{-- DASHBOARD --}}
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.dashboard*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>

                {{-- INVENTORY / VEHICLES --}}
                <a href="{{ route('admin.vehicles.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.vehicles*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-8 4h4m6 4H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Katalog Kendaraan</span>
                </a>

                {{-- CUSTOMERS --}}
                <a href="{{ route('admin.customers.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.customers*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>Data Customer</span>
                </a>

                {{-- PENJUALAN / SALES --}}
                <a href="{{ route('admin.sales.index') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.sales*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Transaksi Penjualan</span>
                </a>

                {{-- LAPORAN --}}
                <a href="{{ route('admin.reports.sales') }}"
                   class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold transition-all duration-150 {{ request()->routeIs('admin.reports*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <span>Laporan Sales</span>
                </a>

                <div class="pt-6">
                    <div class="px-3 pb-2 text-[10px] uppercase font-extrabold tracking-wider text-slate-400">Pintasan</div>

                    <a href="{{ route('home') }}" target="_blank"
                       class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-400 hover:text-white hover:bg-slate-800/60 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <span>Lihat Website Utama</span>
                    </a>
                </div>

            </nav>

            {{-- USER PROFILE AT BOTTOM --}}
            <div class="border-t border-slate-800/80 p-4">
                <div class="flex items-center justify-between gap-3 bg-slate-800/50 p-2.5 rounded-xl">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-blue-600 text-white font-bold text-xs flex items-center justify-center shadow-sm shrink-0">
                            AD
                        </div>
                        <div>
                            <p class="text-xs font-bold text-white leading-none">Admin Dealership</p>
                            <p class="text-[10px] text-slate-400 mt-0.5">Super Administrator</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Logout" class="p-1.5 text-slate-400 hover:text-rose-400 hover:bg-slate-800 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </aside>

        {{-- MAIN CONTENT AREA --}}
        <main class="flex-1 flex flex-col min-w-0">

            {{-- TOPBAR HEADER --}}
            <header class="h-20 bg-white border-b border-slate-200/80 flex items-center justify-between px-8 sticky top-0 z-30 shadow-xs">

                <div>
                    <h2 class="font-extrabold text-lg text-slate-900 tracking-tight">
                        @yield('page-title', 'Dashboard Overview')
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5 font-medium">
                        Suja MobilIndo Management Platform
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" target="_blank" class="hidden sm:flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100/80 px-3.5 py-2 rounded-xl transition">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span>Pratinjau Web</span>
                    </a>

                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-900 leading-tight">Admin System</p>
                            <p class="text-[10px] text-slate-400 font-medium">Online</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-slate-900 text-white font-bold text-xs flex items-center justify-center shadow-sm">
                            S
                        </div>
                    </div>
                </div>

            </header>

            {{-- PAGE CONTENT BODY --}}
            <section class="flex-1 p-6 sm:p-8">
                @yield('content')
            </section>

        </main>

    </div>

</body>
</html>



