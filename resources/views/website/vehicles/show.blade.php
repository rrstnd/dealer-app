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

                {{-- BACK TO CATALOG BUTTON --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('vehicles.index') }}"
                       class="text-[11px] sm:text-xs font-bold uppercase tracking-wider text-zinc-900 hover:text-black transition flex items-center gap-1.5 border border-zinc-900 px-3 py-1.5 sm:px-4 sm:py-2 hover:bg-zinc-900 hover:text-white shrink-0">
                        <span>←</span>
                        <span><span class="hidden sm:inline">Kembali ke </span>Katalog</span>
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
                        lightboxOpen: false,
                        images: {{ json_encode($imageList) }},
                        touchStartX: 0,
                        touchEndX: 0,
                        openLightbox(index) {
                            this.activeIndex = index;
                            this.lightboxOpen = true;
                            document.body.style.overflow = 'hidden';
                        },
                        closeLightbox() {
                            this.lightboxOpen = false;
                            document.body.style.overflow = '';
                        },
                        next() {
                            if (this.images.length > 0) {
                                this.activeIndex = (this.activeIndex + 1) % this.images.length;
                            }
                        },
                        prev() {
                            if (this.images.length > 0) {
                                this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
                            }
                        },
                        handleSwipe() {
                            const swipeThreshold = 50; // minimum swipe distance in pixels
                            if (this.touchEndX < this.touchStartX - swipeThreshold) {
                                this.next(); // Swipe left to go next
                            }
                            if (this.touchEndX > this.touchStartX + swipeThreshold) {
                                this.prev(); // Swipe right to go prev
                            }
                        }
                     }"
                     @keydown.window.left="if(lightboxOpen) prev()"
                     @keydown.window.right="if(lightboxOpen) next()"
                     @keydown.window.escape="if(lightboxOpen) closeLightbox()">
                    
                    @php $imgCount = count($imageList); @endphp
                    @if ($imgCount > 0)
                        {{-- BIG HERO IMAGE --}}
                        <div class="relative w-full aspect-[4/5] md:aspect-[3/4] bg-zinc-100 cursor-pointer overflow-hidden group"
                             @click="openLightbox(0)">
                            <img src="{{ $imageList[$primaryIdx] ?? $imageList[0] }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                            
                            {{-- OVERLAY GRADIENT FOR TEXT --}}
                            <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-transparent to-black/40 pointer-events-none transition duration-500 group-hover:bg-black/10"></div>

                            {{-- TOP LEFT TEXT OVERLAY --}}
                            <div class="absolute top-6 left-6 text-white pointer-events-none drop-shadow-lg pr-24">
                                <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tighter">{{ $vehicle->brand->name ?? '' }}</h2>
                                <p class="text-xl md:text-3xl font-bold uppercase tracking-tight mt-1 leading-none">{{ $vehicle->model->name ?? '' }}</p>
                                @if($vehicle->variant)
                                    <p class="text-sm md:text-lg font-medium text-zinc-200 mt-2 uppercase tracking-widest">{{ $vehicle->variant }}</p>
                                @endif
                            </div>

                            {{-- TOP RIGHT TEXT OVERLAY --}}
                            <div class="absolute top-6 right-6 flex flex-col items-end gap-1 pointer-events-none drop-shadow-lg">
                                <span class="bg-[#2563eb] text-white px-3 py-1 text-2xl md:text-3xl font-black">{{ $vehicle->year }}</span>
                                <span class="text-white text-xl md:text-2xl font-bold tracking-widest drop-shadow-md mt-1">
                                    {{ $vehicle->transmission === 'Automatic' ? 'A/T' : ($vehicle->transmission === 'Manual' ? 'M/T' : strtoupper($vehicle->transmission ?? '')) }}
                                </span>
                            </div>

                            {{-- BOTTOM RIGHT (+X FOTO) --}}
                            @if($imgCount > 1)
                                <div class="absolute bottom-6 right-6 bg-black/70 backdrop-blur-md px-5 py-3 border border-white/20 text-white font-bold tracking-widest text-sm md:text-base flex items-center gap-2 transition group-hover:bg-white group-hover:text-black cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    LIHAT {{ $imgCount }} FOTO
                                </div>
                            @endif
                        </div>

                        {{-- FULLSCREEN LIGHTBOX MODAL --}}
                        <div x-show="lightboxOpen" 
                             style="display: none;"
                             class="fixed inset-0 z-50 bg-black/95 flex items-center justify-center"
                             @click.self="closeLightbox()"
                             @touchstart="touchStartX = $event.changedTouches[0].screenX"
                             @touchend="touchEndX = $event.changedTouches[0].screenX; handleSwipe()"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">
                             


                             {{-- PREV BUTTON --}}
                             <button @click="prev()" type="button" x-show="images.length > 1" class="absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-12 h-12 md:w-16 md:h-16 bg-black/60 hover:bg-black/90 text-white border border-white/20 flex items-center justify-center rounded-full transition z-[60] cursor-pointer backdrop-blur-sm shadow-xl">
                                 <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                 </svg>
                             </button>

                             {{-- IMAGE DISPLAY --}}
                             <template x-for="(img, idx) in images" :key="idx">
                                 <img :src="img" 
                                      x-show="activeIndex === idx"
                                      x-transition:enter="transition ease-out duration-300"
                                      x-transition:enter-start="opacity-0 scale-95"
                                      x-transition:enter-end="opacity-100 scale-100"
                                      class="max-w-[90vw] max-h-[90vh] object-contain select-none shadow-2xl">
                             </template>

                             {{-- NEXT BUTTON --}}
                             <button @click="next()" type="button" x-show="images.length > 1" class="absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-12 h-12 md:w-16 md:h-16 bg-black/60 hover:bg-black/90 text-white border border-white/20 flex items-center justify-center rounded-full transition z-[60] cursor-pointer backdrop-blur-sm shadow-xl">
                                 <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                 </svg>
                             </button>

                             {{-- COUNTER --}}
                             <div class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/70 font-mono-code text-sm tracking-widest bg-black/50 px-4 py-2 rounded-full">
                                 <span x-text="activeIndex + 1"></span> / <span x-text="images.length"></span>
                             </div>
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
