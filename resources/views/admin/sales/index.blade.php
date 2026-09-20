@extends('layouts.admin')

@section('title', 'In Out Kendaraan')
@section('page-title', 'In Out Kendaraan')

@section('content')

    {{-- HEADER SECTION --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-mono-code text-rose-600 font-bold uppercase tracking-widest">MUTASI INVENTARIS</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                LOG IN OUT KENDARAAN
            </h1>
            <p class="text-xs text-zinc-500 mt-1">
                Catatan riwayat kendaraan yang ditambah (IN) dan dihapus (OUT) dari sistem website showroom.
            </p>
        </div>

        <a href="{{ route('admin.vehicles.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Upload Kendaraan Baru</span>
        </a>
    </div>

    {{-- ALERTS --}}
    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- SEARCH & MONTHLY FILTER BAR --}}
    <div class="bg-white border border-zinc-200 p-5 mb-6 shadow-xs">
        <form method="GET" action="{{ route('admin.sales.index') }}">
            <div class="flex flex-col lg:flex-row gap-4">

                {{-- SEARCH INPUT --}}
                <div class="flex-1">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-500 mb-1.5">
                        Pencarian Kendaraan
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-zinc-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Cari Kode Stok, Nama Kendaraan, atau Plat Nomor..."
                               class="w-full pl-9 pr-4 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-800 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                    </div>
                </div>

                {{-- FILTER TIPE MUTASI (IN / OUT) --}}
                <div class="w-full lg:w-44">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-500 mb-1.5">
                        Status Mutasi
                    </label>
                    <select name="type"
                            class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition">
                        <option value="">Semua Status</option>
                        <option value="IN" {{ request('type') == 'IN' ? 'selected' : '' }}>🟢 IN (Kendaraan Masuk)</option>
                        <option value="OUT" {{ request('type') == 'OUT' ? 'selected' : '' }}>🔴 OUT (Kendaraan Keluar)</option>
                    </select>
                </div>

                {{-- FILTER BULAN --}}
                <div class="w-full lg:w-44">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-500 mb-1.5">
                        Filter Bulan
                    </label>
                    <select name="month"
                            class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition">
                        <option value="">Semua Bulan</option>
                        @php
                            $months = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ];
                        @endphp
                        @foreach ($months as $num => $name)
                            <option value="{{ sprintf('%02d', $num) }}" {{ request('month') == sprintf('%02d', $num) ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FILTER TAHUN --}}
                <div class="w-full lg:w-36">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-500 mb-1.5">
                        Filter Tahun
                    </label>
                    <select name="year"
                            class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition">
                        <option value="">Semua Tahun</option>
                        @for ($y = date('Y'); $y >= 2023; $y--)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endfor
                    </select>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="flex items-end gap-2">
                    <button type="submit"
                            class="px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition flex items-center gap-1.5 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <span>Filter</span>
                    </button>

                    @if (request()->hasAny(['search', 'type', 'month', 'year']))
                        <a href="{{ route('admin.sales.index') }}"
                           class="px-4 py-2.5 bg-zinc-100 hover:bg-rose-50 text-zinc-700 hover:text-rose-700 border border-zinc-200 hover:border-rose-200 text-xs font-bold uppercase tracking-wider transition flex items-center gap-1">
                            <span>✕</span>
                            <span>Reset</span>
                        </a>
                    @endif
                </div>

            </div>
        </form>
    </div>

    {{-- LOG TABLE --}}
    <div class="bg-white border border-zinc-200 shadow-xs overflow-hidden">
        @if ($logs->count())
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-zinc-100/90 border-b border-zinc-200 text-zinc-600 uppercase tracking-wider text-[10px] font-bold">
                        <tr>
                            <th class="px-5 py-3.5 text-left">Status Mutasi</th>
                            <th class="px-5 py-3.5 text-left">Tanggal & Waktu</th>
                            <th class="px-5 py-3.5 text-left">Kode Stok</th>
                            <th class="px-5 py-3.5 text-left">Nama Kendaraan</th>
                            <th class="px-5 py-3.5 text-left">Plat Nomor</th>
                            <th class="px-5 py-3.5 text-left">Harga Jual</th>
                            <th class="px-5 py-3.5 text-left">Petugas</th>
                            <th class="px-5 py-3.5 text-left">Keterangan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100">
                        @foreach ($logs as $log)
                            <tr class="hover:bg-zinc-50/80 transition">
                                <td class="px-5 py-4">
                                    @if ($log->type === 'IN')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-emerald-200 bg-emerald-50 text-emerald-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                            IN (DITAMBAH)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-rose-200 bg-rose-50 text-rose-800">
                                            <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
                                            OUT (DIHAPUS)
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 font-mono-code text-zinc-700">
                                    {{ $log->action_at?->format('d/m/Y H:i') }}
                                </td>

                                <td class="px-5 py-4 font-mono-code font-bold text-zinc-900">
                                    {{ $log->stock_code }}
                                </td>

                                <td class="px-5 py-4 font-bold text-zinc-900 uppercase">
                                    {{ $log->vehicle_name }}
                                </td>

                                <td class="px-5 py-4 font-mono-code text-zinc-600">
                                    {{ $log->license_plate ?? '-' }}
                                </td>

                                <td class="px-5 py-4 font-mono-code font-bold text-zinc-950">
                                    Rp {{ number_format($log->price, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-4 text-zinc-700">
                                    {{ $log->user_name ?? 'Admin' }}
                                </td>

                                <td class="px-5 py-4 text-zinc-500 italic">
                                    {{ $log->notes ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 text-center text-zinc-400">
                <svg class="w-10 h-10 mx-auto text-zinc-300 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Belum Ada Riwayat In Out Kendaraan</p>
                <p class="text-[11px] text-zinc-400 mt-1">Riwayat akan bertambah secara otomatis setiap kali kendaraan diupload atau dihapus.</p>
                <a href="{{ route('admin.vehicles.create') }}"
                   class="inline-block mt-4 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition">
                    + Upload Kendaraan Baru
                </a>
            </div>
        @endif
    </div>

    {{-- PAGINATION --}}
    @if ($logs->hasPages())
        <div class="mt-6 bg-white border border-zinc-200 px-5 py-4 shadow-xs flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="text-xs text-zinc-500 font-mono-code uppercase">
                Menampilkan <span class="font-bold text-zinc-900">{{ $logs->firstItem() }}</span> - <span class="font-bold text-zinc-900">{{ $logs->lastItem() }}</span> dari <span class="font-bold text-zinc-900">{{ $logs->total() }}</span> log kendaraan
            </div>
            <div>
                {{ $logs->links() }}
            </div>
        </div>
    @endif

@endsection