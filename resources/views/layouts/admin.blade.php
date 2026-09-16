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
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-slate-800">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>

                {{-- INVENTORY / VEHICLES --}}
                <a href="{{ route('admin.vehicles.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    <span>🚗</span>
                    <span>Inventory</span>
                </a>

                {{-- CUSTOMERS --}}
                <a href="{{ route('admin.customers.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                        <span>👥</span>
                        <span>Customer</span>
                </a>

                {{-- PENJUALAN / SALES --}}
                <a href="{{ route('admin.sales.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                        <span>💵</span>
                        <span>Keuangan</span>
                </a>

                {{-- LAPORAN --}}
                <a href="{{ route('admin.reports.sales') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    <span>📊</span>
                    <span>Laporan</span>
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

                    <button class="text-xl">
                        🔔
                    </button>

                    <div class="text-right">
                        <p class="text-sm font-semibold">
                            Administrator
                        </p>

                        <p class="text-xs text-slate-500">
                            Super Admin
                        </p>
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



