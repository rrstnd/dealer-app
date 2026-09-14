@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- HEADER --}}
<div class="mb-8">

    <h1 class="text-2xl font-bold text-slate-900">
        Dashboard
    </h1>

    <p class="text-sm text-slate-500 mt-1">
        Ringkasan aktivitas dealer
    </p>

</div>


{{-- STATISTICS --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-5 mb-8">

    {{-- TOTAL KENDARAAN --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Total Kendaraan
                </p>

                <p class="text-2xl font-bold text-slate-900 mt-2">
                    {{ number_format($totalVehicles) }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-lg bg-slate-100
                        flex items-center justify-center text-xl">
                🚗
            </div>

        </div>
    </div>


    {{-- TERSEDIA --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Tersedia
                </p>

                <p class="text-2xl font-bold text-green-600 mt-2">
                    {{ number_format($availableVehicles) }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-lg bg-green-50
                        flex items-center justify-center text-xl">
                🟢
            </div>

        </div>
    </div>


    {{-- TERJUAL --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Terjual
                </p>

                <p class="text-2xl font-bold text-red-600 mt-2">
                    {{ number_format($soldVehicles) }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-lg bg-red-50
                        flex items-center justify-center text-xl">
                💰
            </div>

        </div>
    </div>


    {{-- RESERVED --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Reserved
                </p>

                <p class="text-2xl font-bold text-yellow-600 mt-2">
                    {{ number_format($reservedVehicles) }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-lg bg-yellow-50
                        flex items-center justify-center text-xl">
                🟡
            </div>

        </div>
    </div>


    {{-- CUSTOMER --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex items-center justify-between">

            <div>
                <p class="text-sm text-slate-500">
                    Customer
                </p>

                <p class="text-2xl font-bold text-blue-600 mt-2">
                    {{ number_format($totalCustomers) }}
                </p>
            </div>

            <div class="w-11 h-11 rounded-lg bg-blue-50
                        flex items-center justify-center text-xl">
                👥
            </div>

        </div>
    </div>

</div>


{{-- PENJUALAN TERBARU --}}
<div class="bg-white rounded-xl border border-slate-200 mb-8">

    <div class="flex items-center justify-between px-6 py-5 border-b">

        <div>
            <h2 class="text-lg font-bold text-slate-900">
                Penjualan Terbaru
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Transaksi penjualan terakhir
            </p>
        </div>

        <a
            href="{{ route('admin.sales.index') }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-700"
        >
            Lihat Semua →
        </a>

    </div>


    @if($recentSales->count())

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b">

                    <tr>
                        <th class="text-left px-6 py-3 font-semibold text-slate-600">
                            Invoice
                        </th>

                        <th class="text-left px-6 py-3 font-semibold text-slate-600">
                            Customer
                        </th>

                        <th class="text-left px-6 py-3 font-semibold text-slate-600">
                            Kendaraan
                        </th>

                        <th class="text-left px-6 py-3 font-semibold text-slate-600">
                            Total
                        </th>

                        <th class="text-left px-6 py-3 font-semibold text-slate-600">
                            Status
                        </th>
                    </tr>

                </thead>


                <tbody class="divide-y">

                    @foreach($recentSales as $sale)

                        <tr class="hover:bg-slate-50">

                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $sale->invoice_number }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $sale->customer->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-700">
                                {{ $sale->vehicle->brand->name ?? '-' }}
                                {{ $sale->vehicle->model->name ?? '-' }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-900">
                                Rp {{ number_format($sale->final_price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">

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
                                    class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClass }}"
                                >
                                    {{ $sale->status }}
                                </span>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="px-6 py-10 text-center">

            <div class="text-4xl mb-3">
                💰
            </div>

            <p class="font-semibold text-slate-900">
                Belum ada transaksi
            </p>

            <p class="text-sm text-slate-500 mt-1">
                Data penjualan akan muncul di sini.
            </p>

        </div>

    @endif

</div>


{{-- INVENTORY KENDARAAN --}}
<div>

    <div class="flex items-center justify-between mb-4">

        <div>
            <h2 class="text-lg font-bold text-slate-900">
                Inventory Kendaraan
            </h2>

            <p class="text-sm text-slate-500">
                Kendaraan terbaru di inventory
            </p>
        </div>

        <a
            href="{{ route('admin.vehicles.index') }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-700"
        >
            Lihat Semua →
        </a>

    </div>


    @if($vehicles->count())

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            @foreach($vehicles as $vehicle)

                <a
                    href="{{ route('admin.vehicles.show', $vehicle) }}"
                    class="group bg-white rounded-xl border border-slate-200
                           overflow-hidden hover:shadow-lg transition"
                >

                    {{-- FOTO --}}
                    <div class="relative h-48 bg-slate-100 overflow-hidden">

                        @if($vehicle->primaryImage)

                            <img
                                src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                                alt="{{ $vehicle->brand->name ?? '' }} {{ $vehicle->model->name ?? '' }}"
                                class="w-full h-full object-cover
                                       group-hover:scale-105 transition duration-300"
                            >

                        @else

                            <div class="w-full h-full flex items-center justify-center">

                                <div class="text-center text-slate-400">

                                    <div class="text-4xl mb-2">
                                        🚗
                                    </div>

                                    <p class="text-sm">
                                        Belum ada foto
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- STATUS --}}
                        <div class="absolute top-3 left-3">

                            @php
                                $statusClass = match($vehicle->status) {
                                    'AVAILABLE' => 'bg-green-100 text-green-700',
                                    'RESERVED' => 'bg-yellow-100 text-yellow-700',
                                    'SOLD' => 'bg-red-100 text-red-700',
                                    'SERVICE' => 'bg-blue-100 text-blue-700',
                                    'INACTIVE' => 'bg-slate-100 text-slate-600',
                                    default => 'bg-slate-100 text-slate-600',
                                };
                            @endphp

                            <span
                                class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $statusClass }}"
                            >
                                {{ $vehicle->status }}
                            </span>

                        </div>

                    </div>


                    {{-- INFO --}}
                    <div class="p-4">

                        <div class="flex items-start justify-between gap-3">

                            <div>

                                <h3 class="font-bold text-slate-900">
                                    {{ $vehicle->brand->name ?? '-' }}
                                    {{ $vehicle->model->name ?? '-' }}
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $vehicle->variant ?? '-' }}
                                </p>

                            </div>

                            <span class="text-xs text-slate-400">
                                {{ $vehicle->year }}
                            </span>

                        </div>


                        <div class="mt-4">

                            <p class="text-xs text-slate-500">
                                Harga Jual
                            </p>

                            <p class="text-lg font-bold text-slate-900">
                                Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                            </p>

                        </div>

                    </div>

                </a>

            @endforeach

        </div>

    @else

        <div class="bg-white border border-dashed border-slate-300
                    rounded-xl p-12 text-center">

            <div class="text-5xl mb-4">
                🚗
            </div>

            <h3 class="font-semibold text-slate-900">
                Belum ada kendaraan
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Tambahkan kendaraan ke inventory terlebih dahulu.
            </p>

            <a
                href="{{ route('admin.vehicles.create') }}"
                class="inline-block mt-4 px-4 py-2
                       bg-slate-900 text-white rounded-lg
                       text-sm"
            >
                + Tambah Kendaraan
            </a>

        </div>

    @endif

</div>
@endsection
