<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Kendaraan - Dealer App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <h1>Daftar Kendaraan</h1>

    <a href="{{ route('home') }}">← Home</a>

    <hr>

    <h2>Filter Kendaraan</h2>

    <form method="GET" action="{{ route('vehicles.index') }}">

        {{-- Search --}}
        <div>
            <label>
                Cari kendaraan
            </label>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Merk, model, stock code..."
            >
        </div>

        <br>

        {{-- Brand --}}
        <div>
            <label>
                Brand
            </label>

            <select name="brand_id">

                <option value="">
                    Semua Brand
                </option>

                @foreach ($brands as $brand)
                    <option
                        value="{{ $brand->id }}"
                        {{ request('brand_id') == $brand->id ? 'selected' : '' }}
                    >
                        {{ $brand->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <br>

        {{-- Tahun --}}
        <div>
            <label>
                Tahun
            </label>

            <input
                type="number"
                name="year_min"
                value="{{ request('year_min') }}"
                placeholder="Tahun min"
            >

            <input
                type="number"
                name="year_max"
                value="{{ request('year_max') }}"
                placeholder="Tahun max"
            >
        </div>

        <br>

        {{-- Harga --}}
        <div>
            <label>
                Harga
            </label>

            <input
                type="number"
                name="price_min"
                value="{{ request('price_min') }}"
                placeholder="Harga min"
            >

            <input
                type="number"
                name="price_max"
                value="{{ request('price_max') }}"
                placeholder="Harga max"
            >
        </div>

        <br>

        {{-- Sorting --}}
        <div>
            <label>
                Urutkan
            </label>

            <select name="sort">

                <option value="">
                    Pilih urutan
                </option>

                <option
                    value="price_asc"
                    {{ request('sort') == 'price_asc' ? 'selected' : '' }}
                >
                    Termurah
                </option>

                <option
                    value="price_desc"
                    {{ request('sort') == 'price_desc' ? 'selected' : '' }}
                >
                    Termahal
                </option>

                <option
                    value="year_desc"
                    {{ request('sort') == 'year_desc' ? 'selected' : '' }}
                >
                    Tahun Terbaru
                </option>

            </select>
        </div>

        <br>

        <button type="submit">
            Terapkan Filter
        </button>

        <a href="{{ route('vehicles.index') }}">
            Reset
        </a>

    </form>

    <hr>

    <h2>Daftar Kendaraan</h2>

    @forelse ($vehicles as $vehicle)

        <div style="margin-bottom: 30px;">

            @if ($vehicle->primaryImage)

                <img
                    src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                    alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}"
                    width="250"
                >

            @endif

            <h2>
                {{ $vehicle->brand->name }}
                {{ $vehicle->model->name }}
            </h2>

            <p>
                Tahun:
                {{ $vehicle->year }}
            </p>

            <p>
                Harga:
                Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
            </p>

            <a href="{{ route('vehicles.show', $vehicle) }}">
                Lihat Detail
            </a>

        </div>

    @empty

        <p>
            Tidak ada kendaraan yang tersedia.
        </p>

    @endforelse

    <hr>

    {{ $vehicles->links() }}

</body>
</html>
