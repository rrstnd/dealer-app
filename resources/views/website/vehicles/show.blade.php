<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        {{ $vehicle->brand->name }}
        {{ $vehicle->model->name }}
        - Dealer App
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <a href="{{ route('vehicles.index') }}">
        ← Kembali ke Kendaraan
    </a>

    <hr>

    <h1>
        {{ $vehicle->brand->name }}
        {{ $vehicle->model->name }}
    </h1>

    <p>
        Stock Code: {{ $vehicle->stock_code }}
    </p>

    <p>
        Tahun: {{ $vehicle->year }}
    </p>

    @if ($vehicle->variant)
        <p>
            Variant: {{ $vehicle->variant }}
        </p>
    @endif

    @if ($vehicle->color)
        <p>
            Warna: {{ $vehicle->color }}
        </p>
    @endif

    @if ($vehicle->transmission)
        <p>
            Transmisi: {{ $vehicle->transmission }}
        </p>
    @endif

    @if ($vehicle->fuel_type)
        <p>
            Bahan Bakar: {{ $vehicle->fuel_type }}
        </p>
    @endif

    @if ($vehicle->mileage !== null)
        <p>
            Kilometer:
            {{ number_format($vehicle->mileage, 0, ',', '.') }} km
        </p>
    @endif

    <h2>
        Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
    </h2>

    <p>
        Status: {{ $vehicle->status }}
    </p>

    @if ($vehicle->description)
        <h3>Deskripsi</h3>

        <p>
            {{ $vehicle->description }}
        </p>
    @endif

    <hr>

    <h2>Foto Kendaraan</h2>

    @forelse ($vehicle->images as $image)

        <img
            src="{{ asset('storage/' . $image->image_path) }}"
            alt="Foto kendaraan"
            width="300"
            style="margin: 10px;"
        >

    @empty

        <p>
            Belum ada foto kendaraan.
        </p>

    @endforelse

</body>
</html>
