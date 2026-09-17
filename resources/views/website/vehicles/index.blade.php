<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Mobil & Motor Showroom - Suja MobilIndo</title>
    <meta name="description" content="Koleksi kendaraan mobil dan motor pilihan bergaransi resmi, 150+ titik inspeksi, & penawaran harga terbaik dari Suja MobilIndo.">
    
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

<body class="bg-[#f8f9fa] text-zinc-900 antialiased selection:bg-zinc-900 selection:text-white min-h-screen flex flex-col justify-between" x-data="{ mobileMenuOpen: false }">

    {{-- CARITA LUXURY WHITE NAVBAR --}}
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-zinc-200/90 shadow-xs transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-[#881337] text-white flex items-center justify-center font-black text-sm sm:text-base shadow-sm group-hover:scale-105 transition">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" fill="none"/>
                            <circle cx="12" cy="12" r="3" fill="currentColor"/>
                            <path stroke="currentColor" stroke-width="2" d="M12 3v6m0 6v6m9-9h-6m-6 0H3"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-base sm:text-lg font-black tracking-[0.18em] text-zinc-950 uppercase leading-none block">
                            SUJA <span class="text-zinc-500 font-light">MOBILINDO</span>
                        </span>
                        <span class="block text-[9px] font-mono-code uppercase tracking-widest text-zinc-400 mt-1">
                            Jual Beli Mobil dan Motor 
                        </span>
                    </div>
                </a>

                {{-- DESKTOP NAV LINKS --}}
                <nav class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-xs font-semibold uppercase tracking-widest text-zinc-600 hover:text-zinc-950 transition">Beranda</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 1]) }}" class="text-xs uppercase tracking-widest {{ request('vehicle_type_id') == 1 ? 'text-zinc-950 font-bold border-b-2 border-zinc-950 pb-0.5' : 'text-zinc-600 hover:text-zinc-950 font-semibold' }} transition">Mobil</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 2]) }}" class="text-xs uppercase tracking-widest {{ request('vehicle_type_id') == 2 ? 'text-zinc-950 font-bold border-b-2 border-zinc-950 pb-0.5' : 'text-zinc-600 hover:text-zinc-950 font-semibold' }} transition">Motor</a>
                    <a href="{{ route('home') }}#about" class="text-xs font-semibold uppercase tracking-widest text-zinc-600 hover:text-zinc-950 transition">Tentang Kami</a>
                    <a href="{{ route('home') }}#gallery" class="text-xs font-semibold uppercase tracking-widest text-zinc-600 hover:text-zinc-950 transition">Galeri</a>
                </nav>

                {{-- ACTIONS --}}
                <div class="hidden sm:flex items-center">
                    <a href="https://wa.me/6281511424262" target="_blank"
                       class="inline-flex items-center gap-2 border border-zinc-900 hover:bg-zinc-950 hover:text-white text-zinc-950 text-xs font-bold uppercase tracking-widest px-4 py-2.5 rounded-sm transition active:scale-[0.98]">
                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Kontak</span>
                    </a>
                </div>

                {{-- MOBILE HAMBURGER --}}
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
             class="md:hidden border-t border-zinc-200 bg-white px-4 pt-3 pb-6 space-y-3 shadow-xl">
            <div class="space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-xs font-semibold uppercase tracking-widest text-zinc-700 hover:bg-zinc-50">Beranda</a>
                <a href="{{ route('vehicles.index', ['vehicle_type_id' => 1]) }}" class="block px-3 py-2 text-xs font-bold uppercase tracking-widest {{ request('vehicle_type_id') == 1 ? 'text-zinc-950 bg-zinc-100' : 'text-zinc-700 hover:bg-zinc-50' }}">Mobil</a>
                <a href="{{ route('vehicles.index', ['vehicle_type_id' => 2]) }}" class="block px-3 py-2 text-xs font-bold uppercase tracking-widest {{ request('vehicle_type_id') == 2 ? 'text-zinc-950 bg-zinc-100' : 'text-zinc-700 hover:bg-zinc-50' }}">Motor</a>
                <a href="{{ route('home') }}#about" class="block px-3 py-2 text-xs font-semibold uppercase tracking-widest text-zinc-700 hover:bg-zinc-50">Tentang Kami</a>
                <a href="{{ route('home') }}#gallery" class="block px-3 py-2 text-xs font-semibold uppercase tracking-widest text-zinc-700 hover:bg-zinc-50">Galeri</a>
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

    {{-- MAIN CONTAINER --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex-grow space-y-8">
        
        {{-- BREADCRUMB & SECTION TITLE --}}
        <div class="space-y-2">
            <div class="flex items-center gap-2 text-[11px] font-mono-code uppercase tracking-widest text-zinc-400">
                <a href="{{ route('home') }}" class="hover:text-zinc-900 transition">BERANDA</a>
                <span>/</span>
                <span class="text-zinc-900 font-bold">INVENTARIS SHOWROOM</span>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 pt-2">
                <div>
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-light text-zinc-900 tracking-[0.15em] uppercase">
                        @if(request('vehicle_type_id') == 1)
                            KOLEKSI MOBIL SHOWROOM
                        @elseif(request('vehicle_type_id') == 2)
                            KOLEKSI MOTOR SHOWROOM
                        @else
                            KOLEKSI KENDARAAN SHOWROOM SUJA MOBILINDO
                        @endif
                    </h1>
                    <p class="text-xs text-zinc-500 mt-1 font-normal">
                        Menampilkan <span class="font-bold text-zinc-900">{{ $vehicles->total() }}</span> unit kendaraan siap pakai bergaransi resmi
                    </p>
                </div>
            </div>
        </div>

        {{-- HORIZONTAL 6-COLUMN FILTER BAR (CARITA STYLE) --}}
        <div class="bg-white p-6 border border-zinc-200 shadow-xs space-y-4">
            <form method="GET" action="{{ route('vehicles.index') }}" class="space-y-4">
                
                {{-- QUICK SEARCH BAR --}}
                <div class="pb-4 border-b border-zinc-100">
                    <div class="relative max-w-md">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari Merek, Model, atau Kode Stok..."
                               class="w-full bg-zinc-50 border border-zinc-200 text-zinc-800 text-xs px-4 py-2.5 outline-none focus:bg-white focus:border-zinc-900 transition">
                    </div>
                </div>

                {{-- 5 HORIZONTAL FILTER BOXES --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                    
                    {{-- 1. TYPE --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Tipe Kendaraan</label>
                        <select name="vehicle_type_id"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Tipe</option>
                            @foreach($vehicleTypes as $type)
                                <option value="{{ $type->id }}" {{ request('vehicle_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 2. BRAND --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Merek Kendaraan</label>
                        <select name="brand_id"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Merek</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request('brand_id') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- 3. YEAR --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Tahun Kendaraan</label>
                        <select name="year"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Tahun</option>
                            @for($y = date('Y'); $y >= 2017; $y--)
                                <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                            @endfor
                        </select>
                    </div>

                    {{-- 4. TRANSMISSION --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Transmisi</label>
                        <select name="transmission"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Transmisi</option>
                            <option value="Automatic" {{ request('transmission') == 'Automatic' ? 'selected' : '' }}>Otomatis (A/T)</option>
                            <option value="Manual" {{ request('transmission') == 'Manual' ? 'selected' : '' }}>Manual (M/T)</option>
                            <option value="CVT" {{ request('transmission') == 'CVT' ? 'selected' : '' }}>CVT</option>
                        </select>
                    </div>

                    {{-- 5. PRICE --}}
                    <div>
                        <label class="block text-[11px] font-medium text-zinc-500 mb-1.5">Rentang Harga</label>
                        <select name="price_range"
                                class="w-full bg-white border border-zinc-300 text-zinc-800 text-xs px-3 py-2 rounded-none focus:outline-none focus:border-zinc-900 transition">
                            <option value="">Semua Harga</option>
                            <option value="under_150" {{ request('price_range') == 'under_150' ? 'selected' : '' }}>&lt; Rp 150 Juta</option>
                            <option value="150_300" {{ request('price_range') == '150_300' ? 'selected' : '' }}>Rp 150 - 300 Juta</option>
                            <option value="300_500" {{ request('price_range') == '300_500' ? 'selected' : '' }}>Rp 300 - 500 Juta</option>
                            <option value="above_500" {{ request('price_range') == 'above_500' ? 'selected' : '' }}>&gt; Rp 500 Juta</option>
                        </select>
                    </div>

                </div>

                {{-- SUBMIT BAR --}}
                <div class="pt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        @if(request()->hasAny(['search', 'vehicle_type_id', 'brand_id', 'year', 'transmission', 'price_range']))
                            <a href="{{ route('vehicles.index') }}"
                               class="inline-flex items-center gap-2 px-4 py-2.5 bg-zinc-100 hover:bg-rose-50 text-zinc-700 hover:text-rose-700 border border-zinc-200 hover:border-rose-200 text-xs font-semibold uppercase tracking-wider transition rounded-none">
                                <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                <span>Atur Ulang Filter</span>
                            </a>
                        @endif
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        <button type="submit"
                                class="bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest px-6 py-2.5 rounded-none transition flex items-center gap-2 shadow-xs">
                            <span>Terapkan Filter</span>
                            <span>→</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>

        {{-- VEHICLE GRID SHOWCASE (MATCHING CARITA) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($vehicles as $vehicle)
                <div class="bg-white border border-zinc-200/90 shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
                    
                    <div>
                        {{-- PHOTO WITH BURGUNDY 'USED' BADGE --}}
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
                        </div>

                        {{-- BODY INFO --}}
                        <div class="p-5 space-y-3">
                            {{-- CAR TITLE --}}
                            <h3 class="text-sm sm:text-base font-extrabold text-zinc-950 uppercase tracking-tight group-hover:text-zinc-700 transition">
                                <a href="{{ route('vehicles.show', $vehicle) }}">
                                    {{ $vehicle->brand->name }} {{ $vehicle->model->name }} {{ $vehicle->year }}
                                </a>
                            </h3>

                            {{-- 3-COLUMN SPEC ICONS ROW --}}
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
                <div class="col-span-full py-20 text-center bg-white border border-zinc-200">
                    <p class="text-xs font-mono-code text-zinc-400 uppercase tracking-widest">Tidak Ada Kendaraan Yang Sesuai Filter</p>
                    <a href="{{ route('vehicles.index') }}" class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                        <span>Lihat Semua Unit</span>
                        <span>→</span>
                    </a>
                </div>
            @endforelse
        </div>

        {{-- PAGINATION --}}
        <div class="pt-6">
            {{ $vehicles->links() }}
        </div>

    </main>

    {{-- FOOTER --}}
    <footer class="bg-zinc-950 text-zinc-400 text-xs py-14 border-t border-zinc-800 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <div class="space-y-3 md:col-span-2">
                <span class="text-base font-black tracking-[0.2em] text-white uppercase block">
                    SUJA <span class="text-zinc-400 font-light">MOBILINDO</span>
                </span>
                <p class="text-xs text-zinc-400 max-w-sm leading-relaxed">
                    Dealer otomotif terpercaya dengan koleksi mobil dan motor berkualitas pilihan. Seluruh unit terinspeksi dan bergaransi resmi.
                </p>
            </div>

            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-white mb-3">Media Sosial</h4>
                <ul class="space-y-2.5 text-xs">
                    <li>
                        <a href="https://www.instagram.com" target="_blank" class="hover:text-white transition flex items-center gap-2 text-zinc-400 group">
                            <svg class="w-3.5 h-3.5 fill-current text-zinc-400 group-hover:text-white transition shrink-0" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                            <span>Instagram</span>
                            <span class="text-[10px] text-zinc-500 group-hover:text-zinc-400 transition">↗</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com" target="_blank" class="hover:text-white transition flex items-center gap-2 text-zinc-400 group">
                            <svg class="w-3.5 h-3.5 fill-current text-zinc-400 group-hover:text-white transition shrink-0" viewBox="0 0 24 24">
                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                            </svg>
                            <span>TikTok</span>
                            <span class="text-[10px] text-zinc-500 group-hover:text-zinc-400 transition">↗</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com" target="_blank" class="hover:text-white transition flex items-center gap-2 text-zinc-400 group">
                            <svg class="w-3.5 h-3.5 fill-current text-zinc-400 group-hover:text-white transition shrink-0" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                            <span>YouTube</span>
                            <span class="text-[10px] text-zinc-500 group-hover:text-zinc-400 transition">↗</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-bold uppercase tracking-widest text-white mb-3">Kontak</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="https://wa.me/6281511424262" target="_blank" class="hover:text-white transition">WhatsApp: +62 815-1142-4262</a></li>
                    <li><span class="text-zinc-500">Limbangan, Garut - Jawa Barat</span></li>
                </ul>
            </div>

        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 mt-10 border-t border-zinc-800 text-center text-zinc-600 font-mono-code text-[11px]">
            &copy; {{ date('Y') }} Suja MobilIndo. Seluruh hak cipta dilindungi. Showroom Otomotif Terpercaya.
        </div>
    </footer>

</body>
</html>
