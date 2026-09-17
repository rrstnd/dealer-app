@extends('layouts.admin')

@section('title', 'Detail Penjualan: ' . $sale->invoice_number)
@section('page-title', 'Transaksi Penjualan')

@section('content')
<div class="max-w-5xl space-y-6">

    {{-- HEADER SECTION --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 border border-zinc-200 shadow-xs">
        <div>
            <a href="{{ route('admin.sales.index') }}"
               class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 transition mb-2">
                <span>←</span>
                <span>Kembali ke Daftar Transaksi</span>
            </a>
            <div class="flex items-center gap-3">
                <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                    INVOICE TRANSAKSI
                </h1>
                <span class="text-xs font-mono-code font-bold uppercase tracking-wider text-zinc-900 bg-zinc-100 border border-zinc-200 px-2.5 py-1">
                    {{ $sale->invoice_number }}
                </span>
            </div>
            <p class="text-xs text-zinc-500 mt-1 font-mono-code">
                TANGGAL TRANSAKSI: {{ $sale->sale_date?->format('d F Y') ?? '-' }}
            </p>
        </div>

        <div class="flex items-center gap-2">
            @if($sale->status !== 'CANCELLED')
                <a href="{{ route('admin.sales.edit', $sale) }}"
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <span>Edit Transaksi</span>
                </a>
            @endif
        </div>
    </div>

    {{-- STATUS & FINANCIAL HERO CARD --}}
    <div class="bg-white border border-zinc-200 shadow-xs p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 border-b border-zinc-100 pb-6">
            <div>
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em] block">Status Dokumen</span>
                <div class="mt-2">
                    @php
                        $badge = match($sale->status) {
                            'COMPLETED' => ['bg' => 'bg-emerald-50 text-emerald-800 border-emerald-200', 'label' => 'SELESAI / LUNAS'],
                            'BOOKED'    => ['bg' => 'bg-amber-50 text-amber-800 border-amber-200', 'label' => 'BOOKING / TANDA JADI'],
                            'DRAFT'     => ['bg' => 'bg-zinc-100 text-zinc-700 border-zinc-300', 'label' => 'DRAFT PENAWARAN'],
                            'CANCELLED' => ['bg' => 'bg-rose-50 text-rose-800 border-rose-200', 'label' => 'TRANSAKSI DIBATALKAN'],
                            default     => ['bg' => 'bg-zinc-100 text-zinc-700 border-zinc-300', 'label' => $sale->status],
                        };
                    @endphp
                    <span class="inline-block px-3 py-1.5 text-xs font-bold tracking-wider uppercase border {{ $badge['bg'] }}">
                        {{ $badge['label'] }}
                    </span>
                </div>
            </div>

            <div class="text-left sm:text-right">
                <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em] block">Total Pelunasan</span>
                <p class="text-2xl sm:text-3xl font-light text-zinc-950 font-mono-code mt-1 tracking-tight">
                    Rp {{ number_format($sale->final_price, 0, ',', '.') }}
                </p>
            </div>
        </div>

        {{-- BREAKDOWN TABLE --}}
        <div class="pt-6 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs font-mono-code">
            <div class="p-4 bg-zinc-50 border border-zinc-100">
                <span class="text-[10px] font-bold uppercase text-zinc-400 block font-sans">Harga Unit Kendaraan</span>
                <span class="font-bold text-zinc-900 mt-1 block">Rp {{ number_format($sale->vehicle_price, 0, ',', '.') }}</span>
            </div>
            <div class="p-4 bg-zinc-50 border border-zinc-100">
                <span class="text-[10px] font-bold uppercase text-zinc-400 block font-sans">Potongan Diskon</span>
                <span class="font-bold text-rose-600 mt-1 block">- Rp {{ number_format($sale->discount, 0, ',', '.') }}</span>
            </div>
            <div class="p-4 bg-zinc-100 border border-zinc-200">
                <span class="text-[10px] font-bold uppercase text-zinc-500 block font-sans">Harga Akhir / Final</span>
                <span class="font-bold text-zinc-950 mt-1 block text-sm">Rp {{ number_format($sale->final_price, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- DETAILED CARDS (CUSTOMER & VEHICLE) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- CUSTOMER INFO --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Informasi Pembeli / Customer</h3>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Nama Pelanggan</span>
                    <a href="{{ route('admin.customers.show', $sale->customer) }}" class="font-bold text-zinc-900 uppercase hover:text-[#881337] transition mt-0.5 block">
                        {{ $sale->customer->name ?? '-' }}
                    </a>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Kode Customer</span>
                    <span class="font-mono-code text-zinc-700 mt-0.5 block">{{ $sale->customer->customer_code ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Nomor Telepon</span>
                    <span class="font-mono-code font-bold text-zinc-900 mt-0.5 block">{{ $sale->customer->phone ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Alamat Email</span>
                    <span class="text-zinc-600 mt-0.5 block">{{ $sale->customer->email ?? 'Tidak terdaftar' }}</span>
                </div>
            </div>
        </div>

        {{-- VEHICLE INFO --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Unit Kendaraan Terjual</h3>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Merek & Model Unit</span>
                    <a href="{{ route('admin.vehicles.show', $sale->vehicle) }}" class="font-bold text-zinc-900 uppercase hover:text-[#881337] transition mt-0.5 block">
                        {{ $sale->vehicle->brand->name ?? '-' }} {{ $sale->vehicle->model->name ?? '-' }}
                    </a>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Kode Stok</span>
                    <span class="font-mono-code font-bold text-zinc-900 mt-0.5 block">{{ $sale->vehicle->stock_code ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Tahun & Transmisi</span>
                    <span class="font-mono-code text-zinc-700 mt-0.5 block">{{ $sale->vehicle->year ?? '-' }} &bull; {{ $sale->vehicle->transmission ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Nomor Polisi (Plat)</span>
                    <span class="font-mono-code font-bold text-zinc-900 uppercase mt-0.5 block">{{ $sale->vehicle->license_plate ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- TRANSACTION METADATA --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Metadata Transaksi</h3>
            </div>

            <div class="space-y-3 text-xs">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Tanggal Penjualan</span>
                    <span class="font-mono-code text-zinc-800 mt-0.5 block">{{ $sale->sale_date?->format('d M Y') ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Konsultan / Sales Person</span>
                    <span class="font-semibold text-zinc-800 mt-0.5 block">{{ $sale->sales_person ?? '-' }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Waktu Pencatatan Sistem</span>
                    <span class="font-mono-code text-zinc-500 mt-0.5 block">{{ $sale->created_at?->format('d M Y H:i') ?? '-' }} WIB</span>
                </div>
            </div>
        </div>

        {{-- NOTES --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Catatan & Syarat Khusus</h3>
            </div>

            <div>
                <p class="text-xs text-zinc-600 leading-relaxed italic bg-zinc-50 p-4 border border-zinc-200">
                    {{ $sale->notes ? '"' . $sale->notes . '"' : 'Tidak ada catatan tambahan untuk transaksi ini.' }}
                </p>
            </div>
        </div>

    </div>

    {{-- CANCEL TRANSACTION SECTION --}}
    @if($sale->status !== 'CANCELLED' && $sale->status !== 'COMPLETED')
        <div class="bg-rose-50/70 border border-rose-200 p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h4 class="font-bold text-rose-900 text-xs uppercase tracking-wider">Batalkan Transaksi Penjualan</h4>
                <p class="text-xs text-rose-600 mt-0.5">Membatalkan transaksi akan secara otomatis mengembalikan status unit kendaraan menjadi TERSEDIA di inventaris.</p>
            </div>
            <form method="POST" action="{{ route('admin.sales.cancel', $sale) }}"
                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan transaksi {{ $sale->invoice_number }}?')">
                @csrf
                @method('PATCH')
                <button type="submit" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-widest transition cursor-pointer shadow-xs">
                    Batalkan Transaksi
                </button>
            </form>
        </div>
    @endif

</div>
@endsection
