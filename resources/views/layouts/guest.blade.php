<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login Admin - Suja MobilIndo</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased min-h-screen flex flex-col justify-between selection:bg-blue-600 selection:text-white relative overflow-x-hidden">

    <!-- Decorative Subtle Background Glow -->
    <div class="fixed top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-32 left-1/4 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -top-20 right-1/4 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 flex-1 flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
        <div class="w-full sm:max-w-md">
            {{ $slot }}
        </div>
    </div>

    <!-- Footer Copyright -->
    <footer class="relative z-10 py-5 text-center text-xs font-medium text-slate-500 border-t border-slate-200/60 bg-white/60 backdrop-blur-md">
        <p>&copy; {{ date('Y') }} Suja Mobilindo. All rights reserved.</p>
    </footer>
</body>
</html>

