@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div
    x-data="{ quickActionOpen: false }"
    class="relative"
>

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Dashboard
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Inventory kendaraan
            </p>
        </div>

        {{-- QUICK ACTION BUTTON --}}
        <button
            @click="quickActionOpen = true"
            class="inline-flex items-center gap-2 px-4 py-2.5
                   bg-slate-900 text-white rounded-lg
                   hover:bg-slate-800 transition"
        >
            <span>⚡</span>
            Quick Action
        </button>

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


    {{-- OVERLAY QUICK ACTION --}}
    <div
        x-show="quickActionOpen"
        x-transition.opacity
        @click="quickActionOpen = false"
        class="fixed inset-0 bg-black/30 z-40"
        style="display: none;"
    ></div>


    {{-- QUICK ACTION DRAWER --}}
    <div
        x-show="quickActionOpen"
        x-transition:enter="transform transition ease-in-out duration-300"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-full w-80 max-w-[90vw]
               bg-white shadow-2xl z-50"
        style="display: none;"
    >

        <div class="h-full flex flex-col">

            {{-- DRAWER HEADER --}}
            <div class="flex items-center justify-between
                        px-5 py-4 border-b">

                <div>
                    <h2 class="font-bold text-slate-900">
                        Quick Action
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        Akses cepat
                    </p>
                </div>

                <button
                    @click="quickActionOpen = false"
                    class="w-9 h-9 rounded-lg
                           hover:bg-slate-100
                           flex items-center justify-center"
                >
                    ✕
                </button>

            </div>


            {{-- ACTIONS --}}
            <div class="p-5 space-y-3">

                <a
                    href="{{ route('admin.vehicles.create') }}"
                    class="flex items-center gap-3 p-4 rounded-xl
                           bg-slate-50 hover:bg-slate-100 transition"
                >
                    <span class="text-2xl">🚗</span>

                    <div>
                        <p class="font-semibold text-slate-900">
                            Tambah Kendaraan
                        </p>

                        <p class="text-xs text-slate-500">
                            Tambahkan unit baru
                        </p>
                    </div>
                </a>


                <a
                    href="{{ route('admin.vehicles.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl
                           bg-slate-50 hover:bg-slate-100 transition"
                >
                    <span class="text-2xl">📦</span>

                    <div>
                        <p class="font-semibold text-slate-900">
                            Inventory
                        </p>

                        <p class="text-xs text-slate-500">
                            Kelola kendaraan
                        </p>
                    </div>
                </a>


                <a
                    href="{{ route('admin.customers.index') }}"
                    class="flex items-center gap-3 p-4 rounded-xl
                           bg-slate-50 hover:bg-slate-100 transition"
                >
                    <span class="text-2xl">👤</span>

                    <div>
                        <p class="font-semibold text-slate-900">
                            Customer
                        </p>

                        <p class="text-xs text-slate-500">
                            Kelola data customer
                        </p>
                    </div>
                </a>

            </div>

        </div>

    </div>

</div>

@endsection



