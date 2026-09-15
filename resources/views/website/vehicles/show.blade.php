<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vehicle->brand->name }} {{ $vehicle->model->name }} - Suja MobilIndo</title>
    
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

                {{-- BACK BUTTON --}}
                <a href="{{ route('vehicles.index') }}" class="text-xs font-semibold text-slate-600 hover:text-slate-900 transition flex items-center gap-2 bg-slate-100 px-4 py-2 rounded-xl border border-slate-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Katalog
                </a>
            </div>
        </div>
    </header>

    {{-- CONTENT --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 w-full flex-grow space-y-10">
        
        {{-- VEHICLE HEADER & TITLE --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 border-b border-slate-200">
            <div>
                <div class="flex items-center gap-2">
                    <span class="text-xs font-extrabold text-blue-600 uppercase tracking-widest">{{ $vehicle->brand->name }}</span>
                    <span class="text-slate-300">•</span>
                    <span class="text-xs font-mono text-slate-500">Kode Unit: {{ $vehicle->stock_code }}</span>
                </div>
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mt-1">
                    {{ $vehicle->brand->name }} {{ $vehicle->model->name }} {{ $vehicle->variant }}
                </h1>
                <p class="text-xs text-slate-500 mt-1">Tahun Pembuatan {{ $vehicle->year }} • Terinspeksi 150+ Titik & Garansi Resmi Suja MobilIndo</p>
            </div>

            <div class="text-left md:text-right">
                <span class="text-xs text-slate-500 uppercase font-semibold block">Harga Penawaran</span>
                <span class="text-3xl sm:text-4xl font-black text-emerald-600">
                    Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        {{-- MAIN GRID: GALLERY & DETAILS --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            {{-- LEFT 2 COLS: PHOTO GALLERY & DESKRIPSI --}}
            <div class="lg:col-span-2 space-y-10">
                
                {{-- PHOTO GALLERY SHOWCASE WITH INTERACTIVE SLIDER --}}
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
                    
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span>📷</span> Galeri Foto Unit
                        </h2>
                    </div>

                    @if (count($imageList) > 0)
                        {{-- HERO SLIDER PREVIEW --}}
                        <div class="relative aspect-[16/9] bg-slate-900 rounded-3xl overflow-hidden border border-slate-200/80 shadow-xl group">
                            
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
                                    class="absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-2xl bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center backdrop-blur-md transition-all opacity-80 group-hover:opacity-100 hover:scale-110 active:scale-95 shadow-lg border border-white/20 cursor-pointer z-10"
                                    title="Foto Sebelumnya (Panah Kiri)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            {{-- NEXT BUTTON (>) --}}
                            <button @click="next()" 
                                    x-show="images.length > 1" 
                                    type="button"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-2xl bg-slate-900/60 hover:bg-slate-900 text-white flex items-center justify-center backdrop-blur-md transition-all opacity-80 group-hover:opacity-100 hover:scale-110 active:scale-95 shadow-lg border border-white/20 cursor-pointer z-10"
                                    title="Foto Berikutnya (Panah Kanan)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            {{-- COUNTER OVERLAY BADGE --}}
                            <div x-show="images.length > 1" 
                                 class="absolute bottom-4 right-4 bg-slate-900/80 backdrop-blur-md text-white text-xs font-extrabold px-3.5 py-1.5 rounded-xl border border-white/20 shadow-md tracking-wider z-10">
                                <span x-text="activeIndex + 1"></span> / <span x-text="images.length"></span>
                            </div>
                        </div>

                        {{-- THUMBNAILS GRID WITH SELECTION HIGHLIGHT --}}
                        <div class="grid grid-cols-4 sm:grid-cols-6 gap-3">
                            <template x-for="(img, idx) in images" :key="idx">
                                <button type="button" 
                                        @click="activeIndex = idx"
                                        :class="activeIndex === idx ? 'border-blue-600 ring-2 ring-blue-600/30 scale-105 opacity-100' : 'border-slate-200/80 opacity-70 hover:opacity-100 hover:border-slate-400'"
                                        class="aspect-[16/10] bg-white rounded-xl overflow-hidden border transition-all duration-200 cursor-pointer shadow-xs">
                                    <img :src="img" alt="Thumbnail" class="w-full h-full object-cover">
                                </button>
                            </template>
                        </div>
                    @else
                        <div class="aspect-[16/9] bg-white rounded-3xl border border-slate-200 flex flex-col items-center justify-center text-slate-400">
                            <svg class="w-16 h-16 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-xs mt-2 font-medium">Foto Unit Belum Tersedia</span>
                        </div>
                    @endif
                </div>

                {{-- DESKRIPSI --}}
                @if ($vehicle->description)
                    <div class="bg-white border border-slate-200/80 p-8 rounded-3xl space-y-4 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                            <span>📝</span> Deskripsi & Catatan Penjual
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">
                            {{ $vehicle->description }}
                        </p>
                    </div>
                @endif

            </div>

            {{-- RIGHT 1 COL: SPECIFICATIONS & CONTACT WIDGET --}}
            <div class="space-y-6">
                
                {{-- SPECIFICATIONS GRID CARD --}}
                <div class="bg-white border border-slate-200/80 p-6 rounded-3xl space-y-6 shadow-sm">
                    <h3 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3">Spesifikasi Teknis</h3>

                    <div class="grid grid-cols-2 gap-4 text-xs">
                        <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                            <span class="text-slate-400 uppercase font-semibold text-[10px] block">Tahun</span>
                            <span class="text-slate-900 font-bold mt-0.5 block text-sm">{{ $vehicle->year }}</span>
                        </div>
                        <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                            <span class="text-slate-400 uppercase font-semibold text-[10px] block">Transmisi</span>
                            <span class="text-slate-900 font-bold mt-0.5 block text-sm">{{ $vehicle->transmission ?? '-' }}</span>
                        </div>
                        <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                            <span class="text-slate-400 uppercase font-semibold text-[10px] block">Bahan Bakar</span>
                            <span class="text-slate-900 font-bold mt-0.5 block text-sm">{{ $vehicle->fuel_type ?? '-' }}</span>
                        </div>
                        <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                            <span class="text-slate-400 uppercase font-semibold text-[10px] block">Kilometer (KM)</span>
                            <span class="text-slate-900 font-bold mt-0.5 block text-sm">
                                {{ $vehicle->mileage !== null ? number_format($vehicle->mileage, 0, ',', '.') . ' km' : '-' }}
                            </span>
                        </div>
                        <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                            <span class="text-slate-400 uppercase font-semibold text-[10px] block">Warna</span>
                            <span class="text-slate-900 font-bold mt-0.5 block text-sm">{{ $vehicle->color ?? '-' }}</span>
                        </div>
                        <div class="bg-slate-50 p-3.5 rounded-2xl border border-slate-100">
                            <span class="text-slate-400 uppercase font-semibold text-[10px] block">Status Stok</span>
                            <span class="text-emerald-600 font-bold mt-0.5 block text-sm uppercase">{{ $vehicle->status }}</span>
                        </div>
                    </div>
                </div>

                {{-- CONTACT SALES WIDGET --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200/80 p-6 rounded-3xl space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center text-white text-xl font-bold shadow-md">
                            💬
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 text-sm">Tertarik dengan Mobil Ini?</h4>
                            <p class="text-xs text-slate-600">Hubungi sales Suja MobilIndo untuk booking unit & test drive.</p>
                        </div>
                    </div>

                    @php
                        $waText = rawurlencode("Halo Suja MobilIndo Sales, saya tertarik dengan unit " . $vehicle->brand->name . " " . $vehicle->model->name . " (ID: " . $vehicle->stock_code . "). Apakah unit masih ready?");
                    @endphp

                    <a href="https://wa.me/6281511424262?text={{ $waText }}" target="_blank"
                       class="w-full inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm py-3.5 px-4 rounded-2xl shadow-lg shadow-emerald-600/20 transition active:scale-[0.98]">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Tanya Sales via WhatsApp</span>
                    </a>
                </div>

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
