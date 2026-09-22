@extends('layouts.admin')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Vehicle Movement
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Riwayat pergerakan kendaraan masuk dan keluar.
            </p>
        </div>

    </div>


    {{-- Filter --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-6">

        <form
            method="GET"
            action="{{ route('admin.vehicle-movements.index') }}"
            class="grid grid-cols-1 md:grid-cols-4 gap-4"
        >

            {{-- Search --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Stock code, plat, brand..."
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>


            {{-- Type --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Movement Type
                </label>

                <select
                    name="type"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >
                    <option value="">Semua Type</option>

                    <option
                        value="IN"
                        {{ request('type') === 'IN' ? 'selected' : '' }}
                    >
                        IN - Kendaraan Masuk
                    </option>

                    <option
                        value="OUT"
                        {{ request('type') === 'OUT' ? 'selected' : '' }}
                    >
                        OUT - Kendaraan Keluar
                    </option>
                </select>
            </div>


            {{-- Date --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Dari Tanggal
                </label>

                <input
                    type="date"
                    name="date_from"
                    value="{{ request('date_from') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Sampai Tanggal
                </label>

                <input
                    type="date"
                    name="date_to"
                    value="{{ request('date_to') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                >
            </div>


            {{-- Button --}}
            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-gray-800 text-white font-medium hover:bg-gray-700 transition"
                >
                    Filter
                </button>

                <a
                    href="{{ route('admin.vehicle-movements.index') }}"
                    class="px-5 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left">

                <thead class="bg-gray-50 border-b border-gray-200">

                    <tr>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Stock Code
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Kendaraan
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Type
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Reference
                        </th>

                        <th class="px-6 py-4 font-semibold text-gray-700">
                            Keterangan
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-100">

                    @forelse ($movements as $movement)

                        <tr class="hover:bg-gray-50 transition">

                            {{-- Date --}}
                            <td class="px-6 py-4 whitespace-nowrap">

                                <div class="font-medium text-gray-800">
                                    {{ $movement->movement_date?->format('d M Y') }}
                                </div>

                            </td>


                            {{-- Stock Code --}}
                            <td class="px-6 py-4">

                                @if ($movement->vehicle)

                                    <div class="font-semibold text-gray-800">
                                        {{ $movement->vehicle->stock_code }}
                                    </div>

                                    @if ($movement->vehicle->license_plate)
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $movement->vehicle->license_plate }}
                                        </div>
                                    @endif

                                @else

                                    <span class="text-gray-400">
                                        -
                                    </span>

                                @endif

                            </td>


                            {{-- Vehicle --}}
                            <td class="px-6 py-4">

                                @if ($movement->vehicle)

                                    <div class="font-medium text-gray-800">

                                        {{ $movement->vehicle->brand?->name }}
                                        {{ $movement->vehicle->model?->name }}

                                    </div>

                                    <div class="text-xs text-gray-500 mt-1">

                                        {{ $movement->vehicle->year }}

                                        @if ($movement->vehicle->variant)
                                            • {{ $movement->vehicle->variant }}
                                        @endif

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        Kendaraan tidak ditemukan
                                    </span>

                                @endif

                            </td>


                            {{-- Type --}}
                            <td class="px-6 py-4">

                                @if ($movement->type === 'IN')

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        IN
                                    </span>

                                @elseif ($movement->type === 'OUT')

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                        OUT
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                        {{ $movement->type }}
                                    </span>

                                @endif

                            </td>


                            {{-- Reference --}}
                            <td class="px-6 py-4 text-gray-600">

                                {{ $movement->reference ?: '-' }}

                            </td>


                            {{-- Notes --}}
                            <td class="px-6 py-4 text-gray-600">

                                {{ $movement->notes ?: '-' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12 text-center"
                            >

                                <div class="text-gray-400 text-4xl mb-3">
                                    📦
                                </div>

                                <div class="font-medium text-gray-700">
                                    Belum ada vehicle movement
                                </div>

                                <div class="text-sm text-gray-500 mt-1">
                                    Pergerakan kendaraan akan muncul di sini.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if ($movements->hasPages())

            <div class="px-6 py-4 border-t border-gray-200">

                {{ $movements->links() }}

            </div>

        @endif

    </div>

</div>

@endsection