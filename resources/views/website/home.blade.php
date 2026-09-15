<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suja MobilIndo - Temukan Mobil Impian Berkualitas</title>
    <meta name="description" content="Dealer mobil bekas dan baru terpercaya dengan garansi resmi, inspeksi 150+ titik, dan penawaran harga terbaik.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-blue-600 selection:text-white">

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
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-900 hover:text-blue-600 transition">Beranda</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 1]) }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">Mobil</a>
                    <a href="{{ route('vehicles.index', ['vehicle_type_id' => 2]) }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition">Motor</a>
                    <a href="#features" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Tentang Kami</a>
                    <a href="#location" class="text-sm font-medium text-slate-600 hover:text-slate-900 transition">Lokasi</a>
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

    {{-- HERO SECTION --}}
    <section class="relative pt-12 pb-24 overflow-hidden bg-gradient-to-b from-blue-50/50 via-white to-slate-50">
        {{-- SOFT LIGHT GLOW --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-blue-400/10 blur-[120px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-6">
                
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-100/80 border border-blue-200 text-blue-700 text-xs font-bold tracking-wide uppercase shadow-sm">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-ping"></span>
                    Showroom Mobil & Motor Bergaransi Resmi
                </div>

                <h1 class="text-4xl sm:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                    Temukan Mobil & Motor Impian dengan <span class="bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-800 bg-clip-text text-transparent">Inspeksi Kualitas Terbaik</span>
                </h1>

                <p class="text-base sm:text-lg text-slate-600 leading-relaxed font-normal">
                    Mobil & Motor siap pakai, Liburan langsung Gas!!! Transaksi aman, legalitas terjamin & harga bisa di nego.
                </p>
            </div>

            {{-- QUICK SEARCH BAR --}}
            <div class="mt-10 max-w-4xl mx-auto bg-white border border-slate-200/80 p-4 sm:p-6 rounded-3xl shadow-xl shadow-slate-200/50">
                <form action="{{ route('vehicles.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                    
                    {{-- SEARCH INPUT --}}
                    <div class="sm:col-span-2 relative">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Cari Kendaraan (Mobil / Motor)</label>
                        <input type="text" name="search" placeholder="Cari Merk, Model (e.g. Honda Civic, NMAX)..."
                               class="w-full bg-slate-50 border border-slate-200 text-slate-800 placeholder-slate-400 text-sm rounded-xl px-4 py-2.5 focus:bg-white focus:outline-none focus:border-blue-600 focus:ring-1 focus:ring-blue-600">
                    </div>

                    {{-- BRAND SELECT --}}
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Pilih Merk</label>
                        <select name="brand_id" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl px-3 py-2.5 focus:bg-white focus:outline-none focus:border-blue-600">
                            <option value="">Semua Merk</option>
                        </select>
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm py-2.5 px-5 rounded-xl shadow-md transition duration-150 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Cari Unit</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>


    {{-- FEATURED VEHICLES CATALOG GRID --}}
    <section class="py-20 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            {{-- SECTION TITLE --}}
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
                <div>
                    <span class="text-xs font-extrabold text-blue-600 uppercase tracking-widest">Koleksi Pilihan</span>
                    <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1">Mobil Ready Stock Terbaru</h2>
                </div>
                <a href="{{ route('vehicles.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition">
                    <span>Lihat Semua Katalog</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>

            {{-- VEHICLES GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($vehicles as $vehicle)
                    <div class="group bg-white rounded-3xl border border-slate-200/80 overflow-hidden hover:shadow-xl hover:border-slate-300 transition duration-300 hover:-translate-y-1 flex flex-col justify-between">
                        
                        <div>
                            {{-- IMAGE CONTAINER --}}
                            <div class="relative aspect-[16/10] bg-slate-100 overflow-hidden">
                                @if ($vehicle->primaryImage)
                                    <img src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                                         alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-100">
                                        <svg class="w-12 h-12 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <span class="text-xs mt-2 font-medium">Foto Tidak Tersedia</span>
                                    </div>
                                @endif

                                {{-- YEAR BADGE --}}
                                <div class="absolute top-4 left-4 bg-slate-900/80 backdrop-blur-md text-white text-[11px] font-bold px-3 py-1 rounded-full shadow">
                                    Tahun {{ $vehicle->year }}
                                </div>
                            </div>

                            {{-- BODY INFO --}}
                            <div class="p-6 space-y-4">
                                <div>
                                    <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">{{ $vehicle->brand->name }}</span>
                                    <h3 class="text-xl font-bold text-slate-900 mt-0.5 group-hover:text-blue-600 transition">
                                        <a href="{{ route('vehicles.show', $vehicle) }}">
                                            {{ $vehicle->model->name }}
                                        </a>
                                    </h3>
                                </div>

                                {{-- QUICK ATTRIBUTES --}}
                                <div class="grid grid-cols-2 gap-2 text-xs text-slate-500 py-3 border-y border-slate-100">
                                    <div class="flex items-center gap-2">
                                        <span>⚙️ {{ $vehicle->transmission ?? 'Automatic' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span>⛽ {{ $vehicle->fuel_type ?? 'Bensin' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- FOOTER PRICE & ACTION --}}
                        <div class="p-6 pt-0 flex items-center justify-between gap-4">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-semibold">Harga Tunai</span>
                                <span class="text-lg font-black text-slate-900">
                                    Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                                </span>
                            </div>

                            <a href="{{ route('vehicles.show', $vehicle) }}"
                               class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition shadow-sm">
                                Detail Unit
                            </a>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-slate-200">
                        <div class="w-16 h-16 bg-slate-100 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            🚗
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Belum Ada Kendaraan Dipublikasikan</h3>
                        <p class="text-xs text-slate-500 mt-1">Silakan cek kembali nanti atau hubungi customer service kami.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- TENTANG KAMI SECTION --}}
    <section id="features" class="py-24 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
            
            {{-- HEADER TENTANG KAMI --}}
            <div class="text-center max-w-3xl mx-auto space-y-4">
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-extrabold uppercase tracking-widest">
                    Tentang Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                    Suja Mobilindo
                </h2>
                <p class="text-base sm:text-lg font-bold text-blue-600">
                    Temukan kendaraan pilihan yang sesuai dengan kebutuhan dan gaya hidup Anda.
                </p>
                <div class="text-sm text-slate-600 leading-relaxed space-y-3 pt-2">
                    <p>
                        Suja Mobilindo adalah showroom kendaraan yang menyediakan berbagai pilihan <strong class="text-slate-900 font-semibold">mobil dan motor</strong> dengan mengutamakan kualitas, kondisi kendaraan, serta pelayanan yang terpercaya.
                    </p>
                    <p>
                        Kami hadir untuk membantu pelanggan menemukan kendaraan yang tepat dengan proses yang mudah, transparan, dan nyaman.
                    </p>
                </div>
            </div>

            {{-- PILIHAN KENDARAAN SECTION --}}
            <div class="bg-slate-50 border border-slate-200/80 rounded-3xl p-8 sm:p-10 space-y-8 shadow-xs">
                <div class="text-center max-w-xl mx-auto">
                    <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">Pilihan Kendaraan</h3>
                    <p class="text-xs text-slate-500 mt-1">Kami menyediakan berbagai tipe kendaraan terbaik sesuai kebutuhan Anda</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- MOBIL CARD --}}
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                                🚗
                            </div>
                            <div>
                                <h4 class="text-lg font-extrabold text-slate-900">Pilihan Mobil</h4>
                                <p class="text-xs text-slate-400">Armada roda empat berkualitas</p>
                            </div>
                        </div>
                        <ul class="grid grid-cols-2 gap-3 text-xs font-semibold text-slate-700">
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-blue-600">✓</span> Mobil Keluarga
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-blue-600">✓</span> City Car
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-blue-600">✓</span> Sedan
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-blue-600">✓</span> SUV
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-blue-600">✓</span> MPV
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-blue-600">✓</span> Mobil Niaga
                            </li>
                        </ul>
                    </div>

                    {{-- MOTOR CARD --}}
                    <div class="bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                        <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl font-bold">
                                🏍️
                            </div>
                            <div>
                                <h4 class="text-lg font-extrabold text-slate-900">Pilihan Motor</h4>
                                <p class="text-xs text-slate-400">Armada roda dua pilihan</p>
                            </div>
                        </div>
                        <ul class="grid grid-cols-2 gap-3 text-xs font-semibold text-slate-700">
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-indigo-600">✓</span> Motor Matic
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-indigo-600">✓</span> Motor Bebek
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-indigo-600">✓</span> Motor Sport
                            </li>
                            <li class="flex items-center gap-2 bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                                <span class="text-indigo-600">✓</span> Kebutuhan Harian
                            </li>
                        </ul>
                    </div>
                </div>

                <p class="text-xs text-center text-slate-500 max-w-2xl mx-auto pt-2 leading-relaxed">
                    Setiap kendaraan yang tersedia akan dilengkapi dengan informasi mengenai <strong class="text-slate-800">spesifikasi, kondisi, harga, foto, dan status kendaraan</strong>, sehingga pelanggan dapat melihat informasi dengan lebih mudah sebelum melakukan pembelian.
                </p>
            </div>

            {{-- MENGAPA MEMILIH SUJA MOBILINDO? --}}
            <div class="space-y-10">
                <div class="text-center max-w-xl mx-auto">
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Mengapa Memilih Suja Mobilindo?</h3>
                    <p class="text-xs text-slate-500 mt-1">Alasan utama kepercayaan pelanggan pada showroom kami</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- ITEM 1 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-blue-500 transition duration-200 space-y-3">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-bold text-lg">🚘</div>
                        <h4 class="text-base font-bold text-slate-900">Pilihan Kendaraan Beragam</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Berbagai jenis mobil dan motor tersedia untuk memenuhi kebutuhan pelanggan.</p>
                    </div>

                    {{-- ITEM 2 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-blue-500 transition duration-200 space-y-3">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-bold text-lg">📄</div>
                        <h4 class="text-base font-bold text-slate-900">Informasi Transparan</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Kami memberikan informasi kendaraan secara jelas, mulai dari spesifikasi hingga kondisi kendaraan.</p>
                    </div>

                    {{-- ITEM 3 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-blue-500 transition duration-200 space-y-3">
                        <div class="w-10 h-10 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center font-bold text-lg">🏷️</div>
                        <h4 class="text-base font-bold text-slate-900">Harga Kompetitif</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Kami berusaha memberikan harga yang sesuai dengan kondisi dan kualitas kendaraan.</p>
                    </div>

                    {{-- ITEM 4 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-blue-500 transition duration-200 space-y-3">
                        <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center font-bold text-lg">🤝</div>
                        <h4 class="text-base font-bold text-slate-900">Pelayanan Ramah</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Tim kami siap membantu pelanggan dalam mencari dan memilih kendaraan yang sesuai.</p>
                    </div>

                    {{-- ITEM 5 --}}
                    <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs hover:border-blue-500 transition duration-200 space-y-3 sm:col-span-2 lg:col-span-1">
                        <div class="w-10 h-10 bg-sky-50 text-sky-600 rounded-xl flex items-center justify-center font-bold text-lg">⚡</div>
                        <h4 class="text-base font-bold text-slate-900">Proses Mudah</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Nikmati proses pencarian kendaraan yang lebih praktis dan nyaman.</p>
                    </div>
                </div>
            </div>

            {{-- KOMITMEN KAMI (BANNER) --}}
            <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 text-white p-8 sm:p-12 rounded-3xl shadow-xl flex flex-col sm:flex-row items-center justify-between gap-8 text-center sm:text-left relative overflow-hidden">
                <div class="space-y-3 max-w-2xl relative z-10">
                    <span class="text-xs font-bold text-blue-400 uppercase tracking-widest">Komitmen Kami</span>
                    <h3 class="text-xl sm:text-2xl font-black text-white tracking-tight">Kepuasan dan Kepercayaan Pelanggan Adalah Prioritas Utama</h3>
                    <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                        Kami berkomitmen untuk memberikan pelayanan terbaik serta membantu setiap pelanggan mendapatkan kendaraan yang sesuai dengan kebutuhan dan budget mereka.
                    </p>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/15 shrink-0 text-center relative z-10">
                    <span class="text-lg font-black text-white block">Suja Mobilindo</span>
                    <span class="text-xs text-blue-300 italic block mt-1">"Pilihan kendaraan Anda, kepercayaan kami."</span>
                </div>
            </div>

        </div>
    </section>

    {{-- LOCATION & MAPS SECTION --}}
    <section id="location" class="py-20 bg-slate-100 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-xs font-extrabold text-blue-600 uppercase tracking-widest">Lokasi Showroom</span>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-1">Kunjungi Showroom Kami</h2>
                <p class="text-sm text-slate-500 mt-2">Datang langsung untuk melihat unit, melakukan cek kondisi, dan mencoba test drive.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">
                {{-- SHOWROOM DETAILS CARD --}}
                <div class="bg-white p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-6 flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl font-bold">
                                📍
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900">Showroom Suja MobilIndo</h3>
                                <p class="text-xs text-slate-500 font-mono mt-0.5">Kp.Cilanggir, Cigagade, Balubur Limbangan, Garut, Jawa Barat</p>
                            </div>
                        </div>

                        <div class="space-y-3 text-xs text-slate-600 border-y border-slate-100 py-4">
                            <div class="flex items-start gap-2">
                                <span class="font-bold text-slate-900">Jam Operasional:</span>
                                <span>Senin - Minggu (08:00 - 18:00 WIB)</span>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="font-bold text-slate-900">Layanan:</span>
                                <span>Cek Unit, Test Drive, Konsultasi Jual/Beli</span>
                            </div>
                        </div>
                    </div>

                    <a href="https://www.google.com/maps/search/?api=1&query=-7.043806,107.951694" target="_blank"
                       class="w-full inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs py-3 px-4 rounded-2xl shadow-md transition">
                        <svg class="w-4 h-4 text-rose-500 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span>Buka di Google Maps</span>
                    </a>
                </div>

                {{-- GOOGLE MAPS EMBED --}}
                <div class="lg:col-span-2 bg-white p-2 rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden min-h-[320px]">
                    <iframe class="w-full h-full min-h-[320px] rounded-2xl border-0"
                            src="https://maps.google.com/maps?q=-7.043806,107.951694&z=17&output=embed"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer id="contact" class="bg-slate-900 text-slate-400 text-xs py-16">
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
                    <li><a href="#location" class="hover:text-white transition">Lokasi Showroom</a></li>
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
