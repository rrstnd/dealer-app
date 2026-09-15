<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan</title>
</head>
<body>

<h1>Tambah Kendaraan</h1>

<a href="{{ route('admin.vehicles.index') }}">
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

<form action="{{ route('admin.vehicles.store') }}" method="POST">
    @csrf

    <h3>Informasi Kendaraan</h3>

    {{-- Stock Code --}}
    <div>
        <label>Stock Code</label><br>

        <input
            type="text"
            name="stock_code"
            value="{{ old('stock_code', $nextStockCode) }}"
            readonly
            required
        >

        <small>
            Stock Code dibuat otomatis oleh sistem.
        </small>
    </div>

    <br>

    {{-- Type --}}
    <div>
        <label>Jenis Kendaraan</label><br>

        <input
            type="text"
            name="type"
            value="{{ old('type') }}"
            placeholder="Contoh: Motor"
            required
        >

        @error('type')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Brand --}}
    <div>
        <label>Brand</label><br>

        <input
            type="text"
            name="brand"
            value="{{ old('brand') }}"
            placeholder="Contoh: Honda"
            required
        >

        @error('brand')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Model --}}
    <div>
        <label>Model</label><br>

        <input
            type="text"
            name="model"
            value="{{ old('model') }}"
            placeholder="Contoh: Beat"
            required
        >

        @error('model')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Variant --}}
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

    {{-- Tahun --}}
    <div>
        <label>Tahun</label><br>

        <input
            type="number"
            name="year"
            value="{{ old('year') }}"
            placeholder="2024"
            required
        >

        @error('year')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Warna --}}
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

    {{-- Transmisi --}}
    <div>
        <label>Transmisi</label><br>

        <select name="transmission">
            <option value="">-- Pilih --</option>

            <option value="Manual"
                {{ old('transmission') === 'Manual' ? 'selected' : '' }}>
                Manual
            </option>

            <option value="Automatic"
                {{ old('transmission') === 'Automatic' ? 'selected' : '' }}>
                Automatic
            </option>
        </select>
    </div>

    <br>

    {{-- Bahan Bakar --}}
    <div>
        <label>Bahan Bakar</label><br>

        <select name="fuel_type">
            <option value="">-- Pilih --</option>

            <option value="Bensin"
                {{ old('fuel_type') === 'Bensin' ? 'selected' : '' }}>
                Bensin
            </option>

            <option value="Diesel"
                {{ old('fuel_type') === 'Diesel' ? 'selected' : '' }}>
                Diesel
            </option>

            <option value="Listrik"
                {{ old('fuel_type') === 'Listrik' ? 'selected' : '' }}>
                Listrik
            </option>

            <option value="Hybrid"
                {{ old('fuel_type') === 'Hybrid' ? 'selected' : '' }}>
                Hybrid
            </option>
        </select>
    </div>

    <br>

    {{-- Kapasitas Mesin --}}
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

    {{-- Kilometer --}}
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

    {{-- Plat Nomor --}}
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

    {{-- Nomor Rangka --}}
    <div>
        <label>Nomor Rangka</label><br>

        <input
            type="text"
            name="chassis_number"
            value="{{ old('chassis_number') }}"
            placeholder="Nomor rangka"
        >

        @error('chassis_number')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Nomor Mesin --}}
    <div>
        <label>Nomor Mesin</label><br>

        <input
            type="text"
            name="engine_number"
            value="{{ old('engine_number') }}"
            placeholder="Nomor mesin"
        >

        @error('engine_number')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Tahun Registrasi --}}
    <div>
        <label>Tahun Registrasi</label><br>

        <input
            type="number"
            name="registration_year"
            value="{{ old('registration_year') }}"
            placeholder="2024"
        >

        @error('registration_year')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    <h3>Harga</h3>

    {{-- Harga Beli --}}
    <div>
        <label>Harga Beli</label><br>

        <input
            type="number"
            name="purchase_price"
            value="{{ old('purchase_price') }}"
            placeholder="165000000"
            required
        >

        @error('purchase_price')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Harga Jual --}}
    <div>
        <label>Harga Jual</label><br>

        <input
            type="number"
            name="selling_price"
            value="{{ old('selling_price') }}"
            placeholder="185000000"
            required
        >

        @error('selling_price')
            <div>{{ $message }}</div>
        @enderror
    </div>

    <br>

    {{-- Status --}}
    <div>
        <label>Status</label><br>

        <select name="status" required>
            <option value="AVAILABLE"
                {{ old('status', 'AVAILABLE') === 'AVAILABLE' ? 'selected' : '' }}>
                AVAILABLE
            </option>

            <option value="RESERVED"
                {{ old('status') === 'RESERVED' ? 'selected' : '' }}>
                RESERVED
            </option>

            <option value="SOLD"
                {{ old('status') === 'SOLD' ? 'selected' : '' }}>
                SOLD
            </option>

            <option value="SERVICE"
                {{ old('status') === 'SERVICE' ? 'selected' : '' }}>
                SERVICE
            </option>

            <option value="INACTIVE"
                {{ old('status') === 'INACTIVE' ? 'selected' : '' }}>
                INACTIVE
            </option>
        </select>
    </div>

    <br>

    {{-- Deskripsi --}}
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
