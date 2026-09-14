<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan</title>
</head>
<body>

<h1>Edit Kendaraan</h1>

<a href="{{ route('vehicles.index') }}">
    ← Kembali ke Inventory
</a>

<hr>

@if ($errors->any())
    <div>
        <strong>Terjadi kesalahan:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <hr>
@endif

<form action="{{ route('vehicles.update', $vehicle) }}" method="POST">

    @csrf
    @method('PUT')

    <h3>Informasi Kendaraan</h3>

    <div>
        <label>Stock Code</label><br>
        <input
            type="text"
            name="stock_code"
            value="{{ old('stock_code', $vehicle->stock_code) }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Jenis Kendaraan</label><br>

        <select name="vehicle_type_id" required>
            <option value="">-- Pilih Jenis --</option>

            @foreach ($vehicleTypes as $type)
                <option
                    value="{{ $type->id }}"
                    {{ old('vehicle_type_id', $vehicle->vehicle_type_id) == $type->id ? 'selected' : '' }}
                >
                    {{ $type->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Brand</label><br>

        <select name="brand_id" required>
            <option value="">-- Pilih Brand --</option>

            @foreach ($brands as $brand)
                <option
                    value="{{ $brand->id }}"
                    {{ old('brand_id', $vehicle->brand_id) == $brand->id ? 'selected' : '' }}
                >
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Model</label><br>

        <select name="model_id" required>
            <option value="">-- Pilih Model --</option>

            @foreach ($models as $model)
                <option
                    value="{{ $model->id }}"
                    {{ old('model_id', $vehicle->model_id) == $model->id ? 'selected' : '' }}
                >
                    {{ $model->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Variant</label><br>
        <input
            type="text"
            name="variant"
            value="{{ old('variant', $vehicle->variant) }}"
        >
    </div>

    <br>

    <div>
        <label>Tahun</label><br>
        <input
            type="number"
            name="year"
            value="{{ old('year', $vehicle->year) }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Warna</label><br>
        <input
            type="text"
            name="color"
            value="{{ old('color', $vehicle->color) }}"
        >
    </div>

    <br>

    <div>
        <label>Transmisi</label><br>

        <select name="transmission">
            <option value="">-- Pilih Transmisi --</option>

            <option
                value="Manual"
                {{ old('transmission', $vehicle->transmission) == 'Manual' ? 'selected' : '' }}
            >
                Manual
            </option>

            <option
                value="Automatic"
                {{ old('transmission', $vehicle->transmission) == 'Automatic' ? 'selected' : '' }}
            >
                Automatic
            </option>
        </select>
    </div>

    <br>

    <div>
        <label>Bahan Bakar</label><br>

        <select name="fuel_type">
            <option value="">-- Pilih Bahan Bakar --</option>

            <option
                value="Bensin"
                {{ old('fuel_type', $vehicle->fuel_type) == 'Bensin' ? 'selected' : '' }}
            >
                Bensin
            </option>

            <option
                value="Diesel"
                {{ old('fuel_type', $vehicle->fuel_type) == 'Diesel' ? 'selected' : '' }}
            >
                Diesel
            </option>

            <option
                value="Listrik"
                {{ old('fuel_type', $vehicle->fuel_type) == 'Listrik' ? 'selected' : '' }}
            >
                Listrik
            </option>

            <option
                value="Hybrid"
                {{ old('fuel_type', $vehicle->fuel_type) == 'Hybrid' ? 'selected' : '' }}
            >
                Hybrid
            </option>
        </select>
    </div>

    <br>

    <div>
        <label>Kapasitas Mesin (cc)</label><br>

        <input
            type="number"
            name="engine_capacity"
            value="{{ old('engine_capacity', $vehicle->engine_capacity) }}"
        >
    </div>

    <br>

    <div>
        <label>Kilometer</label><br>

        <input
            type="number"
            name="mileage"
            value="{{ old('mileage', $vehicle->mileage) }}"
        >
    </div>

    <br>

    <div>
        <label>Plat Nomor</label><br>

        <input
            type="text"
            name="license_plate"
            value="{{ old('license_plate', $vehicle->license_plate) }}"
        >
    </div>

    <br>

    <h3>Harga</h3>

    <div>
        <label>Harga Beli</label><br>

        <input
            type="number"
            name="purchase_price"
            value="{{ old('purchase_price', $vehicle->purchase_price) }}"
            required
        >
    </div>

    <br>

    <div>
        <label>Harga Jual</label><br>

        <input
            type="number"
            name="selling_price"
            value="{{ old('selling_price', $vehicle->selling_price) }}"
            required
        >
    </div>

    <br>

    <h3>Status</h3>

    <div>
        <label>Status</label><br>

        <select name="status" required>

            <option
                value="AVAILABLE"
                {{ old('status', $vehicle->status) == 'AVAILABLE' ? 'selected' : '' }}
            >
                AVAILABLE
            </option>

            <option
                value="RESERVED"
                {{ old('status', $vehicle->status) == 'RESERVED' ? 'selected' : '' }}
            >
                RESERVED
            </option>

            <option
                value="SOLD"
                {{ old('status', $vehicle->status) == 'SOLD' ? 'selected' : '' }}
            >
                SOLD
            </option>

            <option
                value="SERVICE"
                {{ old('status', $vehicle->status) == 'SERVICE' ? 'selected' : '' }}
            >
                SERVICE
            </option>

            <option
                value="INACTIVE"
                {{ old('status', $vehicle->status) == 'INACTIVE' ? 'selected' : '' }}
            >
                INACTIVE
            </option>

        </select>
    </div>

    <br>

    <div>
        <label>Deskripsi</label><br>

        <textarea
            name="description"
            rows="5"
        >{{ old('description', $vehicle->description) }}</textarea>
    </div>

    <br>

    <button type="submit">
        Simpan Perubahan
    </button>

</form>

</body>
</html>