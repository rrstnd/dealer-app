<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory Kendaraan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 text-slate-800">

    <div class="max-w-7xl mx-auto px-6 py-8">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Inventory Kendaraan
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Kelola seluruh kendaraan yang tersedia
                </p>
            </div>

            <a
                href="{{ route('vehicles.create') }}"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-2.5 bg-slate-900 text-white rounded-lg
                       hover:bg-slate-800 transition font-medium"
            >
                <span>＋</span>
                Tambah Kendaraan
            </a>

        </div>


        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))

            <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-200 text-green-700">
                {{ session('success') }}
            </div>

        @endif


        {{-- SEARCH & FILTER --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-6">

            <form method="GET" action="{{ route('vehicles.index') }}">

                <div class="flex flex-col lg:flex-row gap-4">

                    {{-- SEARCH --}}
                    <div class="flex-1">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Cari Kendaraan
                        </label>

                        <div class="relative">

                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                🔎
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Stock code, brand, model, atau plat nomor..."
                                class="w-full pl-10 pr-4 py-2.5
                                       border border-slate-300 rounded-lg
                                       focus:outline-none focus:ring-2
                                       focus:ring-slate-400
                                       focus:border-slate-400 transition"
                            >

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div class="w-full lg:w-56">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full px-4 py-2.5
                                   border border-slate-300 rounded-lg
                                   bg-white
                                   focus:outline-none focus:ring-2
                                   focus:ring-slate-400
                                   focus:border-slate-400 transition"
                        >

                            <option value="">
                                Semua Status
                            </option>

                            <option
                                value="AVAILABLE"
                                {{ request('status') == 'AVAILABLE' ? 'selected' : '' }}
                            >
                                Available
                            </option>

                            <option
                                value="RESERVED"
                                {{ request('status') == 'RESERVED' ? 'selected' : '' }}
                            >
                                Reserved
                            </option>

                            <option
                                value="SOLD"
                                {{ request('status') == 'SOLD' ? 'selected' : '' }}
                            >
                                Sold
                            </option>

                            <option
                                value="SERVICE"
                                {{ request('status') == 'SERVICE' ? 'selected' : '' }}
                            >
                                Service
                            </option>

                            <option
                                value="INACTIVE"
                                {{ request('status') == 'INACTIVE' ? 'selected' : '' }}
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- BUTTON --}}
                    <div class="flex items-end gap-2">

                        <button
                            type="submit"
                            class="px-5 py-2.5
                                   bg-slate-900 text-white rounded-lg
                                   hover:bg-slate-800 transition
                                   font-medium"
                        >
                            🔎 Cari
                        </button>

                        <a
                            href="{{ route('vehicles.index') }}"
                            class="px-5 py-2.5
                                   bg-slate-100 text-slate-700 rounded-lg
                                   hover:bg-slate-200 transition
                                   font-medium"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>


        {{-- INVENTORY TABLE --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

            @if ($vehicles->count() > 0)

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50 border-b border-slate-200">

                            <tr>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    No
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Stock Code
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Jenis
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Brand
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Model
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Tahun
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Harga Jual
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-left font-semibold text-slate-600">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100">

                            @foreach ($vehicles as $vehicle)

                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-6 py-4">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $vehicle->stock_code }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->vehicleType->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->brand->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->model->name }}
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $vehicle->year }}
                                    </td>

                                    <td class="px-6 py-4 font-medium">
                                        Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                                    </td>


                                    {{-- STATUS BADGE --}}
                                    <td class="px-6 py-4">

                                        @if ($vehicle->status === 'AVAILABLE')

                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700">
                                                Available
                                            </span>

                                        @elseif ($vehicle->status === 'RESERVED')

                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-700">
                                                Reserved
                                            </span>

                                        @elseif ($vehicle->status === 'SOLD')

                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-700">
                                                Sold
                                            </span>

                                        @elseif ($vehicle->status === 'SERVICE')

                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-700">
                                                Service
                                            </span>

                                        @else

                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-600">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ACTION --}}
                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-2">

                                            <a
                                                href="{{ route('vehicles.show', $vehicle) }}"
                                                class="px-3 py-1.5 text-xs font-medium
                                                       rounded-lg bg-slate-100
                                                       text-slate-700
                                                       hover:bg-slate-200 transition"
                                            >
                                                👁️ Detail
                                            </a>

                                            <a
                                                href="{{ route('vehicles.edit', $vehicle) }}"
                                                class="px-3 py-1.5 text-xs font-medium
                                                       rounded-lg bg-blue-100
                                                       text-blue-700
                                                       hover:bg-blue-200 transition"
                                            >
                                                ✏️ Edit
                                            </a>

                                            <form
                                                action="{{ route('vehicles.destroy', $vehicle) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus kendaraan ini?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="px-3 py-1.5 text-xs font-medium
                                                           rounded-lg bg-red-100
                                                           text-red-700
                                                           hover:bg-red-200 transition"
                                                >
                                                    🗑️ Hapus
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

        {{-- PAGINATION --}}
        @if ($vehicles->hasPages())

            <div class="mt-6 bg-white rounded-xl shadow-sm border border-slate-200 px-5 py-4">

                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                    {{-- INFO --}}
                    <div class="text-sm text-slate-500">
                        Menampilkan
                        <span class="font-semibold text-slate-700">
                            {{ $vehicles->firstItem() }}
                        </span>
                        -
                        <span class="font-semibold text-slate-700">
                            {{ $vehicles->lastItem() }}
                        </span>
                        dari
                        <span class="font-semibold text-slate-700">
                            {{ $vehicles->total() }}
                        </span>
                        kendaraan
                    </div>

                    {{-- NAVIGATION --}}
                    <div>
                        {{ $vehicles->links('vendor.pagination.tailwind-custom') }}
                    </div>

                </div>

            </div>

        @endif

    </div>

</body>
</html>

        </div>

    </div>

</body>

</html>