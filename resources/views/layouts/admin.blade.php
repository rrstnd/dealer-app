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
        <aside class="w-64 bg-slate-900 text-white flex flex-col">

            {{-- Logo --}}
            <div class="h-16 flex items-center px-6 border-b border-slate-700">
                <div>
                    <h1 class="text-xl font-bold">🚗 Dealer App</h1>
                    <p class="text-xs text-slate-400">Management System</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-6 space-y-2">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg bg-slate-800">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('vehicles.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    <span>🚗</span>
                    <span>Inventory</span>
                </a>

                <a href="{{ route('customers.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                        <span>👥</span>
                        <span>Customer</span>
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    <span>💵</span>
                    <span>Keuangan</span>
                </a>

                <a href="#"
                   class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                    <span>📊</span>
                    <span>Laporan</span>
                </a>

                <div class="pt-6">
                    <p class="px-4 mb-2 text-xs uppercase text-slate-500 font-semibold">
                        System
                    </p>

                    <a href="#"
                       class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-slate-800 transition">
                        <span>⚙️</span>
                        <span>Pengaturan</span>
                    </a>
                </div>

            </nav>

            {{-- User --}}
            <div class="border-t border-slate-700 p-4">
                <div class="flex items-center gap-3">

                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center">
                        👤
                    </div>

                    <div>
                        <p class="text-sm font-semibold">Administrator</p>
                        <p class="text-xs text-slate-400">SUPER ADMIN</p>
                    </div>

                </div>
            </div>

        </aside>


        {{-- MAIN CONTENT --}}
        <main class="flex-1 flex flex-col">

            {{-- TOPBAR --}}
            <header class="h-16 bg-white border-b flex items-center justify-between px-8">

                <div>
                    <h2 class="font-semibold text-lg">
                        @yield('page-title', 'Dashboard')
                    </h2>

                    <p class="text-xs text-slate-500">
                        Management System
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


            {{-- PAGE --}}
            <section class="flex-1 p-8">

                @yield('content')

            </section>

        </main>

    </div>

</body>
</html>