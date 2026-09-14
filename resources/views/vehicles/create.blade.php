<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan</title>
</head>

<body>

    <h1>Tambah Kendaraan</h1>

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

    <form action="{{ route('vehicles.store') }}" method="POST">

        @csrf

        <h3>Informasi Kendaraan</h3>

        <div>
            <label>Stock Code</label><br>

            <input
                type="text"
                name="stock_code"
                value="{{ old('stock_code') }}"
                placeholder="Contoh: MOB-004"
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
                        {{ old('vehicle_type_id') == $type->id ? 'selected' : '' }}
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
                        {{ old('brand_id') == $brand->id ? 'selected' : '' }}
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
                        {{ old('model_id') == $model->id ? 'selected' : '' }}
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
                value="{{ old('variant') }}"
                placeholder="Contoh: 1.5 G"
            >
        </div>

        <br>

        <div>
            <label>Tahun</label><br>

            <input
                type="number"
                name="year"
                value="{{ old('year') }}"
                placeholder="2024"
                required
            >
        </div>

        <br>

        <div>
            <label>Warna</label><br>

            <input
                type="text"
                name="color"
                value="{{ old('color') }}"
                placeholder="Hitam"
            >
        </div>

        <br>

        <div>
            <label>Transmisi</label><br>

            <select name="transmission">
                <option value="">-- Pilih --</option>
                <option value="Manual">Manual</option>
                <option value="Automatic">Automatic</option>
            </select>
        </div>

        <br>

        <div>
            <label>Bahan Bakar</label><br>

            <select name="fuel_type">
                <option value="">-- Pilih --</option>
                <option value="Bensin">Bensin</option>
                <option value="Diesel">Diesel</option>
                <option value="Listrik">Listrik</option>
                <option value="Hybrid">Hybrid</option>
            </select>
        </div>

        <br>

        <div>
            <label>Kapasitas Mesin (cc)</label><br>

            <input
                type="number"
                name="engine_capacity"
                value="{{ old('engine_capacity') }}"
                placeholder="1500"
            >
        </div>

        <br>

        <div>
            <label>Kilometer</label><br>

            <input
                type="number"
                name="mileage"
                value="{{ old('mileage') }}"
                placeholder="45000"
            >
        </div>

        <br>

        <div>
            <label>Plat Nomor</label><br>

            <input
                type="text"
                name="license_plate"
                value="{{ old('license_plate') }}"
                placeholder="B 1234 XYZ"
            >
        </div>

        <br>

        <h3>Harga</h3>

        <div>
            <label>Harga Beli</label><br>

            <input
                type="number"
                name="purchase_price"
                value="{{ old('purchase_price') }}"
                placeholder="165000000"
                required
            >
        </div>

        <br>

        <div>
            <label>Harga Jual</label><br>

            <input
                type="number"
                name="selling_price"
                value="{{ old('selling_price') }}"
                placeholder="185000000"
                required
            >
        </div>

        <br>

        <div>
            <label>Status</label><br>

            <select name="status" required>
                <option value="AVAILABLE">AVAILABLE</option>
                <option value="RESERVED">RESERVED</option>
                <option value="SOLD">SOLD</option>
                <option value="SERVICE">SERVICE</option>
                <option value="INACTIVE">INACTIVE</option>
            </select>
        </div>

        <br>

        <div>
            <label>Deskripsi</label><br>

            <textarea
                name="description"
                rows="5"
                cols="50"
                placeholder="Deskripsi kendaraan..."
            >{{ old('description') }}</textarea>
        </div>

        <br>

        <button type="submit">
            Simpan Kendaraan
        </button>

    </form>

</body>
</html>