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

            <div>
                <label>Customer</label>

                <select name="customer_id" required>
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

            <div>
                <label>Kendaraan</label>

                <select name="vehicle_id" required>
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

            <div>
                <label>Discount</label>

                <input
                    type="number"
                    name="discount"
                    value="{{ old('discount', 0) }}"
                    min="0"
                    step="0.01"
                >
            </div>

            <br>

            <div>
                <label>Tanggal Penjualan</label>

                <input
                    type="date"
                    name="sale_date"
                    value="{{ old('sale_date', now()->format('Y-m-d')) }}"
                    required
                >
            </div>

            <br>

            <div>
                <label>Sales Person</label>

                <input
                    type="text"
                    name="sales_person"
                    value="{{ old('sales_person') }}"
                >
            </div>

            <br>

            <div>
                <label>Status</label>

                <select name="status" required>
                    <option value="DRAFT">DRAFT</option>
                    <option value="BOOKED">BOOKED</option>
                    <option value="COMPLETED">COMPLETED</option>
                    <option value="CANCELLED">CANCELLED</option>
                </select>
            </div>

            <br>

            <div>
                <label>Catatan</label>

                <textarea name="notes">{{ old('notes') }}</textarea>
            </div>

            <br>

            <button type="submit">
                Simpan Penjualan
            </button>
        </form>
    </div>
@endsection