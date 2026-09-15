@extends('layouts.admin')

@section('content')
    <div>
        <h1>Penjualan</h1>

        <a href="{{ route('admin.sales.create') }}">
            Tambah Penjualan
        </a>

        <hr>

        @if ($sales->count())
            <table border="1" cellpadding="8">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Kendaraan</th>
                        <th>Harga</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->invoice_number }}</td>
                            <td>{{ $sale->sale_date?->format('d-m-Y') }}</td>
                            <td>{{ $sale->customer->name }}</td>
                            <td>
                                {{ $sale->vehicle->brand->name }}
                                {{ $sale->vehicle->model->name }}
                            </td>
                            <td>
                                Rp {{ number_format($sale->vehicle_price, 0, ',', '.') }}
                            </td>
                            <td>
                                Rp {{ number_format($sale->discount, 0, ',', '.') }}
                            </td>
                            <td>
                                Rp {{ number_format($sale->final_price, 0, ',', '.') }}
                            </td>
                            <td>{{ $sale->status }}</td>
                            <td>
                                <a
                                    href="{{ route('admin.sales.edit', $sale) }}"
                                    class="text-blue-600 hover:text-blue-700 font-medium"
                                >
                                    Edit
                                </a>

                                @if ($sale->status !== 'CANCELLED')
                                    <form
                                        method="POST"
                                        action="{{ route('admin.sales.cancel', $sale) }}"
                                        style="display:inline;"
                                        onsubmit="return confirm('Yakin ingin membatalkan transaksi ini?')"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="text-red-600 hover:text-red-700 font-medium ml-3"
                                        >
                                            Cancel
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $sales->links() }}
        @else
            <p>Belum ada data penjualan.</p>
        @endif
    </div>
@endsection