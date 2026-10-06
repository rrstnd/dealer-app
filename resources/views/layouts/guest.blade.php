<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Portal Admin - SUJA MOBILINDO</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 text-zinc-100 antialiased min-h-screen flex flex-col justify-between selection:bg-[#881337] selection:text-white relative overflow-x-hidden">

    <!-- Atmospheric Dark Luxury Glow -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[700px] h-[500px] bg-[#881337]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-zinc-900/40 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 flex-1 flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
        <div class="w-full sm:max-w-md">
            {{ $slot }}
        </div>
    </div>

    <!-- Footer Copyright -->
    <footer class="relative z-10 py-5 text-center text-xs font-mono-code text-zinc-500 border-t border-zinc-900 bg-black/60 backdrop-blur-md">
        <p>&copy; {{ date('Y') }} SUJA MOBILINDO &bull; PORTAL MANAJEMEN RESMI</p>
    </footer>
</body>
</html>
