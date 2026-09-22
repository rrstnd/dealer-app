@extends('layouts.admin')

@section('title', 'Laporan Penjualan')
@section('page-title', 'Laporan Penjualan')

@section('content')

    {{-- FILTER & EXPORT --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-6">

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">

            {{-- FILTER --}}
            <form
                method="GET"
                action="{{ route('admin.reports.sales') }}"
                class="flex flex-col sm:flex-row gap-4 items-end"
            >

                {{-- Dari Tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        name="date_from"
                        value="{{ request('date_from') }}"
                        class="w-full sm:w-44 rounded-lg border border-slate-300 px-3 py-2 focus:border-slate-500 focus:ring-slate-500"
                    >
                </div>

                {{-- Sampai Tanggal --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        name="date_to"
                        value="{{ request('date_to') }}"
                        class="w-full sm:w-44 rounded-lg border border-slate-300 px-3 py-2 focus:border-slate-500 focus:ring-slate-500"
                    >
                </div>

                {{-- Filter Button --}}
                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-slate-800 text-white hover:bg-slate-700 transition"
                >
                    Filter
                </button>

                {{-- Reset --}}
                @if(request()->filled('date_from') || request()->filled('date_to'))
                    <a
                        href="{{ route('admin.reports.sales') }}"
                        class="px-5 py-2.5 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-50 transition"
                    >
                        Reset
                    </a>
                @endif

            </form>


            {{-- EXPORT --}}
            <a
                href="{{ route('admin.reports.sales.export', request()->only(['date_from', 'date_to'])) }}"
                class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-green-600 text-white hover:bg-green-700 transition"
            >
                Export Excel
            </a>

        </div>

    </div>


    {{-- SUMMARY --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        {{-- Total Transaksi --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <p class="text-sm text-slate-500">
                Total Transaksi
            </p>

            <p class="text-3xl font-bold text-slate-900 mt-2">
                {{ $totalTransactions }}
            </p>

        </div>


        {{-- Total Omzet --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <p class="text-sm text-slate-500">
                Total Omzet
            </p>

            <p class="text-3xl font-bold text-slate-900 mt-2">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </p>

        </div>


        {{-- Total Diskon --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <p class="text-sm text-slate-500">
                Total Diskon
            </p>

            <p class="text-3xl font-bold text-slate-900 mt-2">
                Rp {{ number_format($totalDiscount, 0, ',', '.') }}
            </p>

        </div>

    </div>


    {{-- SALES TABLE --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Table Header --}}
        <div class="px-6 py-5 border-b border-slate-200">

            <h3 class="font-semibold text-lg text-slate-900">
                Riwayat Penjualan
            </h3>

            <p class="text-sm text-slate-500 mt-1">
                Menampilkan transaksi dengan status COMPLETED
                @if(request('date_from') || request('date_to'))
                    sesuai periode yang dipilih.
                @else
                    untuk seluruh periode.
                @endif
            </p>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            Invoice
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            Kendaraan
                        </th>

                        <th class="px-6 py-4 text-right font-semibold text-slate-600">
                            Harga
                        </th>

                        <th class="px-6 py-4 text-right font-semibold text-slate-600">
                            Diskon
                        </th>

                        <th class="px-6 py-4 text-right font-semibold text-slate-600">
                            Total
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($sales as $sale)

                        <tr class="hover:bg-slate-50">

                            {{-- Invoice --}}
                            <td class="px-6 py-4 font-medium text-slate-900">
                                {{ $sale->invoice_number }}
                            </td>

                            {{-- Date --}}
                            <td class="px-6 py-4 text-slate-600">
                                {{ $sale->sale_date?->format('d/m/Y') }}
                            </td>

                            {{-- Customer --}}
                            <td class="px-6 py-4 text-slate-700">
                                {{ $sale->customer?->name ?? '-' }}
                            </td>

                            {{-- Vehicle --}}
                            <td class="px-6 py-4 text-slate-700">

                                @if($sale->vehicle)

                                    {{ $sale->vehicle->brand?->name ?? '' }}
                                    {{ $sale->vehicle->model?->name ?? '' }}

                                    @if($sale->vehicle->variant)
                                        <span class="text-slate-500">
                                            {{ $sale->vehicle->variant }}
                                        </span>
                                    @endif

                                @else

                                    -

                                @endif

                            </td>

                            {{-- Vehicle Price --}}
                            <td class="px-6 py-4 text-right text-slate-700">
                                Rp {{ number_format($sale->vehicle_price, 0, ',', '.') }}
                            </td>

                            {{-- Discount --}}
                            <td class="px-6 py-4 text-right text-slate-700">
                                Rp {{ number_format($sale->discount, 0, ',', '.') }}
                            </td>

                            {{-- Final Price --}}
                            <td class="px-6 py-4 text-right font-semibold text-slate-900">
                                Rp {{ number_format($sale->final_price, 0, ',', '.') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="px-6 py-12 text-center text-slate-500"
                            >
                                Belum ada transaksi penjualan pada periode ini.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($sales->hasPages())

            <div class="px-6 py-4 border-t border-slate-200">

                {{ $sales->links() }}

            </div>

        @endif

    </div>

@endsection