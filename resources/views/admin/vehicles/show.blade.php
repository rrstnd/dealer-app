@extends('layouts.admin')

@section('content')

<div class="max-w-6xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        Detail Kendaraan
    </h1>

    {{-- DATA KENDARAAN --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">

        <h2 class="text-xl font-bold">
            {{ $vehicle->brand->name ?? '-' }}
            {{ $vehicle->model->name ?? '-' }}
        </h2>

        <p class="text-gray-600 mt-2">
            Kode Stock: {{ $vehicle->stock_code }}
        </p>

        <p class="text-gray-600">
            Tahun: {{ $vehicle->year }}
        </p>

        <p class="text-gray-600">
            Harga Jual:
            Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
        </p>

    </div>


    {{-- UPLOAD FOTO --}}
    <div class="bg-white p-6 rounded-lg shadow mb-6">

        <h2 class="text-lg font-bold mb-4">
            Foto Kendaraan
        </h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('admin.vehicles.images.store', $vehicle) }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <input
                type="file"
                name="image"
                accept=".jpg,.jpeg,.png,.webp"
                required
            >

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded"
            >
                Upload Foto
            </button>
        </form>

    </div>


    {{-- DAFTAR FOTO --}}
    <div class="bg-white p-6 rounded-lg shadow">

        <h2 class="text-lg font-bold mb-4">
            Galeri Foto
        </h2>

        @if($vehicle->images->count())

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                @foreach($vehicle->images as $image)

                    <div class="border rounded p-3">

                        <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                            class="w-full h-40 object-cover rounded"
                        >

                        @if($image->is_primary)
                            <div class="text-green-600 font-bold text-sm mt-2">
                                FOTO UTAMA
                            </div>
                        @else
                            <form
                                action="{{ route('admin.vehicles.images.primary', [$vehicle, $image]) }}"
                                method="POST"
                                class="mt-2"
                            >
                                @csrf
                                @method('PATCH')

                                <button
                                    type="submit"
                                    class="text-blue-600 text-sm"
                                >
                                    Jadikan Utama
                                </button>
                            </form>
                        @endif

                        <form
                            action="{{ route('admin.vehicles.images.destroy', [$vehicle, $image]) }}"
                            method="POST"
                            class="mt-2"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="text-red-600 text-sm"
                                onclick="return confirm('Hapus foto ini?')"
                            >
                                Hapus Foto
                            </button>
                        </form>

                    </div>

                @endforeach

            </div>

        @else

            <p class="text-gray-500">
                Belum ada foto kendaraan.
            </p>

        @endif

    </div>

    <!-- Form Catat Movement -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mb-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Catat Pergerakan Kendaraan</h3>
        
        <form action="{{ route('admin.vehicles.movements.store', $vehicle->id) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <!-- Tipe Pergerakan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Movement *</label>
                    <select name="type" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="IN">IN (Kendaraan Masuk)</option>
                        <option value="OUT">OUT (Kendaraan Keluar)</option>
                        <option value="TEST_DRIVE">TEST DRIVE</option>
                        <option value="SERVICE">SERVICE (Perbaikan/Bengkel)</option>
                        <option value="TRANSFER">TRANSFER (Pindah Cabang/Lokasi)</option>
                    </select>
                </div>

                <!-- Tanggal Pergerakan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal *</label>
                    <input type="date" name="movement_date" value="{{ date('Y-m-d') }}" required class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Update Status Kendaraan Utama -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Update Status Kendaraan</label>
                    <select name="new_status" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Tetapkan Status Saat Ini ({{ $vehicle->status }}) --</option>
                        <option value="AVAILABLE">AVAILABLE</option>
                        <option value="RESERVED">RESERVED</option>
                        <option value="SERVICE">SERVICE</option>
                        <option value="SOLD">SOLD</option>
                        <option value="INACTIVE">INACTIVE</option>
                    </select>
                </div>
            </div>

            <!-- No Referensi / Surat Jalan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Referensi / No. Surat Jalan (Opsional)</label>
                <input type="text" name="reference" placeholder="Contoh: SJ-2026-001" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Catatan / Keterangan -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan / Catatan *</label>
                <textarea name="notes" rows="2" required placeholder="Contoh: Kendaraan dibawa ke bengkel resmi untuk perbaikan AC..." class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                Simpan Pergerakan
            </button>
        </form>
    </div>

    <!-- Tabel Riwayat Movement -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Riwayat Pergerakan Kendaraan</h3>
        
        @if($vehicle->movements->isEmpty())
            <p class="text-gray-500 text-sm">Belum ada riwayat pergerakan untuk kendaraan ini.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="py-3 px-4">Tanggal</th>
                            <th class="py-3 px-4">Tipe</th>
                            <th class="py-3 px-4">Referensi</th>
                            <th class="py-3 px-4">Keterangan / Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($vehicle->movements as $movement)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 font-medium text-gray-900">
                                    {{ $movement->movement_date->format('d M Y') }}
                                </td>
                                <td class="py-3 px-4">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                        {{ in_array($movement->type, ['IN']) ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $movement->type }}
                                    </span>
                                </td>
                                <td class="py-3 px-4">{{ $movement->reference ?? '-' }}</td>
                                <td class="py-3 px-4">{{ $movement->notes }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

@endsection




