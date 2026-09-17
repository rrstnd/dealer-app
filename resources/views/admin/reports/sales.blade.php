@extends('layouts.admin')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan')

@section('content')

    {{-- HEADER SECTION --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-mono-code text-rose-600 font-bold uppercase tracking-widest">FINANCIAL REPORTS</span>
        </div>
        <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
            LAPORAN PENJUALAN & OMZET DEALER
        </h1>
        <p class="text-xs text-zinc-500 mt-1">
            Rekapitulasi transaksi unit terjual berstatus COMPLETED, analisis total omzet, dan ekspor data pembukuan.
        </p>
    </div>

    {{-- FILTER DATE RANGE & EXPORT --}}
    <div class="bg-white border border-zinc-200 shadow-xs p-6 mb-6">
        <form method="GET" action="{{ route('admin.reports.sales') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                    Dari Tanggal
                </label>
                <input type="date"
                       name="date_from"
                       value="{{ request('date_from') }}"
                       class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                    Sampai Tanggal
                </label>
                <input type="date"
                       name="date_to"
                       value="{{ request('date_to') }}"
                       class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
            </div>

            <div class="flex items-center gap-2 md:col-span-2">
                <button type="submit"
                        class="px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition flex items-center gap-1.5 shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <span>Filter Laporan</span>
                </button>

                @if(request()->hasAny(['date_from', 'date_to']))
                    <a href="{{ route('admin.reports.sales') }}"
                       class="px-4 py-2.5 bg-zinc-100 hover:bg-rose-50 text-zinc-700 hover:text-rose-700 border border-zinc-200 hover:border-rose-200 text-xs font-bold uppercase tracking-wider transition">
                        Reset
                    </a>
                @endif

                <a href="{{ route('admin.reports.sales.export', request()->only(['date_from', 'date_to'])) }}"
                   class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold uppercase tracking-wider transition flex items-center gap-1.5 shadow-xs ml-auto">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>Export Excel (CSV)</span>
                </a>
            </div>

        </form>
    </div>

    {{-- SUMMARY METRICS (CARITA LUXURY STYLE) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

        <div class="bg-white border border-zinc-200 p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em]">
                        Total Transaksi Selesai
                    </p>
                    <p class="text-2xl sm:text-3xl font-light text-zinc-900 mt-2 font-mono-code tracking-tight">
                        {{ $totalTransactions }} Unit
                    </p>
                </div>
                <div class="w-10 h-10 bg-zinc-100 text-zinc-800 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-zinc-100 text-[10px] text-zinc-400 font-mono-code uppercase">
                Status: COMPLETED
            </div>
        </div>

        <div class="bg-white border border-zinc-200 p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em]">
                        Total Omzet Penjualan
                    </p>
                    <p class="text-2xl sm:text-3xl font-light text-zinc-950 mt-2 font-mono-code tracking-tight">
                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-emerald-50 text-emerald-700 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-zinc-100 text-[10px] text-emerald-600 font-mono-code uppercase">
                Penerimaan Bersih
            </div>
        </div>

        <div class="bg-white border border-zinc-200 p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em]">
                        Total Potongan Diskon
                    </p>
                    <p class="text-2xl sm:text-3xl font-light text-rose-700 mt-2 font-mono-code tracking-tight">
                        Rp {{ number_format($totalDiscount, 0, ',', '.') }}
                    </p>
                </div>
                <div class="w-10 h-10 bg-rose-50 text-rose-700 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-zinc-100 text-[10px] text-rose-600 font-mono-code uppercase">
                Akumulasi Diskon
            </div>
        </div>

    </div>

    {{-- SALES RECORD TABLE --}}
    <div class="bg-white border border-zinc-200 shadow-xs overflow-hidden">
        <div class="px-6 py-4 border-b border-zinc-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    Riwayat Transaksi Penjualan Lunas (Completed)
                </h3>
            </div>
            <span class="text-[10px] font-mono-code text-zinc-400 uppercase">
                Total Baris: {{ $sales->total() }} Data
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-xs">
                <thead class="bg-zinc-100/90 border-b border-zinc-200 text-zinc-600 uppercase tracking-wider text-[10px] font-bold">
                    <tr>
                        <th class="px-5 py-3.5 text-left">Invoice</th>
                        <th class="px-5 py-3.5 text-left">Tanggal</th>
                        <th class="px-5 py-3.5 text-left">Pelanggan</th>
                        <th class="px-5 py-3.5 text-left">Kendaraan</th>
                        <th class="px-5 py-3.5 text-right">Harga Unit</th>
                        <th class="px-5 py-3.5 text-right">Diskon</th>
                        <th class="px-5 py-3.5 text-right">Total Akhir</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-zinc-100">
                    @forelse($sales as $sale)
                        <tr class="hover:bg-zinc-50/80 transition">
                            <td class="px-5 py-4 font-mono-code font-bold text-zinc-900">
                                <a href="{{ route('admin.sales.show', $sale) }}" class="hover:text-rose-600 transition underline decoration-zinc-300">
                                    {{ $sale->invoice_number }}
                                </a>
                            </td>

                            <td class="px-5 py-4 font-mono-code text-zinc-600">
                                {{ $sale->sale_date?->format('d/m/Y') }}
                            </td>

                            <td class="px-5 py-4 text-zinc-800 font-medium">
                                {{ $sale->customer->name ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-zinc-800">
                                <span class="font-bold">{{ $sale->vehicle->brand->name ?? '-' }}</span>
                                <span>{{ $sale->vehicle->model->name ?? '-' }}</span>
                                @if($sale->vehicle->variant)
                                    <span class="text-zinc-400">({{ $sale->vehicle->variant }})</span>
                                @endif
                            </td>

                            <td class="px-5 py-4 text-right font-mono-code text-zinc-700">
                                Rp {{ number_format($sale->vehicle_price, 0, ',', '.') }}
                            </td>

                            <td class="px-5 py-4 text-right font-mono-code text-rose-600">
                                @if($sale->discount > 0)
                                    - Rp {{ number_format($sale->discount, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="px-5 py-4 text-right font-mono-code font-bold text-zinc-950">
                                Rp {{ number_format($sale->final_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-16 text-center text-zinc-400">
                                <svg class="w-10 h-10 mx-auto text-zinc-300 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Belum Ada Transaksi Penjualan Selesai</p>
                                <p class="text-[11px] text-zinc-400 mt-1">Transaksi berstatus COMPLETED pada rentang tanggal ini akan ditampilkan di sini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if($sales->hasPages())
            <div class="px-5 py-4 border-t border-zinc-200 bg-zinc-50/50">
                {{ $sales->links() }}
            </div>
        @endif
    </div>

@endsection