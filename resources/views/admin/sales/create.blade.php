@extends('layouts.admin')

@section('content')

<div>

<h1>Tambah Penjualan</h1>

@if ($errors->any())
    <div>
        <strong>Terjadi kesalahan:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.sales.store') }}">
    @csrf

    {{-- Customer --}}
    <div>
        <label for="customer_id">Customer</label><br>

        <select name="customer_id" id="customer_id" required>
            <option value="">-- Pilih Customer --</option>

            @foreach ($customers as $customer)
                <option
                    value="{{ $customer->id }}"
                    @selected(old('customer_id') == $customer->id)
                >
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    {{-- Kendaraan --}}
    <div>
        <label for="vehicle_id">Kendaraan</label><br>

        <select name="vehicle_id" id="vehicle_id" required>
            <option value="">-- Pilih Kendaraan --</option>

            @foreach ($vehicles as $vehicle)
                <option
                    value="{{ $vehicle->id }}"
                    @selected(old('vehicle_id') == $vehicle->id)
                >
                    {{ $vehicle->stock_code }}
                    -
                    {{ $vehicle->brand->name }}
                    {{ $vehicle->model->name }}
                    -
                    Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                </option>
            @endforeach
        </select>
    </div>

    <br>

    {{-- Discount --}}
    <div>
        <label for="discount">Discount</label><br>

        <input
            type="number"
            name="discount"
            id="discount"
            value="{{ old('discount', 0) }}"
            min="0"
            step="0.01"
        >
    </div>

    <br>

    {{-- Tanggal Penjualan --}}
    <div>
        <label for="sale_date">Tanggal Penjualan</label><br>

        <input
            type="date"
            name="sale_date"
            id="sale_date"
            value="{{ old('sale_date', now()->format('Y-m-d')) }}"
            required
        >
    </div>

    <br>

    {{-- Sales Person --}}
    <div>
        <label for="sales_person">Sales Person</label><br>

        <input
            type="text"
            name="sales_person"
            id="sales_person"
            value="{{ old('sales_person') }}"
            maxlength="100"
        >
    </div>

    <br>

    {{-- Status --}}
    <div>
        <label for="status">Status</label><br>

        <select name="status" id="status" required>

            <option
                value="DRAFT"
                @selected(old('status', 'DRAFT') === 'DRAFT')
            >
                DRAFT
            </option>

            <option
                value="BOOKED"
                @selected(old('status') === 'BOOKED')
            >
                BOOKED
            </option>

            <option
                value="COMPLETED"
                @selected(old('status') === 'COMPLETED')
            >
                COMPLETED
            </option>

            <option
                value="CANCELLED"
                @selected(old('status') === 'CANCELLED')
            >
                CANCELLED
            </option>

        </select>
    </div>

    <br>

    {{-- Catatan --}}
    <div>
        <label for="notes">Catatan</label><br>

        <textarea
            name="notes"
            id="notes"
            rows="5"
        >{{ old('notes') }}</textarea>
    </div>

    <br>

    <button type="submit">
        Simpan Penjualan
    </button>

</form>

</div>

@endsection
