<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vehicle->brand->name }} {{ $vehicle->model->name }} - Suja MobilIndo</title>
    <meta name="description" content="Detail spesifikasi lengkap {{ $vehicle->brand->name }} {{ $vehicle->model->name }} {{ $vehicle->year }} bergaransi resmi dari Suja MobilIndo.">
    
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

<body class="bg-[#f8f9fa] text-zinc-900 antialiased selection:bg-zinc-900 selection:text-white min-h-screen flex flex-col justify-between">

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

                {{-- BACK TO CATALOG BUTTON --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('vehicles.index') }}"
                       class="text-xs font-bold uppercase tracking-wider text-zinc-900 hover:text-black transition flex items-center gap-2 border border-zinc-900 px-4 py-2 hover:bg-zinc-900 hover:text-white">
                        <span>←</span>
                        <span>Kembali ke Katalog</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex-grow space-y-10">
        
        {{-- HEADER TITLE & PRICE --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-zinc-200">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="bg-[#881337] text-white text-[10px] font-bold uppercase tracking-widest px-2.5 py-0.5">
                        {{ $vehicle->status === 'AVAILABLE' ? 'UNIT TERSEDIA' : ($vehicle->status === 'SOLD' ? 'TERJUAL' : $vehicle->status) }}
                    </span>
                    <span class="text-zinc-400 font-mono-code text-xs">KODE: {{ $vehicle->stock_code }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-zinc-950 uppercase tracking-tight">
                    {{ $vehicle->brand->name }} {{ $vehicle->model->name }} <span class="font-light text-zinc-600">{{ $vehicle->variant }}</span>
                </h1>
                <p class="text-xs text-zinc-500 font-mono-code">
                    Tahun {{ $vehicle->year }} • Lulus Inspeksi 150+ Titik • Garansi Mesin & Dokumen Resmi
                </p>
            </div>

            <div class="text-left md:text-right">
                <span class="text-[11px] text-zinc-400 line-through block font-mono-code">
                    Estimasi Pasar: Rp {{ number_format($vehicle->selling_price * 1.07, 0, ',', '.') }}
                </span>
                <span class="text-3xl sm:text-4xl font-black text-zinc-950 font-mono-code block">
                    Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- MAIN GRID: GALLERY & DETAILS --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- LEFT 7 COLS: PHOTO GALLERY & DESCRIPTION --}}
            <div class="lg:col-span-7 space-y-8">
                
                @php
                    $imageList = $vehicle->images->map(function($img) {
                        return asset('storage/' . $img->image_path);
                    })->values()->toArray();

                    $primaryIdx = 0;
                    if ($vehicle->primaryImage) {
                        $primaryPath = asset('storage/' . $vehicle->primaryImage->image_path);
                        $findIdx = array_search($primaryPath, $imageList);
                        if ($findIdx !== false) {
                            $primaryIdx = $findIdx;
                        }
                    }
                @endphp

                <div class="space-y-4"
                     x-data="{
                        activeIndex: {{ $primaryIdx }},
                        images: {{ json_encode($imageList) }},
                        next() {
                            if (this.images.length > 0) {
                                this.activeIndex = (this.activeIndex + 1) % this.images.length;
                            }
                        },
                        prev() {
                            if (this.images.length > 0) {
                                this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
                            }
                        }
                     }"
                     @keydown.window.left="prev()"
                     @keydown.window.right="next()">
                    
                    @if (count($imageList) > 0)
                        {{-- HERO SLIDER PREVIEW --}}
                        <div class="relative aspect-[16/10] bg-zinc-950 overflow-hidden border border-zinc-200 shadow-md group">
                            
                            {{-- MAIN DISPLAY IMAGE --}}
                            <template x-for="(img, idx) in images" :key="idx">
                                <img :src="img" 
                                     alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}" 
                                     x-show="activeIndex === idx"
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0 scale-98"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="w-full h-full object-cover select-none">
                            </template>

                            {{-- PREVIOUS BUTTON (<) --}}
                            <button @click="prev()" 
                                    x-show="images.length > 1" 
                                    type="button"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/60 hover:bg-black text-white flex items-center justify-center transition opacity-80 group-hover:opacity-100 cursor-pointer z-10"
                                    title="Foto Sebelumnya">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            {{-- NEXT BUTTON (>) --}}
                            <button @click="next()" 
                                    x-show="images.length > 1" 
                                    type="button"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/60 hover:bg-black text-white flex items-center justify-center transition opacity-80 group-hover:opacity-100 cursor-pointer z-10"
                                    title="Foto Berikutnya">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            {{-- COUNTER OVERLAY BADGE --}}
                            <div x-show="images.length > 1" 
                                 class="absolute bottom-4 right-4 bg-black/80 text-white text-xs font-mono-code px-3 py-1 tracking-wider z-10">
                                <span x-text="activeIndex + 1"></span> / <span x-text="images.length"></span>
                            </div>
                        </div>

                        {{-- THUMBNAILS ROW --}}
                        <div class="grid grid-cols-4 sm:grid-cols-6 gap-2">
                            <template x-for="(img, idx) in images" :key="idx">
                                <button type="button" 
                                        @click="activeIndex = idx"
                                        :class="activeIndex === idx ? 'border-zinc-950 ring-1 ring-zinc-950 opacity-100' : 'border-zinc-200 opacity-60 hover:opacity-100'"
                                        class="aspect-[16/10] bg-zinc-100 overflow-hidden border transition cursor-pointer">
                                    <img :src="img" alt="Thumbnail" class="w-full h-full object-cover">
                                </button>
                            </template>
                        </div>
                    @else
                        <div class="aspect-[16/10] bg-white border border-zinc-200 flex flex-col items-center justify-center text-zinc-400">
                            <svg class="w-16 h-16 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs mt-2 font-mono-code">Foto Unit Dalam Proses Dokumentasi</span>
                        </div>
                    @endif
                </div>

                {{-- DESKRIPSI & CATATAN PENJUAL --}}
                @if ($vehicle->description)
                    <div class="bg-white border border-zinc-200 p-8 space-y-3">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-950 border-b border-zinc-100 pb-3">
                            Deskripsi & Catatan Khusus Unit
                        </h3>
                        <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed whitespace-pre-line">
                            {{ $vehicle->description }}
                        </p>
                    </div>
                @endif

            </div>

            {{-- RIGHT 5 COLS: SPECIFICATIONS & CONTACT WIDGET --}}
            <div class="lg:col-span-5 space-y-6">
                
                {{-- SPECIFICATIONS CARD --}}
                <div class="bg-white border border-zinc-200 p-6 sm:p-8 space-y-6">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-zinc-950 border-b border-zinc-100 pb-3">
                        Rincian Spesifikasi Teknis
                    </h3>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Merek</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm">{{ $vehicle->brand->name }}</span>
                        </div>
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Model</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm">{{ $vehicle->model->name }}</span>
                        </div>
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Tahun</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm font-mono-code">{{ $vehicle->year }}</span>
                        </div>
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Transmisi</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm">{{ $vehicle->transmission ?? '-' }}</span>
                        </div>
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Bahan Bakar</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm">{{ $vehicle->fuel_type ?? '-' }}</span>
                        </div>
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Odometer</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm font-mono-code">
                                {{ $vehicle->mileage !== null ? number_format($vehicle->mileage, 0, ',', '.') . ' km' : '-' }}
                            </span>
                        </div>
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Warna Bodi</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm">{{ $vehicle->color ?? '-' }}</span>
                        </div>
                        <div class="p-3 bg-zinc-50 border border-zinc-100">
                            <span class="text-zinc-400 uppercase tracking-wider text-[10px] block">Kapasitas Mesin</span>
                            <span class="text-zinc-950 font-bold mt-0.5 block text-sm font-mono-code">
                                {{ $vehicle->engine_capacity ? number_format($vehicle->engine_capacity) . ' cc' : '-' }}
                            </span>
                        </div>
                    </div>

                    {{-- WHATSAPP CONTACT ACTION --}}
                    @php
                        $waText = rawurlencode("Halo Suja MobilIndo Sales, saya tertarik dengan unit " . $vehicle->brand->name . " " . $vehicle->model->name . " (Kode: " . $vehicle->stock_code . "). Apakah unit masih tersedia untuk dijadwalkan test drive?");
                    @endphp

                    <div class="pt-4 space-y-3">
                        <a href="https://wa.me/6281511424262?text={{ $waText }}" target="_blank"
                           class="w-full text-center bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest py-3.5 block transition shadow-lg">
                            Hubungi Sales via WhatsApp →
                        </a>

                        <div class="flex items-center justify-center gap-3 text-[11px] font-mono-code text-zinc-500 pt-1">
                            <span>✓ Garansi Bebas Banjir</span>
                            <span>&bull;</span>
                            <span>✓ Lulus 150+ Titik Inspeksi</span>
                        </div>
                    </div>
                </div>

            </div>

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
