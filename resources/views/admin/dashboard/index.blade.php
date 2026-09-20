@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

{{-- HEADER SECTION --}}
<div class="mb-8">
    <div class="flex items-center gap-2 mb-1">
        <span class="text-xs font-mono-code text-rose-600 font-bold uppercase tracking-widest">SHOWROOM ANALYTICS</span>
    </div>
    <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
        RINGKASAN AKTIVITAS DEALER
    </h1>
    <p class="text-xs text-zinc-500 mt-1">
        Pantau performa inventaris kendaraan, transaksi penjualan, dan basis data pelanggan showroom secara real-time.
    </p>
</div>

{{-- 4 STATISTIC CARDS (CARITA LUXURY STYLE) --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">

    {{-- 1. TOTAL KENDARAAN --}}
    <div class="bg-white border border-zinc-200 p-5 shadow-xs hover:border-zinc-900 transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400">
                    Total Unit
                </p>
                <p class="text-2xl sm:text-3xl font-light text-zinc-900 mt-2 tracking-tight">
                    {{ number_format($totalVehicles) }}
                </p>
            </div>
            <div class="w-10 h-10 bg-zinc-100 text-zinc-800 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.4-1.7-1.1-2.2l-3.4-2.3c-.5-.4-1.2-.6-1.9-.6H7.4c-.7 0-1.4.2-1.9.6L2.1 10.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2m15 0a3 3 0 11-6 0m6 0a3 3 0 10-6 0M4 17a3 3 0 11-6 0m6 0a3 3 0 10-6 0M5 9l2-4h10l2 4"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-zinc-100 text-[10px] text-zinc-400 font-mono-code uppercase">
            Semua kategori unit
        </div>
    </div>

    {{-- 2. TERSEDIA --}}
    <div class="bg-white border border-zinc-200 p-5 shadow-xs hover:border-emerald-500 transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-emerald-700">
                    Siap Jual
                </p>
                <p class="text-2xl sm:text-3xl font-light text-emerald-700 mt-2 tracking-tight">
                    {{ number_format($availableVehicles) }}
                </p>
            </div>
            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-zinc-100 text-[10px] text-emerald-600 font-mono-code uppercase">
            Ready di showroom
        </div>
    </div>

    {{-- 3. TERJUAL --}}
    <div class="bg-white border border-zinc-200 p-5 shadow-xs hover:border-rose-600 transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-rose-700">
                    Unit Terjual
                </p>
                <p class="text-2xl sm:text-3xl font-light text-rose-700 mt-2 tracking-tight">
                    {{ number_format($soldVehicles) }}
                </p>
            </div>
            <div class="w-10 h-10 bg-rose-50 text-rose-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-zinc-100 text-[10px] text-rose-600 font-mono-code uppercase">
            Transaksi selesai
        </div>
    </div>

    {{-- 4. RESERVED --}}
    <div class="bg-white border border-zinc-200 p-5 shadow-xs hover:border-amber-500 transition duration-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-amber-700">
                    Tanda Jadi
                </p>
                <p class="text-2xl sm:text-3xl font-light text-amber-700 mt-2 tracking-tight">
                    {{ number_format($reservedVehicles) }}
                </p>
            </div>
            <div class="w-10 h-10 bg-amber-50 text-amber-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-3 pt-3 border-t border-zinc-100 text-[10px] text-amber-600 font-mono-code uppercase">
            Unit di-booking
        </div>
    </div>

</div>

{{-- PENJUALAN TERBARU (TRANSAKSI) --}}
<div class="bg-white border border-zinc-200 mb-8 shadow-xs">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between px-6 py-4 border-b border-zinc-100 gap-2">
        <div>
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-sm font-bold tracking-[0.15em] text-zinc-900 uppercase">
                    In Out Kendaraan Terbaru
                </h2>
            </div>
            <p class="text-xs text-zinc-400 mt-0.5">
                Daftar transaksi penjualan unit showroom yang baru tercatat
            </p>
        </div>

        <a href="{{ route('admin.sales.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-rose-600 transition">
            <span>Lihat Semua Transaksi</span>
            <span>→</span>
        </a>
    </div>

    @if($recentLogs->count())
        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead class="bg-zinc-50 border-b border-zinc-200 text-zinc-500 uppercase tracking-wider text-[10px] font-bold">
                    <tr>
                        <th class="text-left px-6 py-3.5">Status Mutasi</th>
                        <th class="text-left px-6 py-3.5">Tanggal & Waktu</th>
                        <th class="text-left px-6 py-3.5">Kode Stok</th>
                        <th class="text-left px-6 py-3.5">Nama Kendaraan</th>
                        <th class="text-left px-6 py-3.5">Harga Jual</th>
                        <th class="text-left px-6 py-3.5">Keterangan</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100">
                    @foreach($recentLogs as $log)
                        <tr class="hover:bg-zinc-50/80 transition">
                            <td class="px-6 py-4">
                                @if($log->type === 'IN')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-bold uppercase border border-emerald-200 bg-emerald-50 text-emerald-800">
                                        🟢 IN (DITAMBAH)
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 text-[10px] font-bold uppercase border border-rose-200 bg-rose-50 text-rose-800">
                                        🔴 OUT (DIHAPUS)
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-mono-code text-zinc-700">
                                {{ $log->action_at?->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 font-mono-code font-bold text-zinc-900">
                                {{ $log->stock_code }}
                            </td>
                            <td class="px-6 py-4 font-bold text-zinc-800 uppercase">
                                {{ $log->vehicle_name }}
                            </td>
                            <td class="px-6 py-4 font-bold text-zinc-950">
                                Rp {{ number_format($log->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-zinc-500 italic">
                                {{ $log->notes ?? '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="px-6 py-12 text-center text-zinc-400">
            <svg class="w-8 h-8 mx-auto text-zinc-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Belum Ada Mutasi In Out Kendaraan</p>
            <p class="text-[11px] text-zinc-400 mt-1">Riwayat kendaraan yang ditambah/dihapus akan otomatis tercatat di sini.</p>
        </div>
    @endif

</div>

{{-- INVENTORY KENDARAAN TERBARU --}}
<div>
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 gap-2">
        <div>
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-sm font-bold tracking-[0.15em] text-zinc-900 uppercase">
                    Unit Kendaraan Showroom Terbaru
                </h2>
            </div>
            <p class="text-xs text-zinc-400 mt-0.5">
                Unit stok terbaru yang baru ditambahkan ke katalog showroom
            </p>
        </div>

        <a href="{{ route('admin.vehicles.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-700 hover:text-rose-600 transition">
            <span>Kelola Inventaris Unit</span>
            <span>→</span>
        </a>
    </div>

    @if($vehicles->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($vehicles as $vehicle)
                <a href="{{ route('admin.vehicles.show', $vehicle) }}"
                   class="group bg-white border border-zinc-200 overflow-hidden hover:shadow-lg hover:border-zinc-900 transition-all duration-200 flex flex-col justify-between">
                    
                    <div>
                        {{-- PHOTO AREA --}}
                        <div class="relative aspect-[16/10] bg-zinc-100 overflow-hidden">
                            @if($vehicle->primaryImage)
                                <img src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                                     alt="{{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center text-zinc-300">
                                    <svg class="w-10 h-10 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-[10px] uppercase tracking-wider font-mono-code mt-1 text-zinc-400">Belum Ada Foto</span>
                                </div>
                            @endif

                            {{-- STATUS BADGE CARITA BURGUNDY / ACCENT --}}
                            <div class="absolute top-3 left-3">
                                @if($vehicle->status === 'AVAILABLE')
                                    <span class="bg-[#881337] text-white text-[10px] tracking-widest uppercase font-bold px-2.5 py-1 shadow-sm">
                                        TERSEDIA
                                    </span>
                                @elseif($vehicle->status === 'RESERVED')
                                    <span class="bg-amber-600 text-white text-[10px] tracking-widest uppercase font-bold px-2.5 py-1 shadow-sm">
                                        BOOKED
                                    </span>
                                @elseif($vehicle->status === 'SOLD')
                                    <span class="bg-zinc-950 text-white text-[10px] tracking-widest uppercase font-bold px-2.5 py-1 shadow-sm">
                                        TERJUAL
                                    </span>
                                @else
                                    <span class="bg-zinc-700 text-white text-[10px] tracking-widest uppercase font-bold px-2.5 py-1 shadow-sm">
                                        {{ $vehicle->status }}
                                    </span>
                                @endif
                            </div>

                            {{-- STOCK CODE --}}
                            <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-xs text-white text-[9px] font-mono-code uppercase px-2 py-0.5 tracking-wider">
                                {{ $vehicle->stock_code }}
                            </div>
                        </div>

                        {{-- INFO AREA --}}
                        <div class="p-4 space-y-2">
                            <div class="flex items-baseline justify-between gap-2">
                                <h3 class="text-sm font-bold text-zinc-900 uppercase tracking-wider group-hover:text-[#881337] transition">
                                    {{ $vehicle->brand->name ?? '-' }} {{ $vehicle->model->name ?? '-' }}
                                </h3>
                                <span class="text-xs font-mono-code text-zinc-400 font-medium shrink-0">
                                    {{ $vehicle->year }}
                                </span>
                            </div>

                            <p class="text-xs text-zinc-500 font-normal">
                                {{ $vehicle->variant ?? ($vehicle->vehicleType->name ?? 'Kendaraan') }} &bull; {{ $vehicle->transmission ?? 'Manual/Auto' }}
                            </p>
                        </div>
                    </div>

                    {{-- PRICE BAR --}}
                    <div class="p-4 pt-3 border-t border-zinc-100 flex items-center justify-between bg-zinc-50/50">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400">Harga Jual</span>
                        <span class="text-sm font-black text-zinc-950 tracking-tight">
                            Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                        </span>
                    </div>

                </a>
            @endforeach
        </div>
    @else
        <div class="bg-white border border-zinc-200 p-12 text-center">
            <svg class="w-10 h-10 mx-auto text-zinc-300 mb-3 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.4-1.7-1.1-2.2l-3.4-2.3c-.5-.4-1.2-.6-1.9-.6H7.4c-.7 0-1.4.2-1.9.6L2.1 10.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2m15 0a3 3 0 11-6 0m6 0a3 3 0 10-6 0M4 17a3 3 0 11-6 0m6 0a3 3 0 10-6 0M5 9l2-4h10l2 4"/>
            </svg>
            <h3 class="text-xs font-bold uppercase tracking-wider text-zinc-900">Belum Ada Kendaraan di Inventaris</h3>
            <p class="text-xs text-zinc-400 mt-1">Mulai tambahkan unit mobil atau motor ke sistem showroom.</p>
            <a href="{{ route('admin.vehicles.create') }}"
               class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition">
                <span>+ Tambah Kendaraan</span>
            </a>
        </div>
    @endif

</div>

@endsection
