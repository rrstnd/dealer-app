<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dealer App')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800">

    <div class="min-h-screen flex">

        {{-- SIDEBAR --}}
        <aside class="w-64 min-w-64 shrink-0 bg-slate-900 text-white flex flex-col">

            {{-- Logo --}}
            <div class="h-16 flex items-center px-6 border-b border-slate-700">
                <div>
                    <h1 class="text-xl font-bold">🚗 Dealer App</h1>
                    <p class="text-xs text-slate-400">
                        Management System
                    </p>
                </div>
            </div>


            {{-- Navigation --}}
            <nav class="px-4 py-6 space-y-2">

                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('admin.dashboard')
                            ? 'bg-slate-800 text-white shadow-sm'
                            : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">

                    <span>📊</span>
                    <span>Dashboard</span>

                </a>


                {{-- Edit Kendaraan --}}
                <a href="{{ route('admin.vehicles.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('admin.vehicles.*')
                            ? 'bg-slate-800 text-white shadow-sm'
                            : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">

                    <span>✏️</span>
                    <span>Edit Kendaraan</span>

                </a>


                {{-- In / Out Kendaraan --}}
                <a href="{{ route('admin.vehicle-movements.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('admin.vehicle-movements.*')
                            ? 'bg-slate-800 text-white shadow-sm'
                            : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">

                    <span>🔄</span>
                    <span>In/Out Kendaraan</span>

                </a>

            </nav>


            {{-- WEBSITE PUBLIC --}}
            <div class="px-4 pb-4">

                <a href="{{ route('home') }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl
                        text-slate-400 hover:bg-slate-800
                        hover:text-white transition">

                    <span>🌐</span>

                    <div>
                        <p class="text-sm font-semibold">
                            Website Publik
                        </p>

                        <p class="text-xs text-slate-500">
                            Buka website
                        </p>
                    </div>

                </a>

            </div>


                {{-- PROFILE ADMIN --}}
                <div class="border-t border-slate-700 p-4">

                    <div class="flex items-center gap-3">

                        {{-- Avatar --}}
                        <div class="w-10 h-10 rounded-full bg-slate-700
                                    flex items-center justify-center shrink-0">
                            👤
                        </div>


                        {{-- Admin Info --}}
                        <div class="min-w-0">

                            <p class="text-sm font-semibold truncate">
                                Administrator
                            </p>

                            <p class="text-xs text-slate-400">
                                SUPER ADMIN
                            </p>


                            {{-- Profile --}}
                            <a href="#"
                                class="text-xs text-slate-400
                                    hover:text-white transition">
                                Profile Admin
                            </a>

                            <span class="text-slate-600 mx-1">•</span>


                            {{-- Logout --}}
                            <form method="POST"
                                action="{{ route('logout') }}"
                                class="inline">

                                @csrf

                                <button type="submit"
                                    class="text-xs text-red-400
                                        hover:text-red-300 transition">
                                    Logout
                                </button>

                            </form>

                        </div>

                    </div>

                </div>

        </aside>


        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col">


            {{-- TOPBAR --}}
            <header class="h-16 bg-white border-b
                           flex items-center justify-between px-8">

                <div>

                    <h2 class="font-semibold text-lg">
                        @yield('page-title', 'Dashboard')
                    </h2>

                    <p class="text-xs text-slate-500">
                        Management System
                    </p>

                </div>

            </header>


            {{-- PAGE --}}
            <section class="flex-1 p-8">

                @yield('content')

            </section>

        </main>

    </div>

</body>
</html>