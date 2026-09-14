<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dealer App</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <h1>Dealer App</h1>

    <p>Website Dealer</p>

    <a href="{{ route('vehicles.index') }}">
        Lihat Semua Kendaraan
    </a>

    <hr>

    <h2>Kendaraan Tersedia</h2>

    @forelse ($vehicles as $vehicle)

        <div style="margin-bottom: 20px;">

            @if ($vehicle->primaryImage)
                <img
                    src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                    alt="{{ $vehicle->brand->name }} {{ $vehicle->model->name }}"
                    width="250"
                >
            @endif

            <h3>
                {{ $vehicle->brand->name }}
                {{ $vehicle->model->name }}
            </h3>

            <p>
                Tahun: {{ $vehicle->year }}
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

        <p>Belum ada kendaraan tersedia.</p>

    @endforelse

</body>
</html>
