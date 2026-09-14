@extends('layouts.admin')

@section('content')
    <div>
        <h1>Edit Penjualan</h1>

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

        <form
            method="POST"
            action="{{ route('admin.sales.update', $sale) }}"
        >
            @csrf
            @method('PUT')

            <div>
                <label>Invoice</label>

                <input
                    type="text"
                    value="{{ $sale->invoice_number }}"
                    readonly
                >
            </div>

            <br>

            <div>
                <label>Customer</label>

                <select name="customer_id" required>
                    @foreach ($customers as $customer)
                        <option
                            value="{{ $customer->id }}"
                            @selected($sale->customer_id == $customer->id)
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
                    @foreach ($vehicles as $vehicle)
                        <option
                            value="{{ $vehicle->id }}"
                            @selected($sale->vehicle_id == $vehicle->id)
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
                    value="{{ old('discount', $sale->discount) }}"
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
                    value="{{ old('sale_date', $sale->sale_date?->format('Y-m-d')) }}"
                    required
                >
            </div>

            <br>

            <div>
                <label>Sales Person</label>

                <input
                    type="text"
                    name="sales_person"
                    value="{{ old('sales_person', $sale->sales_person) }}"
                >
            </div>

            <br>

            <div>
                <label>Status</label>

                <select name="status" required>
                    <option
                        value="DRAFT"
                        @selected($sale->status === 'DRAFT')
                    >
                        DRAFT
                    </option>

                    <option
                        value="BOOKED"
                        @selected($sale->status === 'BOOKED')
                    >
                        BOOKED
                    </option>

                    <option
                        value="COMPLETED"
                        @selected($sale->status === 'COMPLETED')
                    >
                        COMPLETED
                    </option>

                    <option
                        value="CANCELLED"
                        @selected($sale->status === 'CANCELLED')
                    >
                        CANCELLED
                    </option>
                </select>
            </div>

            <br>

            <div>
                <label>Catatan</label>

                <textarea name="notes">{{ old('notes', $sale->notes) }}</textarea>
            </div>

            <br>

            <button type="submit">
                Update Penjualan
            </button>

            <a href="{{ route('admin.sales.index') }}">
                Kembali
            </a>
        </form>
    </div>
@endsection