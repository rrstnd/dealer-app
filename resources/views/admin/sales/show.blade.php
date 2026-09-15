@extends('layouts.admin')

@section('title', 'Detail Penjualan')
@section('page-title', 'Detail Penjualan')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-8">

    <div>
        <h1 class="text-2xl font-bold text-slate-900">
            Detail Penjualan
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Informasi lengkap transaksi penjualan
        </p>
    </div>

    <div class="flex items-center gap-3">

        <a
            href="{{ route('admin.sales.index') }}"
            class="px-4 py-2.5 rounded-lg border border-slate-300
                   bg-white text-sm font-medium text-slate-700
                   hover:bg-slate-50 transition"
        >
            ← Kembali
        </a>

        @if($sale->status !== 'CANCELLED')

            <a
                href="{{ route('admin.sales.edit', $sale) }}"
                class="px-4 py-2.5 rounded-lg
                       bg-slate-900 text-white text-sm font-medium
                       hover:bg-slate-800 transition"
            >
                Edit
            </a>

        @endif

    </div>

</div>


{{-- STATUS --}}
<div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">

    <div class="flex items-center justify-between">

        <div>

            <p class="text-sm text-slate-500">
                Nomor Invoice
            </p>

            <h2 class="text-xl font-bold text-slate-900 mt-1">
                {{ $sale->invoice_number }}
            </h2>

        </div>


        @php
            $statusClass = match($sale->status) {
                'COMPLETED' => 'bg-green-100 text-green-700',
                'BOOKED' => 'bg-yellow-100 text-yellow-700',
                'DRAFT' => 'bg-slate-100 text-slate-600',
                'CANCELLED' => 'bg-red-100 text-red-700',
                default => 'bg-slate-100 text-slate-600',
            };
        @endphp

        <span
            class="px-3 py-1.5 rounded-full text-sm font-semibold {{ $statusClass }}"
        >
            {{ $sale->status }}
        </span>

    </div>

</div>


{{-- CUSTOMER + KENDARAAN --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    {{-- CUSTOMER --}}
    <div class="bg-white rounded-xl border border-slate-200 p-6">

        <h2 class="text-lg font-bold text-slate-900 mb-5">
            Informasi Customer
        </h2>

        <div class="space-y-4">

            <div>
                <p class="text-xs text-slate-500">
                    Kode Customer
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->customer->customer_code ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Nama
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->customer->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    No. Telepon
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->customer->phone ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Email
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->customer->email ?? '-' }}
                </p>
            </div>

        </div>

    </div>


    {{-- KENDARAAN --}}
    <div class="bg-white rounded-xl border border-slate-200 p-6">

        <h2 class="text-lg font-bold text-slate-900 mb-5">
            Informasi Kendaraan
        </h2>

        <div class="space-y-4">

            <div>
                <p class="text-xs text-slate-500">
                    Stock Code
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->vehicle->stock_code ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Kendaraan
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->vehicle->brand->name ?? '-' }}
                    {{ $sale->vehicle->model->name ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Tahun
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->vehicle->year ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Harga Jual
                </p>

                <p class="font-semibold text-slate-900 mt-1">
                    Rp {{ number_format($sale->vehicle_price, 0, ',', '.') }}
                </p>
            </div>

        </div>

    </div>

</div>


{{-- DETAIL TRANSAKSI --}}
<div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">

    <h2 class="text-lg font-bold text-slate-900 mb-6">
        Detail Transaksi
    </h2>

    <div class="space-y-4">

        <div class="flex items-center justify-between">
            <span class="text-slate-500">
                Harga Kendaraan
            </span>

            <span class="font-medium text-slate-900">
                Rp {{ number_format($sale->vehicle_price, 0, ',', '.') }}
            </span>
        </div>


        <div class="flex items-center justify-between">
            <span class="text-slate-500">
                Discount
            </span>

            <span class="font-medium text-red-600">
                - Rp {{ number_format($sale->discount, 0, ',', '.') }}
            </span>
        </div>


        <div class="border-t border-slate-200 pt-4
                    flex items-center justify-between">

            <span class="text-lg font-bold text-slate-900">
                Total Penjualan
            </span>

            <span class="text-xl font-bold text-slate-900">
                Rp {{ number_format($sale->final_price, 0, ',', '.') }}
            </span>

        </div>

    </div>

</div>


{{-- INFORMASI TRANSAKSI --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

    <div class="bg-white rounded-xl border border-slate-200 p-6">

        <h2 class="text-lg font-bold text-slate-900 mb-5">
            Informasi Transaksi
        </h2>

        <div class="space-y-4">

            <div>
                <p class="text-xs text-slate-500">
                    Tanggal Penjualan
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->sale_date?->format('d M Y') ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Sales Person
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->sales_person ?? '-' }}
                </p>
            </div>

            <div>
                <p class="text-xs text-slate-500">
                    Dibuat
                </p>

                <p class="font-medium text-slate-900 mt-1">
                    {{ $sale->created_at?->format('d M Y H:i') ?? '-' }}
                </p>
            </div>

        </div>

    </div>


    {{-- CATATAN --}}
    <div class="bg-white rounded-xl border border-slate-200 p-6">

        <h2 class="text-lg font-bold text-slate-900 mb-5">
            Catatan
        </h2>

        @if($sale->notes)

            <p class="text-sm text-slate-700 whitespace-pre-line">
                {{ $sale->notes }}
            </p>

        @else

            <p class="text-sm text-slate-400">
                Tidak ada catatan.
            </p>

        @endif

    </div>

</div>


{{-- CANCEL TRANSACTION --}}
@if($sale->status !== 'CANCELLED')

    <div class="bg-red-50 border border-red-200 rounded-xl p-5">

        <div class="flex items-center justify-between gap-4">

            <div>

                <h3 class="font-semibold text-red-800">
                    Batalkan Transaksi
                </h3>

                <p class="text-sm text-red-600 mt-1">
                    Transaksi yang dibatalkan akan mengubah status kendaraan menjadi tersedia kembali.
                </p>

            </div>

            @if($sale->status !== 'COMPLETED')

                <form
                    method="POST"
                    action="{{ route('admin.sales.cancel', $sale) }}"
                    onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')"
                >
                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="px-4 py-2.5 rounded-lg
                               bg-red-600 text-white text-sm font-medium
                               hover:bg-red-700 transition"
                    >
                        Cancel
                    </button>

                </form>

            @endif

        </div>

    </div>

@endif

@endsection
