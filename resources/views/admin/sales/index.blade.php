@extends('layouts.admin')

@section('title', 'Transaksi Penjualan')
@section('page-title', 'Transaksi Penjualan')

@section('content')

    {{-- HEADER SECTION --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-mono-code text-rose-600 font-bold uppercase tracking-widest">FINANCIAL & SALES</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                TRANSAKSI PENJUALAN SHOWROOM
            </h1>
            <p class="text-xs text-zinc-500 mt-1">
                Daftar rekaman transaksi jual-beli kendaraan, surat perjanjian, dan status pembayaran.
            </p>
        </div>

        <a href="{{ route('admin.sales.create') }}"
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Input Transaksi Baru</span>
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

    {{-- SALES TABLE --}}
    <div class="bg-white border border-zinc-200 shadow-xs overflow-hidden">
        @if ($sales->count())
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-zinc-100/90 border-b border-zinc-200 text-zinc-600 uppercase tracking-wider text-[10px] font-bold">
                        <tr>
                            <th class="px-5 py-3.5 text-left">No. Invoice</th>
                            <th class="px-5 py-3.5 text-left">Tanggal</th>
                            <th class="px-5 py-3.5 text-left">Pelanggan</th>
                            <th class="px-5 py-3.5 text-left">Kendaraan</th>
                            <th class="px-5 py-3.5 text-left">Harga Unit</th>
                            <th class="px-5 py-3.5 text-left">Diskon</th>
                            <th class="px-5 py-3.5 text-left">Total Akhir</th>
                            <th class="px-5 py-3.5 text-left">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100">
                        @foreach ($sales as $sale)
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

                                <td class="px-5 py-4">
                                    <div class="font-bold text-zinc-900 uppercase">
                                        {{ $sale->vehicle->brand->name ?? '-' }} {{ $sale->vehicle->model->name ?? '-' }}
                                    </div>
                                    <div class="text-[11px] font-mono-code text-zinc-400">
                                        {{ $sale->vehicle->stock_code ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 font-mono-code text-zinc-700">
                                    Rp {{ number_format($sale->vehicle_price, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-4 font-mono-code text-rose-600">
                                    @if($sale->discount > 0)
                                        - Rp {{ number_format($sale->discount, 0, ',', '.') }}
                                    @else
                                        -
                                    @endif
                                </td>

                                <td class="px-5 py-4 font-mono-code font-bold text-zinc-950">
                                    Rp {{ number_format($sale->final_price, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                        $badge = match($sale->status) {
                                            'COMPLETED' => ['bg' => 'bg-emerald-50 text-emerald-800 border-emerald-200', 'label' => 'SELESAI'],
                                            'BOOKED'    => ['bg' => 'bg-amber-50 text-amber-800 border-amber-200', 'label' => 'BOOKING'],
                                            'DRAFT'     => ['bg' => 'bg-zinc-100 text-zinc-700 border-zinc-300', 'label' => 'DRAFT'],
                                            'CANCELLED' => ['bg' => 'bg-rose-50 text-rose-800 border-rose-200', 'label' => 'BATAL'],
                                            default     => ['bg' => 'bg-zinc-100 text-zinc-700 border-zinc-300', 'label' => $sale->status],
                                        };
                                    @endphp
                                    <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border {{ $badge['bg'] }}">
                                        {{ $badge['label'] }}
                                    </span>
                                </td>

                                <td class="px-5 py-4 text-right">
                                    <div class="inline-flex items-center gap-1.5 justify-end">
                                        <a href="{{ route('admin.sales.show', $sale) }}"
                                           class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-zinc-200 bg-white hover:bg-zinc-100 text-zinc-700 transition"
                                           title="Detail Transaksi">
                                            Detail
                                        </a>

                                        <a href="{{ route('admin.sales.edit', $sale) }}"
                                           class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-zinc-300 bg-zinc-100 hover:bg-zinc-200 text-zinc-800 transition"
                                           title="Edit Transaksi">
                                            Edit
                                        </a>

                                        @if ($sale->status !== 'CANCELLED')
                                            <form action="{{ route('admin.sales.cancel', $sale) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi {{ $sale->invoice_number }}?')"
                                                  class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 transition cursor-pointer"
                                                        title="Batalkan Transaksi">
                                                    Batal
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 text-center text-zinc-400">
                <svg class="w-10 h-10 mx-auto text-zinc-300 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Belum Ada Transaksi Penjualan</p>
                <p class="text-[11px] text-zinc-400 mt-1">Gunakan tombol "Input Transaksi Baru" untuk mencatat penjualan unit.</p>
                <a href="{{ route('admin.sales.create') }}"
                   class="inline-block mt-4 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition">
                    + Input Penjualan Baru
                </a>
            </div>
        @endif
    </div>

    {{-- PAGINATION --}}
    @if ($sales->hasPages())
        <div class="mt-6 bg-white border border-zinc-200 px-5 py-4 shadow-xs flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="text-xs text-zinc-500 font-mono-code uppercase">
                Menampilkan <span class="font-bold text-zinc-900">{{ $sales->firstItem() }}</span> - <span class="font-bold text-zinc-900">{{ $sales->lastItem() }}</span> dari <span class="font-bold text-zinc-900">{{ $sales->total() }}</span> transaksi
            </div>
            <div>
                {{ $sales->links() }}
            </div>
        </div>
    @endif

@endsection