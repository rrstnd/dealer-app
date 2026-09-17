@extends('layouts.admin')

@section('title', 'Edit Transaksi Penjualan: ' . $sale->invoice_number)
@section('page-title', 'Transaksi Penjualan')

@section('content')
<div class="max-w-4xl space-y-6">

    {{-- HEADER SECTION --}}
    <div class="mb-6">
        <a href="{{ route('admin.sales.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 transition mb-2">
            <span>←</span>
            <span>Kembali ke Daftar Transaksi</span>
        </a>
        <div class="flex items-center gap-3">
            <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                EDIT TRANSAKSI PENJUALAN
            </h1>
            <span class="text-xs font-mono-code font-bold uppercase tracking-wider text-zinc-500 bg-zinc-200/80 px-2.5 py-1">
                {{ $sale->invoice_number }}
            </span>
        </div>
        <p class="text-xs text-zinc-500 mt-1">
            Perbarui data pembeli, unit kendaraan, diskon, atau status transaksi di bawah ini.
        </p>
    </div>

    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold">
            <div class="font-bold uppercase tracking-wider mb-1">Terdapat kesalahan pengisian data:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CONTAINER (CARITA LUXURY DESIGN) --}}
    <form method="POST" action="{{ route('admin.sales.update', $sale) }}" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- SECTION 1: INVOICE & CUSTOMER --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    1. Nomor Invoice & Pihak Terkait
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-5">
                {{-- Invoice Number --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-600 mb-1.5">
                        Nomor Invoice (Permanen)
                    </label>
                    <input type="text"
                           value="{{ $sale->invoice_number }}"
                           readonly
                           class="w-full px-3 py-2.5 bg-zinc-100 border border-zinc-300 text-zinc-600 text-xs font-mono-code font-bold cursor-not-allowed">
                </div>

                {{-- Customer Selector --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Pelanggan / Customer <span class="text-rose-600">*</span>
                    </label>
                    <select name="customer_id" required
                            class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}" @selected($sale->customer_id == $customer->id)>
                                {{ $customer->name }} ({{ $customer->customer_code }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Vehicle Selector --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Unit Kendaraan <span class="text-rose-600">*</span>
                    </label>
                    <select name="vehicle_id" required
                            class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition font-mono-code">
                        @foreach ($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}" @selected($sale->vehicle_id == $vehicle->id)>
                                [{{ $vehicle->stock_code }}] {{ $vehicle->brand->name }} {{ $vehicle->model->name }} ({{ $vehicle->year }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- SECTION 2: KEUANGAN & TANGGAL TRANSAKSI --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    2. Rincian Finansial & Tanggal Transaksi
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-5">
                {{-- Discount --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Potongan Diskon (Rp)
                    </label>
                    <input type="number"
                           name="discount"
                           value="{{ old('discount', $sale->discount) }}"
                           min="0"
                           step="1000"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Tanggal Penjualan --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Tanggal Transaksi <span class="text-rose-600">*</span>
                    </label>
                    <input type="date"
                           name="sale_date"
                           value="{{ old('sale_date', $sale->sale_date?->format('Y-m-d')) }}"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Sales Person --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Nama Sales / Konsultan
                    </label>
                    <input type="text"
                           name="sales_person"
                           value="{{ old('sales_person', $sale->sales_person) }}"
                           maxlength="100"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Status Transaksi --}}
                <div class="sm:col-span-3">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Status Transaksi Penjualan <span class="text-rose-600">*</span>
                    </label>
                    <select name="status" required
                            class="w-full sm:w-1/3 px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition font-bold uppercase">
                        <option value="DRAFT" @selected($sale->status === 'DRAFT')>DRAFT (Draft Penawaran)</option>
                        <option value="BOOKED" @selected($sale->status === 'BOOKED')>BOOKED (Tanda Jadi / Booking)</option>
                        <option value="COMPLETED" @selected($sale->status === 'COMPLETED')>COMPLETED (Selesai / Lunas)</option>
                        <option value="CANCELLED" @selected($sale->status === 'CANCELLED')>CANCELLED (Dibatalkan)</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- SECTION 3: CATATAN TRANSAKSI --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    3. Catatan & Syarat Tambahan
                </h2>
            </div>

            <div class="p-6">
                <textarea name="notes"
                          rows="3"
                          placeholder="Metode pembayaran (Cash / Kredit via Leasing), nomor referensi, bonus aksesoris, dll..."
                          class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">{{ old('notes', $sale->notes) }}</textarea>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.sales.index') }}"
               class="px-5 py-2.5 border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-700 text-xs font-bold uppercase tracking-wider transition">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs flex items-center gap-2">
                <span>Perbarui Transaksi Penjualan</span>
                <span>→</span>
            </button>
        </div>

    </form>
</div>
@endsection