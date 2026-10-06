<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suja MobilIndo - Premium Showroom Mobil & Motor</title>
    <meta name="description" content="Dealer mobil dan motor pilihan berkualitas tinggi dengan garansi resmi, inspeksi ketat, dan penawaran harga terbaik.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&family=Cinzel:wght@600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-luxury { font-family: 'Cinzel', serif; }
        .font-mono-code { font-family: 'JetBrains Mono', monospace; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#f8f9fa] text-zinc-900 antialiased selection:bg-zinc-900 selection:text-white" x-data="{ mobileMenuOpen: false }">

    {{-- CARITA LUXURY WHITE NAVBAR --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-zinc-200/90 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logo.png') }}" alt="SUJA MOBILINDO"
                         class="w-10 h-10 sm:w-11 sm:h-11 rounded-full object-cover shadow-xs group-hover:scale-105 transition duration-300 border border-zinc-100">
                    <div>
                        <span class="text-base sm:text-lg font-black tracking-[0.18em] text-zinc-950 uppercase leading-none block">
                            SUJA <span class="text-zinc-500 font-light">MOBILINDO</span>
                        </span>
                        <span class="block text-[9px] font-mono-code uppercase tracking-widest text-zinc-400 mt-1">
                            Jual Beli Mobil dan Motor
                        </span>
                    </div>
                </a>

                {{-- DESKTOP NAV LINKS (UPPERCASE SPATIOUS TRACKING) --}}
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-xs font-bold uppercase tracking-widest text-zinc-950 border-b-2 border-zinc-950 pb-0.5 transition">Beranda</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 1]) }}" class="text-xs font-semibold uppercase tracking-widest text-zinc-600 hover:text-zinc-950 transition">Mobil</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 2]) }}" class="text-xs font-semibold uppercase tracking-widest text-zinc-600 hover:text-zinc-950 transition">Motor</a>
                    <a href="#about" class="text-xs font-semibold uppercase tracking-widest text-zinc-600 hover:text-zinc-950 transition">Tentang Kami</a>
                    <a href="#gallery" class="text-xs font-semibold uppercase tracking-widest text-zinc-600 hover:text-zinc-950 transition">Galeri</a>
                </nav>

                {{-- ACTIONS: WHATSAPP CONTACT BUTTON --}}
                <div class="hidden sm:flex items-center">
                    <a href="https://wa.me/6281511424262" target="_blank"
                       class="inline-flex items-center gap-2 border border-zinc-900 hover:bg-zinc-950 hover:text-white text-zinc-950 text-xs font-bold uppercase tracking-widest px-4 py-2.5 rounded-sm transition active:scale-[0.98]">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Kontak</span>
                    </a>
                </div>

                {{-- MOBILE HAMBURGER TOGGLE --}}
                <div class="flex items-center gap-2 md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            type="button"
                            class="p-2.5 rounded-lg border border-zinc-300 text-zinc-800 hover:bg-zinc-100 transition"
                            aria-label="Toggle menu">
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- MOBILE DROPDOWN --}}
        <div x-show="mobileMenuOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden border-t border-zinc-200 bg-white px-4 pt-3 pb-6 space-y-3 shadow-xl">
            <div class="space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-xs font-bold uppercase tracking-widest text-zinc-950 bg-zinc-100">Beranda</a>
                <a href="{{ route('vehicles.index', ['vehicle_type_id' => 1]) }}" class="block px-3 py-2 text-xs font-semibold uppercase tracking-widest text-zinc-700 hover:bg-zinc-50">Mobil</a>
                <a href="{{ route('vehicles.index', ['vehicle_type_id' => 2]) }}" class="block px-3 py-2 text-xs font-semibold uppercase tracking-widest text-zinc-700 hover:bg-zinc-50">Motor</a>
                <a href="#about" class="block px-3 py-2 text-xs font-semibold uppercase tracking-widest text-zinc-700 hover:bg-zinc-50">Tentang Kami</a>
                <a href="#gallery" class="block px-3 py-2 text-xs font-semibold uppercase tracking-widest text-zinc-700 hover:bg-zinc-50">Galeri</a>
            </div>
            <div class="pt-3 border-t border-zinc-100">
                <a href="https://wa.me/6281511424262" target="_blank" class="w-full py-2.5 bg-zinc-950 text-white text-xs font-bold uppercase text-center rounded flex items-center justify-center gap-1.5 shadow-sm">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>Hubungi Sales (WhatsApp)</span>
                </a>
            </div>
        </div>
    </header>

    {{-- CINEMATIC DARK HERO SECTION (PERSIS CARITA STYLE) --}}
    <section class="relative min-h-[520px] sm:min-h-[580px] lg:min-h-[640px] flex items-center bg-zinc-950 overflow-hidden"
             style="background-image: url('{{ asset('images/luxury_hero.jpg') }}'); background-size: cover; background-position: center;">
        
        {{-- DARK GRADIENT OVERLAY --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/55 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-black/30 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full relative z-10 py-16">
            <div class="max-w-2xl space-y-4">
                
                {{-- SMALL UPPERCASE SUBTITLE --}}
                <div class="flex items-center gap-2">
                    <span class="w-2 h-0.5 bg-[#881337]"></span>
                    <span class="text-xs sm:text-sm font-mono-code uppercase tracking-[0.3em] text-zinc-300 font-semibold">
                        Mobil Dan Motor Berkualitas
                    </span>
                </div>

                {{-- HUGE BOLD TITLE (ROLROLA STYLE) --}}
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight uppercase leading-none">
                    SUJA MOBILINDO
                </h1>

                {{-- SHORT LUXURY SUBTEXT --}}
                <p class="text-xs sm:text-sm text-zinc-300 max-w-lg font-normal leading-relaxed pt-2">
                    Koleksi kendaraan mobil dan motor pilihan dengan standar inspeksi 150+ titik ketat, garansi resmi, dan legalitas dokumen 100% aman.
                </p>

                {{-- QUICK BUTTONS --}}
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a href="{{ route('vehicles.index') }}"
                       class="inline-flex items-center gap-2 bg-white hover:bg-zinc-200 text-zinc-950 text-xs font-bold uppercase tracking-widest px-6 py-3.5 rounded-sm shadow-xl transition">
                        <span>Jelajahi Showroom</span>
                        <span>→</span>
                    </a>

                    <a href="https://wa.me/6281511424262" target="_blank"
                       class="inline-flex items-center gap-2 border border-white/60 hover:border-white text-white text-xs font-bold uppercase tracking-widest px-6 py-3.5 rounded-sm hover:bg-white/10 transition backdrop-blur-xs">
                        <span>Jadwalkan Test Drive</span>
                    </a>
                </div>

            </div>
        </div>

        {{-- VERTICAL SCROLL INDICATOR (RIGHT EDGE) --}}
        <div class="hidden lg:flex flex-col items-center gap-3 absolute right-10 top-1/2 -translate-y-1/2 z-10 select-none">
            <span class="text-[10px] uppercase font-mono-code tracking-[0.35em] text-zinc-400 rotate-90 whitespace-nowrap">
                GULIR
            </span>
            <div class="w-px h-12 bg-zinc-500/70 mt-6"></div>
        </div>
    </section>

    {{-- SECTION: SHOWROOM CATALOG TITLE & CARITA HORIZONTAL FILTER --}}
    <section class="py-16 sm:py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        
        {{-- CENTERED UPPERCASE SECTION TITLE --}}
        <div class="text-center space-y-2">
            <h2 class="text-xl sm:text-2xl lg:text-3xl font-light text-zinc-900 tracking-[0.2em] uppercase">
                KOLEKSI KENDARAAN SHOWROOM SUJA MOBILINDO
            </h2>
            <div class="w-12 h-0.5 bg-[#881337] mx-auto"></div>
        </div>

        {{-- HORIZONTAL 6-COLUMN FILTER BAR (MATCHING SCREENSHOT PERSIS) --}}
        <div class="bg-white p-6 rounded-sm border border-zinc-200 shadow-xs">
            <form action="{{ route('vehicles.index') }}" method="GET" class="space-y-4">
                
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                    
                    {{-- 1. FILTER BY TYPE --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Tipe Kendaraan</label>
                        <select name="vehicle_type_id"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Tipe</option>
                            @foreach($vehicleTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 2. FILTER BY BRAND --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Merek Kendaraan</label>
                        <select name="brand_id"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Merek</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 3. FILTER BY MODEL YEAR --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Tahun Kendaraan</label>
                        <select name="year"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Tahun</option>
                            @for($y = date('Y'); $y >= 2017; $y--)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- 4. FILTER BY TRANSMISSION --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Transmisi</label>
                        <select name="transmission"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Transmisi</option>
                            <option value="Automatic">Otomatis (A/T)</option>
                            <option value="Manual">Manual (M/T)</option>
                            <option value="CVT">CVT</option>
                        </select>
                    </div>

                    {{-- 5. FILTER BY PRICE --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Rentang Harga</label>
                        <select name="price_range"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Harga</option>
                            <option value="under_150">&lt; Rp 150 Juta</option>
                            <option value="150_300">Rp 150 - 300 Juta</option>
                            <option value="300_500">Rp 300 - 500 Juta</option>
                            <option value="above_500">&gt; Rp 500 Juta</option>
                        </select>
                    </div>

                </div>

                {{-- SUBMIT BAR --}}
                <div class="pt-2 flex justify-end">
                    <button type="submit"
                            class="bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest px-6 py-2.5 rounded-none transition flex items-center gap-2">
                        <span>Filter Kendaraan</span>
                        <span>→</span>
                    </button>
                </div>

            </form>
        </div>

        {{-- VEHICLE SHOWCASE GRID (CARITA LUXURY CARD DESIGN) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($vehicles as $vehicle)
                <div class="bg-white border border-zinc-200/90 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    
                    <div>
                        {{-- PHOTO WITH BURGUNDY 'USED'/'READY' BADGE --}}
                        <div class="relative aspect-[16/10] bg-zinc-100 overflow-hidden">
                            @if ($vehicle->primaryImage)
                                <img src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                                     alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-out">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-zinc-400 bg-zinc-100">
                                    <svg class="w-12 h-12 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs mt-1 font-mono-code">Foto Dalam Proses</span>
                                </div>
                            @endif

                            {{-- BADGE UNIT UNGGULAN (DI-PIN ADMIN) --}}
                            @if ($vehicle->is_pinned)
                                <div class="absolute top-3 left-3 inline-flex items-center gap-1.5 bg-[#881337] text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 shadow-md">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                    </svg>
                                    <span>Unggulan</span>
                                </div>
                            @endif
                        </div>

                        {{-- BODY INFO --}}
                        <div class="p-5 space-y-3">
                            {{-- CAR TITLE (BOLD UPPERCASE) --}}
                            <h3 class="text-sm sm:text-base font-extrabold text-zinc-950 uppercase tracking-tight group-hover:text-zinc-700 transition">
                                <a href="{{ route('vehicles.show', $vehicle) }}">
                                    {{ $vehicle->brand->name }} {{ $vehicle->model->name }} {{ $vehicle->year }}
                                </a>
                            </h3>

                            {{-- 3-COLUMN SPEC ICONS ROW WITH DIVIDERS --}}
                            <div class="pt-2 border-t border-zinc-100 flex items-center justify-between text-[11px] text-zinc-600 font-medium">
                                {{-- MILEAGE --}}
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <circle cx="12" cy="12" r="9" stroke-width="2"/>
                                        <path stroke-width="2" d="M12 7v5l3 3"/>
                                    </svg>
                                    <span>{{ $vehicle->mileage ? number_format($vehicle->mileage / 1000, 0) . 'K km' : '0 km' }}</span>
                                </div>

                                {{-- FUEL --}}
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M19 14v6m-4-6h4M3 7h10a2 2 0 012 2v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2zm0 0V5a2 2 0 012-2h4a2 2 0 012 2v2"/>
                                    </svg>
                                    <span>{{ $vehicle->fuel_type ?? 'Bensin' }}</span>
                                </div>

                                {{-- TRANSMISSION --}}
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                                    </svg>
                                    <span>{{ $vehicle->transmission ?? 'Otomatis' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- BOTTOM ROW: PRICE & DETAILS OUTLINE BUTTON --}}
                    <div class="p-5 pt-0 flex items-end justify-between gap-3 border-t border-zinc-100">
                        <div>
                            <span class="text-[11px] text-zinc-400 line-through block font-mono-code">
                                Rp {{ number_format($vehicle->selling_price * 1.07, 0, ',', '.') }}
                            </span>
                            <span class="text-base sm:text-lg font-black text-zinc-950 font-mono-code block">
                                Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('vehicles.show', $vehicle) }}"
                           class="border border-zinc-900 hover:bg-zinc-950 hover:text-white text-zinc-950 text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-none transition">
                            DETAIL UNIT →
                        </a>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white border border-zinc-200">
                    <p class="text-xs font-mono-code text-zinc-400 uppercase tracking-widest">Belum Ada Kendaraan Ditampilkan</p>
                </div>
            @endforelse
        </div>

        {{-- VIEW ALL UNITS ACTION --}}
        <div class="text-center pt-4">
            <a href="{{ route('vehicles.index') }}"
               class="inline-flex items-center gap-2 border border-zinc-900 text-zinc-900 hover:bg-zinc-950 hover:text-white font-bold text-xs uppercase tracking-widest px-8 py-3.5 rounded-none transition">
                <span>Lihat Seluruh Koleksi Unit Showroom</span>
                <span>→</span>
            </a>
        </div>

    </section>

    {{-- SECTION: TENTANG KAMI (ABOUT US - LUXURY EDITORIAL STORY) --}}
    <section id="about" class="py-20 bg-zinc-50/70 border-t border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-14">
            
            {{-- HEADER TITLE --}}
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-[10px] font-mono-code uppercase tracking-[0.25em] text-[#881337] font-bold">
                    PROFIL SHOWROOM
                </span>
                <h2 class="text-2xl sm:text-3xl font-light tracking-[0.15em] text-zinc-950 uppercase">
                    TENTANG SUJA MOBILINDO
                </h2>
                <div class="w-12 h-0.5 bg-[#881337] mx-auto"></div>
                <p class="text-xs sm:text-sm text-zinc-500 leading-relaxed font-normal pt-1">
                    Dedikasi menghadirkan unit mobil dan motor bekas berkualitas tinggi, legalitas terjamin 100%, serta pelayanan ramah dan transparan bagi masyarakat Garut dan sekitarnya.
                </p>
            </div>

            {{-- STORY & STATS GRID --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                {{-- LEFT 6 COLS: EDITORIAL STORY --}}
                <div class="lg:col-span-6 space-y-6">
                    <div class="space-y-3">
                        <span class="text-[11px] font-mono-code uppercase tracking-wider text-zinc-400 font-semibold block">
                            SEJARAH & FILOSOFI
                        </span>
                        <h3 class="text-xl sm:text-2xl font-bold text-zinc-950 uppercase tracking-tight leading-snug">
                            Membangun Kepercayaan Melalui Standar Kualitas & Transparansi
                        </h3>
                    </div>

                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed">
                        Berlokasi strategis di <strong>Limbangan, Garut - Jawa Barat</strong>, <strong>Suja MobilIndo</strong> hadir sebagai solusi terpercaya dalam jual beli mobil dan motor berkualitas. Kami memahami bahwa membeli kendaraan adalah keputusan berharga bagi Anda dan keluarga.
                    </p>

                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed">
                        Oleh karena itu, setiap unit yang masuk ke showroom kami wajib melewati kurasi ketat: bebas dari bekas tabrakan parah, bebas banjir, jarak tempuh asli, dan seluruh dokumen legalitas (BPKB, STNK, faktur) dicek keasliannya langsung ke Samsat Kepolisian.
                    </p>

                    {{-- QUOTE BOX --}}
                    <div class="p-5 border-l-2 border-[#881337] bg-white shadow-xs">
                        <p class="text-xs text-zinc-700 italic leading-relaxed">
                            "Bagi kami, kepuasan dan senyum konsumen saat mengendarai kendaraan pulang ke rumah adalah pencapaian terbesar. Kejujuran kondisi unit adalah janji kami."
                        </p>
                        <span class="block text-[10px] font-mono-code uppercase tracking-widest text-zinc-400 mt-2 font-bold">
                            — Manajemen Suja MobilIndo
                        </span>
                    </div>

                    <div class="pt-2 flex flex-wrap items-center gap-4">
                        <a href="https://wa.me/6281511424262" target="_blank"
                           class="inline-flex items-center gap-2 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-none transition shadow-sm">
                            <span>Hubungi Showroom Kami</span>
                            <span>→</span>
                        </a>
                        <a href="#location"
                           class="inline-flex items-center gap-2 border border-zinc-900 text-zinc-900 hover:bg-zinc-950 hover:text-white text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-none transition">
                            <span>Lihat Lokasi Dealer</span>
                        </a>
                    </div>
                </div>

                {{-- RIGHT 6 COLS: 4 PILLARS / HIGHLIGHTS --}}
                <div class="lg:col-span-6 space-y-4">
                    
                    {{-- 1. INSPEKSI --}}
                    <div class="p-6 bg-white border border-zinc-200 shadow-xs flex items-start gap-4 group hover:border-zinc-900 transition">
                        <div class="w-10 h-10 rounded-full bg-[#881337]/10 text-[#881337] flex items-center justify-center font-bold text-sm shrink-0 group-hover:bg-[#881337] group-hover:text-white transition">
                            01
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-zinc-950">
                                Inspeksi 150+ Titik Fisik & Mesin
                            </h4>
                            <p class="text-xs text-zinc-500 leading-relaxed">
                                Pengecekan menyeluruh pada mesin, kaki-kaki, transmisi, sasis, dan sistem kelistrikan sebelum unit dipajang di showroom.
                            </p>
                        </div>
                    </div>

                    {{-- 2. LEGALITAS --}}
                    <div class="p-6 bg-white border border-zinc-200 shadow-xs flex items-start gap-4 group hover:border-zinc-900 transition">
                        <div class="w-10 h-10 rounded-full bg-[#881337]/10 text-[#881337] flex items-center justify-center font-bold text-sm shrink-0 group-hover:bg-[#881337] group-hover:text-white transition">
                            02
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-zinc-950">
                                100% Legalitas Dokumen Sah
                            </h4>
                            <p class="text-xs text-zinc-500 leading-relaxed">
                                Keaslian BPKB, STNK, dan riwayat cek fisik nomor rangka & mesin terjamin aman tanpa sengketa hukum.
                            </p>
                        </div>
                    </div>

                    {{-- 3. HARGA JUJUR --}}
                    <div class="p-6 bg-white border border-zinc-200 shadow-xs flex items-start gap-4 group hover:border-zinc-900 transition">
                        <div class="w-10 h-10 rounded-full bg-[#881337]/10 text-[#881337] flex items-center justify-center font-bold text-sm shrink-0 group-hover:bg-[#881337] group-hover:text-white transition">
                            03
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xs sm:text-sm font-bold uppercase tracking-wider text-zinc-950">
                                Harga Transparan & Negosiasi Fleksibel
                            </h4>
                            <p class="text-xs text-zinc-500 leading-relaxed">
                                Tidak ada biaya tersembunyi. Konsumen bebas bernegosiasi langsung dengan owner secara transparan di showroom.
                            </p>
                        </div>
                </div>

            </div>

        </div>
    </section>

    {{-- SECTION: GALERI & MEDIA SOSIAL (TIKTOK, INSTAGRAM, YOUTUBE) --}}
    <section id="gallery" class="py-20 bg-white border-t border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <div class="text-center max-w-2xl mx-auto space-y-3">
                <span class="text-[10px] font-mono-code uppercase tracking-[0.25em] text-[#881337] font-bold">
                    MEDIA SOSIAL RESMI & SHOWROOM
                </span>
                <h2 class="text-2xl sm:text-3xl font-light tracking-[0.15em] text-zinc-950 uppercase">
                    GALERI AKTIVITAS SHOWROOM
                </h2>
                <div class="w-12 h-0.5 bg-[#881337] mx-auto"></div>
                <p class="text-xs sm:text-sm text-zinc-500 leading-relaxed font-normal pt-1">
                    Ikuti dokumentasi aktivitas serah terima kendaraan, review unit masuk, dan informasi stok terbaru langsung dari kanal TikTok dan Instagram Suja MobilIndo.
                </p>
            </div>

            {{-- 2-COLUMN SOCIAL MEDIA SHOWCASE (ICON ONLY, NO PREVIEW PHOTOS) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto items-stretch">
                
                {{-- 1. TIKTOK CARD --}}
                <div class="bg-white border border-zinc-200 shadow-xs hover:shadow-xl hover:border-zinc-300 transition-all duration-300 flex flex-col justify-between group p-8 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-black/5 rounded-full blur-2xl group-hover:bg-black/10 transition"></div>
                    
                    <div>
                        {{-- PLATFORM ICON --}}
                        <div class="w-16 h-16 rounded-2xl bg-black text-white flex items-center justify-center shadow-md group-hover:scale-110 transition duration-300 mb-6">
                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                        </div>

                        {{-- BADGE & HANDLE --}}
                        <div class="flex items-center justify-between text-[11px] font-mono-code text-zinc-500 mb-4 border-b border-zinc-100 pb-3">
                            <span class="font-bold text-zinc-900">@sujamobilindo7</span>
                            <span class="bg-zinc-100 text-zinc-800 px-2.5 py-0.5 rounded text-[10px] font-sans font-bold tracking-wider">TIKTOK</span>
                        </div>

                        <h3 class="text-base font-bold uppercase tracking-wider text-zinc-950 mb-2 group-hover:text-[#881337] transition">
                            Video Ulasan Singkat Unit
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed mb-6">
                            Tonton video review cepat, cek suara knalpot, hingga tips memilih mobil bekas bergaransi langsung dari showroom.
                        </p>
                    </div>

                    <div class="pt-4 border-t border-zinc-100">
                        <a href="https://www.tiktok.com/@sujamobilindo7?_r=1&_t=ZS-99pBOE7vU0r" target="_blank"
                           class="w-full inline-flex items-center justify-center gap-2 border border-zinc-900 text-zinc-950 hover:bg-zinc-950 hover:text-white text-xs font-bold uppercase tracking-wider py-3 transition shadow-xs">
                            <span>Buka di TikTok</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>

                {{-- 2. INSTAGRAM CARD --}}
                <div class="bg-white border border-zinc-200 shadow-xs hover:shadow-xl hover:border-zinc-300 transition-all duration-300 flex flex-col justify-between group p-8 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-pink-500/5 rounded-full blur-2xl group-hover:bg-pink-500/10 transition"></div>
                    
                    <div>
                        {{-- PLATFORM ICON --}}
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[#fd1d1d] via-[#833ab4] to-[#fcb045] text-white flex items-center justify-center shadow-md group-hover:scale-110 transition duration-300 mb-6">
                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </div>

                        {{-- BADGE & HANDLE --}}
                        <div class="flex items-center justify-between text-[11px] font-mono-code text-zinc-500 mb-4 border-b border-zinc-100 pb-3">
                            <span class="font-bold text-zinc-900">@ivaannll</span>
                            <span class="bg-pink-50 text-pink-700 px-2.5 py-0.5 rounded text-[10px] font-sans font-bold tracking-wider">INSTAGRAM</span>
                        </div>

                        <h3 class="text-base font-bold uppercase tracking-wider text-zinc-950 mb-2 group-hover:text-[#881337] transition">
                            Serah Terima & Feed Harian
                        </h3>
                        <p class="text-xs text-zinc-600 leading-relaxed mb-6">
                            Simak momen kebahagiaan serah terima unit konsumen, testimoni pembeli, dan story update unit baru setiap hari.
                        </p>
                    </div>

                    <div class="pt-4 border-t border-zinc-100">
                        <a href="https://www.instagram.com/ivaannll?utm_source=ig_web_button_share_sheet&stkn=ZDNlZDc0MzIxNw==" target="_blank"
                           class="w-full inline-flex items-center justify-center gap-2 border border-zinc-900 text-zinc-950 hover:bg-zinc-950 hover:text-white text-xs font-bold uppercase tracking-wider py-3 transition shadow-xs">
                            <span>Kunjungi Instagram</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>



            </div>


        </div>
    </section>

    {{-- SECTION: SHOWROOM LOCATION & GOOGLE MAPS --}}
    <section id="location" class="py-20 bg-[#f8f9fa] border-t border-zinc-200" x-data="{ activeBranch: 'garut' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            
            <div class="text-center space-y-2">
                <span class="text-[10px] font-mono-code uppercase tracking-[0.25em] text-[#881337] font-bold">KUNJUNGI SHOWROOM KAMI</span>
                <h2 class="text-2xl sm:text-3xl font-light tracking-[0.15em] text-zinc-950 uppercase">
                    LOKASI CABANG DEALER
                </h2>
                <p class="text-xs text-zinc-500 max-w-md mx-auto pt-1">
                    Temukan lokasi showroom Suja MobilIndo terdekat di kota Anda (Garut & Bandung).
                </p>
            </div>

            {{-- BRANCH SELECTOR TABS --}}
            <div class="flex justify-center gap-3">
                <button @click="activeBranch = 'garut'"
                        :class="activeBranch === 'garut' ? 'bg-zinc-950 text-white border-zinc-950 shadow-md' : 'bg-white text-zinc-700 border-zinc-300 hover:border-zinc-900'"
                        class="px-5 py-3 border text-xs font-bold uppercase tracking-wider transition flex items-center gap-2 rounded-none cursor-pointer">
                    <svg class="w-4 h-4 fill-current text-[#881337]" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <span>Cabang Garut</span>
                </button>
                <button @click="activeBranch = 'bandung'"
                        :class="activeBranch === 'bandung' ? 'bg-zinc-950 text-white border-zinc-950 shadow-md' : 'bg-white text-zinc-700 border-zinc-300 hover:border-zinc-900'"
                        class="px-5 py-3 border text-xs font-bold uppercase tracking-wider transition flex items-center gap-2 rounded-none cursor-pointer">
                    <svg class="w-4 h-4 fill-current text-[#881337]" viewBox="0 0 24 24">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    <span>Cabang Bandung</span>
                </button>
            </div>

            {{-- CONTENT: GARUT BRANCH --}}
            <div x-show="activeBranch === 'garut'" class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                {{-- DETAILS CARD GARUT --}}
                <div class="bg-white p-8 border border-zinc-200 shadow-xs flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 border-b border-zinc-100 pb-4">
                            <span class="text-2xl">🏢</span>
                            <div>
                                <h3 class="text-sm font-black text-zinc-950 uppercase tracking-wide">Suja MobilIndo - Garut</h3>
                                <p class="text-xs text-zinc-500 font-mono-code mt-0.5">Cabang Garut</p>
                            </div>
                        </div>

                        <div class="space-y-3 text-xs text-zinc-600">
                            <div>
                                <span class="font-bold text-zinc-900 block uppercase tracking-wider text-[10px] text-zinc-400">Alamat Lengkap:</span>
                                <span>Kp. Cilanggir, Cigagade, Balubur Limbangan, Garut, Jawa Barat</span>
                            </div>
                            <div>
                                <span class="font-bold text-zinc-900 block uppercase tracking-wider text-[10px] text-zinc-400">Jam Operasional:</span>
                                <span>Senin – Minggu: 08:00 – 18:00 WIB</span>
                            </div>
                            <div>
                                <span class="font-bold text-zinc-900 block uppercase tracking-wider text-[10px] text-zinc-400">Layanan:</span>
                                <span>Test Drive, Cek Fisik Unit, Jual Beli, Tukar Tambah</span>
                            </div>
                        </div>
                    </div>

                    <a href="https://www.google.com/maps/search/?api=1&query=-7.043806,107.951694" target="_blank"
                       class="w-full text-center border border-zinc-900 hover:bg-zinc-950 hover:text-white text-zinc-950 text-xs font-bold uppercase tracking-widest py-3 transition">
                        Buka Garut di Google Maps →
                    </a>
                </div>

                {{-- MAP EMBED GARUT --}}
                <div class="lg:col-span-2 bg-white p-2 border border-zinc-200 shadow-xs min-h-[380px]">
                    <iframe class="w-full h-full min-h-[380px] border-0"
                            src="https://maps.google.com/maps?q=-7.043806,107.951694&z=17&output=embed"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            {{-- CONTENT: BANDUNG BRANCH --}}
            <div x-show="activeBranch === 'bandung'" x-cloak class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                {{-- DETAILS CARD BANDUNG --}}
                <div class="bg-white p-8 border border-zinc-200 shadow-xs flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3 border-b border-zinc-100 pb-4">
                            <span class="text-2xl">🏢</span>
                            <div>
                                <h3 class="text-sm font-black text-zinc-950 uppercase tracking-wide">Suja MobilIndo - Bandung</h3>
                                <p class="text-xs text-zinc-500 font-mono-code mt-0.5">Cabang Bandung</p>
                            </div>
                        </div>

                        <div class="space-y-3 text-xs text-zinc-600">
                            <div>
                                <span class="font-bold text-zinc-900 block uppercase tracking-wider text-[10px] text-zinc-400">Alamat Lengkap:</span>
                                <span>Jl. Cibaduyut Lama No.58, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235</span>
                            </div>
                            <div>
                                <span class="font-bold text-zinc-900 block uppercase tracking-wider text-[10px] text-zinc-400">Jam Operasional:</span>
                                <span>Senin – Minggu: 08:00 – 18:00 WIB</span>
                            </div>
                            <div>
                                <span class="font-bold text-zinc-900 block uppercase tracking-wider text-[10px] text-zinc-400">Layanan:</span>
                                <span>Test Drive, Cek Fisik Unit, Jual Beli, Tukar Tambah</span>
                            </div>
                        </div>
                    </div>

                    <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Cibaduyut+Lama+No.58,+Kb.+Lega,+Kec.+Bojongloa+Kidul,+Kota+Bandung,+Jawa+Barat+40235" target="_blank"
                       class="w-full text-center border border-zinc-900 hover:bg-zinc-950 hover:text-white text-zinc-950 text-xs font-bold uppercase tracking-widest py-3 transition">
                        Buka Bandung di Google Maps →
                    </a>
                </div>

                {{-- MAP EMBED BANDUNG --}}
                <div class="lg:col-span-2 bg-white p-2 border border-zinc-200 shadow-xs min-h-[380px]">
                    <iframe class="w-full h-full min-h-[380px] border-0"
                            src="https://maps.google.com/maps?q=Jl.+Cibaduyut+Lama+No.58,+Kb.+Lega,+Kec.+Bojongloa+Kidul,+Kota+Bandung,+Jawa+Barat+40235&z=17&output=embed"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </section>

    {{-- FOOTER (MINIMALIST LUXURY CARITA STYLE) --}}
    <footer class="bg-zinc-950 text-zinc-400 text-xs py-14 border-t border-zinc-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <div class="space-y-3 md:col-span-2">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="SUJA MOBILINDO"
                         class="w-10 h-10 sm:w-11 sm:h-11 rounded-full object-cover shadow-sm shrink-0 border border-zinc-800">
                    <span class="text-base font-black tracking-[0.2em] text-white uppercase block">
                        SUJA <span class="text-zinc-400 font-light">MOBILINDO</span>
                    </span>
                </div>
                <p class="text-xs text-zinc-400 max-w-sm leading-relaxed">
                    Dealer otomotif terpercaya dengan koleksi mobil dan motor berkualitas pilihan. Seluruh unit terinspeksi dan bergaransi resmi.
                </p>
            </div>

            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-white mb-3">Media Sosial</h4>
                <ul class="space-y-2.5 text-xs">
                    <li>
                        <a href="https://www.instagram.com/ivaannll?utm_source=ig_web_button_share_sheet&stkn=ZDNlZDc0MzIxNw==" target="_blank" class="hover:text-white transition flex items-center gap-2 text-zinc-400 group">
                            <svg class="w-3.5 h-3.5 fill-current text-zinc-400 group-hover:text-white transition shrink-0" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span>Instagram</span>
                            <span class="text-[10px] text-zinc-500 group-hover:text-zinc-400 transition">↗</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com/@sujamobilindo7?_r=1&_t=ZS-99pBOE7vU0r" target="_blank" class="hover:text-white transition flex items-center gap-2 text-zinc-400 group">
                            <svg class="w-3.5 h-3.5 fill-current text-zinc-400 group-hover:text-white transition shrink-0" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                            <span>TikTok</span>
                            <span class="text-[10px] text-zinc-500 group-hover:text-zinc-400 transition">↗</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-white mb-3">Kontak & Lokasi Cabang</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="https://wa.me/6281511424262" target="_blank" class="hover:text-white transition">WhatsApp: +62 815-1142-4262</a></li>
                    <li><span class="text-zinc-400 font-bold block mt-1 text-[11px]">Cabang Garut:</span> <span class="text-zinc-500">Limbangan, Garut - Jawa Barat</span></li>
                    <li><span class="text-zinc-400 font-bold block text-[11px]">Cabang Bandung:</span> <span class="text-zinc-500">Jl. Cibaduyut Lama No.58, Bandung</span></li>
                </ul>
            </div>

        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 mt-10 border-t border-zinc-800 text-center text-zinc-600 font-mono-code text-[11px]">
            &copy; {{ date('Y') }} Suja MobilIndo. Seluruh hak cipta dilindungi.
        </div>
    </footer>

</body>
</html>
