<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Mobil Bekas Berkualitas - Suja MobilIndo</title>
    <meta name="description" content="Katalog mobil bekas pilihan bergaransi resmi, 150+ titik inspeksi, & penawaran harga terbaik dari Suja MobilIndo.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white min-h-screen flex flex-col justify-between">

    {{-- STICKY NAVBAR --}}
    <header class="sticky top-0 z-50 backdrop-blur-xl bg-white/90 border-b border-slate-200/80 shadow-sm transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white font-black text-xl shadow-md group-hover:scale-105 transition">
                        S
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight text-slate-900">Suja <span class="text-blue-600">MobilIndo</span></span>
                        <span class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 -mt-1">Kualitas Terbaik</span>
                    </div>
                </a>

                {{-- NAV LINKS --}}
                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Beranda</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 1]) }}" class="text-sm font-semibold {{ request('vehicle_type_id') == 1 ? 'text-blue-600' : 'text-slate-600 hover:text-slate-900' }} transition">Mobil</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 2]) }}" class="text-sm font-semibold {{ request('vehicle_type_id') == 2 ? 'text-blue-600' : 'text-slate-600 hover:text-slate-900' }} transition">Motor</a>
                    <a href="{{ route('home') }}#features" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Tentang Kami</a>
                    <a href="{{ route('home') }}#location" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Lokasi</a>
                </nav>

                {{-- ACTIONS --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard') }}"
                       class="hidden sm:inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 px-3 py-2 rounded-lg hover:bg-slate-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Portal Admin
                    </a>
                    <a href="https://wa.me/6281511424262" target="_blank"
                       class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs px-4 py-2.5 rounded-xl shadow-md shadow-emerald-600/20 transition active:scale-[0.98]">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>WhatsApp Sales</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- MAIN CONTAINER --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-grow space-y-6">
        
        {{-- BREADCRUMB --}}
        <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-slate-900 transition">Beranda</a>
            <span>›</span>
            <span class="text-blue-600 font-bold">Katalog Kendaraan</span>
        </div>

        {{-- HERO LIGHT BANNER CARD --}}
        <div class="relative bg-gradient-to-r from-blue-900 to-indigo-900 text-white rounded-3xl p-8 sm:p-10 overflow-hidden shadow-xl">
            <div class="relative z-10 max-w-2xl space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/20 text-blue-300 text-[11px] font-bold tracking-wide uppercase">
                    <span>🚗 🏍️</span> Katalog Resmi Suja MobilIndo
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight">
                    Mobil & Motor Bekas/Baru <span class="text-blue-400">Berkualitas Tinggi</span>
                </h1>
                <p class="text-xs sm:text-sm text-slate-300 leading-relaxed font-normal">
                    Seluruh unit telah lulus inspeksi 150+ titik ketat, bebas banjir & kecelakaan besar, serta jaminan legalitas dokumen 100% sah.
                </p>
            </div>
        </div>

        {{-- FULL-WIDTH TOP FILTER BAR --}}
        <div class="bg-white border border-slate-200/80 p-6 sm:p-8 rounded-3xl shadow-sm space-y-6">
            <form method="GET" action="{{ route('vehicles.index') }}" class="space-y-6">
                
                {{-- ROW 1: SEARCH & SORT BAR --}}
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                    {{-- SEARCH INPUT --}}
                    <div class="relative flex-1 max-w-lg">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari merek, model, atau tipe mobil..."
                               class="w-full pl-10 pr-4 py-2.5 text-xs bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600 text-slate-800 placeholder-slate-400">
                    </div>

                    {{-- SORT & RESET --}}
                    <div class="flex items-center gap-4 justify-between md:justify-end">
                        @if(request()->hasAny(['search', 'brand_id', 'vehicle_type_id', 'transmission', 'fuel_type', 'year_min', 'price_max', 'sort']))
                            <a href="{{ route('vehicles.index') }}" class="text-xs font-bold text-rose-500 hover:text-rose-600 hover:underline transition flex items-center gap-1">
                                ✕ Reset Filter
                            </a>
                        @endif

                        <div class="flex items-center gap-2 text-xs text-slate-600">
                            <span class="font-medium">Urutkan:</span>
                            <select name="sort" onchange="this.form.submit()" class="bg-slate-50 border border-slate-200 text-slate-800 text-xs font-semibold rounded-2xl px-4 py-2 focus:bg-white focus:outline-none focus:border-blue-600">
                                <option value="">Terbaru</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
                                <option value="year_desc" {{ request('sort') == 'year_desc' ? 'selected' : '' }}>Tahun Terbaru</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- ROW 2: DETAILED FILTER PILLS & INPUTS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    {{-- KATEGORI --}}
                    <div class="space-y-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider">Kategori Kendaraan</label>
                        <div class="flex gap-1.5">
                            <a href="{{ route('vehicles.index', array_merge(request()->except('vehicle_type_id'), ['vehicle_type_id' => ''])) }}"
                               class="flex-1 text-center py-2 px-3 rounded-xl text-xs font-semibold border transition {{ !request('vehicle_type_id') ? 'bg-blue-600 text-white border-blue-600 shadow-sm shadow-blue-600/20' : 'bg-slate-50 text-slate-600 border-slate-200/80 hover:bg-slate-100 hover:text-slate-900' }}">
                                Semua
                            </a>
                            @foreach ($vehicleTypes as $type)
                                <a href="{{ route('vehicles.index', array_merge(request()->except('vehicle_type_id'), ['vehicle_type_id' => $type->id])) }}"
                                   class="flex-1 text-center py-2 px-3 rounded-xl text-xs font-semibold border transition {{ request('vehicle_type_id') == $type->id ? 'bg-blue-600 text-white border-blue-600 shadow-sm shadow-blue-600/20' : 'bg-slate-50 text-slate-600 border-slate-200/80 hover:bg-slate-100 hover:text-slate-900' }}">
                                    {{ $type->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- MEREK --}}
                    <div class="space-y-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider">Merek Kendaraan</label>
                        <div class="flex flex-wrap gap-1.5">
                            <a href="{{ route('vehicles.index', array_merge(request()->except('brand_id'), ['brand_id' => ''])) }}"
                               class="px-3 py-1.5 rounded-xl text-xs font-semibold border transition {{ !request('brand_id') ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-600 border-slate-200/80 hover:bg-slate-100 hover:text-slate-900' }}">
                                Semua
                            </a>
                            @foreach ($brands as $brand)
                                <a href="{{ route('vehicles.index', array_merge(request()->except('brand_id'), ['brand_id' => $brand->id])) }}"
                                   class="px-3 py-1.5 rounded-xl text-xs font-semibold border transition {{ request('brand_id') == $brand->id ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-600 border-slate-200/80 hover:bg-slate-100 hover:text-slate-900' }}">
                                    {{ $brand->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- TRANSMISI & BAHAN BAKAR --}}
                    <div class="space-y-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider">Transmisi & Bahan Bakar</label>
                        <div class="flex flex-wrap gap-1.5">
                            @foreach(['CVT' => 'CVT', 'Otomatis' => 'Otomatis', 'Manual' => 'Manual'] as $key => $label)
                                <a href="{{ route('vehicles.index', array_merge(request()->except('transmission'), ['transmission' => request('transmission') == $key ? '' : $key])) }}"
                                   class="px-2.5 py-1.5 rounded-xl text-xs font-semibold border transition {{ request('transmission') == $key ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-600 border-slate-200/80 hover:bg-slate-100 hover:text-slate-900' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                            @foreach(['Bensin' => 'Bensin', 'Diesel' => 'Diesel'] as $key => $label)
                                <a href="{{ route('vehicles.index', array_merge(request()->except('fuel_type'), ['fuel_type' => request('fuel_type') == $key ? '' : $key])) }}"
                                   class="px-2.5 py-1.5 rounded-xl text-xs font-semibold border transition {{ request('fuel_type') == $key ? 'bg-slate-900 text-white border-slate-900' : 'bg-slate-50 text-slate-600 border-slate-200/80 hover:bg-slate-100 hover:text-slate-900' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    {{-- BUDGET MAKSIMUM & ACTION --}}
                    <div class="space-y-2">
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider">Budget Maksimum (Rp)</label>
                        <div class="flex gap-2">
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Contoh: 250000000"
                                   class="w-full px-3.5 py-2 text-xs bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-blue-600 focus:ring-1 focus:ring-blue-600 focus:outline-none text-slate-800 placeholder-slate-400">
                            <button type="submit" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md transition active:scale-[0.98] shrink-0">
                                Cari
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>

        {{-- CATALOG CONTENT GRID (FULL WIDTH) --}}
        <div class="space-y-6">
            <div class="flex items-center justify-between text-xs text-slate-500 font-medium">
                <div>
                    Menampilkan <span class="font-bold text-slate-900">{{ $vehicles->count() }}</span> unit kendaraan
                </div>
            </div>

                {{-- VEHICLE CARDS GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($vehicles as $vehicle)
                        <div class="bg-white border border-slate-200/80 rounded-3xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden flex flex-col justify-between group">
                            
                            <div>
                                {{-- IMAGE CONTAINER WITH BADGES --}}
                                <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                                    @if ($vehicle->primaryImage)
                                        <img src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                                             alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}"
                                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                                            <span class="text-xs font-semibold">Foto Tidak Tersedia</span>
                                        </div>
                                    @endif

                                    {{-- TERSEDIA BADGE (LEFT TOP) --}}
                                    <div class="absolute top-3 left-3 bg-emerald-600 text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow">
                                        Tersedia
                                    </div>

                                    {{-- MOBIL BEKAS TAG (BOTTOM LEFT) --}}
                                    <div class="absolute bottom-3 left-3 bg-slate-900/80 backdrop-blur-md text-slate-200 text-[9px] font-bold tracking-widest uppercase px-2 py-0.5 rounded border border-white/10">
                                        Unit Terinspeksi
                                    </div>
                                </div>

                                {{-- VEHICLE DETAILS --}}
                                <div class="p-5 space-y-3">
                                    <div>
                                        <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest block">
                                            {{ strtoupper($vehicle->brand->name) }} • {{ $vehicle->year }}
                                        </span>
                                        <h3 class="text-base font-extrabold text-slate-900 tracking-tight leading-snug group-hover:text-blue-600 transition">
                                            <a href="{{ route('vehicles.show', $vehicle) }}">
                                                {{ $vehicle->brand->name }} {{ $vehicle->model->name }}
                                            </a>
                                        </h3>
                                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                                            {{ $vehicle->variant ?? 'Standard' }}
                                        </p>
                                    </div>

                                    {{-- SPECIFICATION HIGHLIGHTS TABLE (TAHUN | JARAK | TRANS/BBM) --}}
                                    <div class="grid grid-cols-3 gap-1 bg-slate-50 p-2.5 rounded-2xl text-center border border-slate-100">
                                        <div>
                                            <span class="text-[9px] font-semibold text-slate-400 uppercase block">📅 Tahun</span>
                                            <span class="text-xs font-bold text-slate-800 mt-0.5 block">{{ $vehicle->year }}</span>
                                        </div>
                                        <div>
                                            <span class="text-[9px] font-semibold text-slate-400 uppercase block">🧭 Jarak</span>
                                            <span class="text-xs font-bold text-slate-800 mt-0.5 block">
                                                {{ $vehicle->mileage ? number_format($vehicle->mileage, 0, ',', '.') . ' km' : '-' }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-[9px] font-semibold text-slate-400 uppercase block">🛞 Trans/BBM</span>
                                            <span class="text-xs font-bold text-slate-800 mt-0.5 block">
                                                {{ $vehicle->transmission ?? 'CVT' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- FOOTER PRICE & ACTIONS --}}
                            <div class="p-5 pt-0 space-y-3">
                                <div>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Harga Penawaran</span>
                                    <span class="text-lg font-black text-slate-900 tracking-tight block">
                                        Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- ACTION BUTTONS: LIHAT DETAIL + WHATSAPP ICON BUTTON --}}
                                @php
                                    $waMsg = rawurlencode("Halo Suja MobilIndo, saya tertarik dengan unit " . $vehicle->brand->name . " " . $vehicle->model->name . " " . $vehicle->year);
                                @endphp
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('vehicles.show', $vehicle) }}"
                                       class="flex-1 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs py-2.5 rounded-xl text-center transition flex items-center justify-center gap-1 shadow-sm">
                                        <span>Lihat Detail</span>
                                        <span>→</span>
                                    </a>

                                    <a href="https://wa.me/6281511424262?text={{ $waMsg }}" target="_blank" title="Chat via WhatsApp"
                                       class="p-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-xl transition border border-emerald-200/60 shrink-0">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200">
                            <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-3 text-2xl">
                                🚘
                            </div>
                            <h3 class="font-bold text-slate-800 text-base">Tidak Ada Mobil Ditemukan</h3>
                            <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                                Coba ubah kata kunci pencarian atau reset filter di bagian atas.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINATION --}}
                <div class="pt-6">
                    {{ $vehicles->links() }}
                </div>

        </div>

    </main>

    {{-- FOOTER --}}
    <footer id="contact" class="bg-slate-900 text-slate-400 text-xs py-16 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-10">
            
            <div class="space-y-4 md:col-span-2">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold text-lg">S</div>
                    <span class="text-lg font-bold text-white">Suja MobilIndo</span>
                </div>
                <p class="max-w-sm text-slate-400 leading-relaxed">
                    Penyedia kendaraan berkualitas tinggi dengan standar inspeksi terlengkap. Solusi transaksi jual beli mobil aman, transparan, dan terpercaya.
                </p>
            </div>

            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Navigasi</h4>
                <ul class="space-y-2.5 font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('vehicles.index') }}" class="hover:text-white transition">Katalog Mobil Ready</a></li>
                    <li><a href="{{ route('admin.dashboard') }}" class="hover:text-white transition">Halaman Administrator</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold text-white uppercase tracking-wider mb-4">Hubungi Kami</h4>
                <ul class="space-y-2.5 font-medium">
                    <li>
                        <a href="https://www.google.com/maps/search/?api=1&query=-7.043806,107.951694" target="_blank" class="hover:text-white transition flex items-center gap-1.5">
                            <span>📍</span> Showroom Suja MobilIndo
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/6281511424262" target="_blank" class="hover:text-emerald-400 transition flex items-center gap-1.5">
                            <span>💬</span> WhatsApp: +62 815-1142-4262
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 mt-12 border-t border-slate-800 text-center text-slate-500">
            &copy; {{ date('Y') }} Suja MobilIndo. All rights reserved. Designed with precision.
        </div>
    </footer>

</body>
</html>

