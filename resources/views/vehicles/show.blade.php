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

</div>

@endsection




