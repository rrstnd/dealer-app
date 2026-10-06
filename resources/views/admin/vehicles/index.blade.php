@extends('layouts.admin')

@section('title', 'Upload Kendaraan')
@section('page-title', '')

@section('content')

    {{-- HEADER SECTION --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-mono-code text-rose-600 font-bold uppercase tracking-widest">INVENTARIS UNIT</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                UPLOAD KENDARAAN DEALER
            </h1>
            <p class="text-xs text-zinc-500 mt-1">
                Kelola seluruh data unit mobil dan motor yang siap dipasarkan di showroom Suja Mobilindo.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto shrink-0">
            <a href="{{ route('admin.vehicles.trash') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-zinc-200 hover:bg-zinc-300 text-zinc-800 text-xs font-bold uppercase tracking-widest transition shadow-xs border border-zinc-300 w-full sm:w-auto">
                <svg class="w-4 h-4 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <span>Riwayat Terhapus</span>
            </a>

            <a href="{{ route('admin.vehicles.create') }}"
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs w-full sm:w-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Kendaraan Baru</span>
            </a>
        </div>
    </div>

    {{-- ALERT MESSAGES --}}
    @if (session('success'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif



    {{-- INFO KUOTA PIN BERANDA --}}
    <div class="mb-4 px-4 py-3 bg-white border border-zinc-200 shadow-2xs flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <div class="flex items-center gap-2 text-xs text-zinc-600">
            <svg class="w-4 h-4 text-[#881337] shrink-0" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 3a1 1 0 0 1 .7 1.7L15 6.4v4.2l2.7 2.7a1 1 0 0 1-.7 1.7h-4v5a1 1 0 0 1-2 0v-5H7a1 1 0 0 1-.7-1.7L9 10.6V6.4L7.3 4.7A1 1 0 0 1 8 3h8z"/>
            </svg>
            <span>Unit yang di-<b>Pin</b> akan tampil di <b>3 posisi teratas beranda</b> (hanya unit berstatus TERSEDIA).</span>
        </div>
        <span class="text-[11px] font-mono-code font-bold uppercase tracking-wider {{ $pinnedCount >= \App\Models\Vehicle::MAX_PINNED ? 'text-rose-700' : 'text-zinc-900' }}">
            Pin terpakai: {{ $pinnedCount }} / {{ \App\Models\Vehicle::MAX_PINNED }}
        </span>
    </div>

    {{-- INVENTORY TABLE --}}
    <div class="bg-white border border-zinc-200 shadow-xs overflow-hidden">
        @if ($vehicles->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-zinc-100/90 border-b border-zinc-200 text-zinc-600 uppercase tracking-wider text-[10px] font-bold whitespace-nowrap">
                        <tr>
                            <th class="px-5 py-3.5 text-left">No</th>
                            <th class="px-5 py-3.5 text-left">Kode Stok</th>
                            <th class="px-5 py-3.5 text-left">Tipe</th>
                            <th class="px-5 py-3.5 text-left">Merek & Model</th>
                            <th class="px-5 py-3.5 text-left">Tahun</th>
                            <th class="px-5 py-3.5 text-left">Harga Jual</th>
                            <th class="px-5 py-3.5 text-left">Status</th>
                            <th class="px-5 py-3.5 text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100">
                        @foreach ($vehicles as $vehicle)
                            <tr class="transition {{ $vehicle->is_pinned ? 'bg-rose-50/40 hover:bg-rose-50/70' : 'hover:bg-zinc-50/80' }}">
                                <td class="px-5 py-4 text-zinc-400 font-mono-code">
                                    {{ $loop->iteration + ($vehicles->currentPage() - 1) * $vehicles->perPage() }}
                                </td>

                                <td class="px-5 py-4 font-mono-code font-bold text-zinc-900 whitespace-nowrap">
                                    {{ $vehicle->stock_code }}
                                    @if ($vehicle->is_pinned)
                                        <span class="ml-1 inline-flex items-center gap-1 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wider bg-[#881337] text-white align-middle" title="Di-pin di beranda">
                                            <svg class="w-2.5 h-2.5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 3a1 1 0 0 1 .7 1.7L15 6.4v4.2l2.7 2.7a1 1 0 0 1-.7 1.7h-4v5a1 1 0 0 1-2 0v-5H7a1 1 0 0 1-.7-1.7L9 10.6V6.4L7.3 4.7A1 1 0 0 1 8 3h8z"/></svg>
                                            PIN
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-zinc-600">
                                    {{ $vehicle->vehicleType->name ?? '-' }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-bold text-zinc-900 uppercase">
                                        {{ $vehicle->brand->name ?? '-' }} {{ $vehicle->model->name ?? '-' }}
                                    </div>
                                    <div class="text-[11px] text-zinc-400 font-normal">
                                        {{ $vehicle->variant ?? '-' }} &bull; {{ $vehicle->transmission ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 font-mono-code text-zinc-700">
                                    {{ $vehicle->year }}
                                </td>

                                <td class="px-5 py-4 font-bold text-zinc-950">
                                    Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-4">
                                    @if ($vehicle->status === 'AVAILABLE')
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-emerald-200 bg-emerald-50 text-emerald-800">
                                            TERSEDIA
                                        </span>
                                    @elseif ($vehicle->status === 'RESERVED')
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-amber-200 bg-amber-50 text-amber-800">
                                            BOOKED
                                        </span>
                                    @elseif ($vehicle->status === 'SOLD')
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-zinc-900 bg-zinc-900 text-white">
                                            TERJUAL
                                        </span>
                                    @elseif ($vehicle->status === 'SERVICE')
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-blue-200 bg-blue-50 text-blue-800">
                                            SERVIS
                                        </span>
                                    @else
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-zinc-200 bg-zinc-100 text-zinc-600">
                                            NONAKTIF
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5 justify-end">
                                        <a href="{{ route('admin.vehicles.show', $vehicle) }}"
                                           class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-zinc-200 bg-white hover:bg-zinc-100 text-zinc-700 transition"
                                           title="Lihat Detail Unit">
                                            Detail
                                        </a>

                                        <a href="{{ route('admin.vehicles.edit', $vehicle) }}"
                                           class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-zinc-300 bg-zinc-100 hover:bg-zinc-200 text-zinc-800 transition"
                                           title="Edit Data Unit">
                                            Edit
                                        </a>

                                        {{-- PIN / LEPAS PIN BERANDA --}}
                                        <form action="{{ route('admin.vehicles.pin', $vehicle) }}"
                                              method="POST"
                                              class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            @if ($vehicle->is_pinned)
                                                <button type="submit"
                                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-[#881337] bg-[#881337] hover:bg-[#6b0f2b] text-white transition cursor-pointer"
                                                        title="Lepas pin dari beranda">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M16 3a1 1 0 0 1 .7 1.7L15 6.4v4.2l2.7 2.7a1 1 0 0 1-.7 1.7h-4v5a1 1 0 0 1-2 0v-5H7a1 1 0 0 1-.7-1.7L9 10.6V6.4L7.3 4.7A1 1 0 0 1 8 3h8z"/></svg>
                                                    Unpin
                                                </button>
                                            @else
                                                <button type="submit"
                                                        @if ($pinnedCount >= \App\Models\Vehicle::MAX_PINNED) disabled @endif
                                                        class="inline-flex items-center gap-1 px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-amber-300 bg-amber-50 hover:bg-amber-100 text-amber-800 transition cursor-pointer disabled:opacity-40 disabled:cursor-not-allowed disabled:hover:bg-amber-50"
                                                        title="{{ $pinnedCount >= \App\Models\Vehicle::MAX_PINNED ? 'Kuota pin penuh (maks. 3)' : 'Pin ke 3 teratas beranda' }}">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linejoin="round" d="M16 3a1 1 0 0 1 .7 1.7L15 6.4v4.2l2.7 2.7a1 1 0 0 1-.7 1.7h-4v5a1 1 0 0 1-2 0v-5H7a1 1 0 0 1-.7-1.7L9 10.6V6.4L7.3 4.7A1 1 0 0 1 8 3h8z"/></svg>
                                                    Pin
                                                </button>
                                            @endif
                                        </form>

                                        <form action="{{ route('admin.vehicles.destroy', $vehicle) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus unit kendaraan ini?')"
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 transition cursor-pointer"
                                                    title="Hapus Unit">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 text-center text-zinc-400">
                <svg class="w-10 h-10 mx-auto text-zinc-300 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.4-1.7-1.1-2.2l-3.4-2.3c-.5-.4-1.2-.6-1.9-.6H7.4c-.7 0-1.4.2-1.9.6L2.1 10.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2m15 0a3 3 0 11-6 0m6 0a3 3 0 10-6 0M4 17a3 3 0 11-6 0m6 0a3 3 0 10-6 0M5 9l2-4h10l2 4"/>
                </svg>
                <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Tidak Ada Kendaraan Ditemukan</p>
                <p class="text-[11px] text-zinc-400 mt-1">Coba sesuaikan kata kunci pencarian atau reset filter status.</p>
                <a href="{{ route('admin.vehicles.create') }}"
                   class="inline-block mt-4 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition">
                    + Tambah Kendaraan
                </a>
            </div>
        @endif
    </div>

    {{-- PAGINATION --}}
    @if ($vehicles->hasPages())
        <div class="mt-6 bg-white border border-zinc-200 px-5 py-4 shadow-xs flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="text-xs text-zinc-500 font-mono-code uppercase">
                Menampilkan <span class="font-bold text-zinc-900">{{ $vehicles->firstItem() }}</span> - <span class="font-bold text-zinc-900">{{ $vehicles->lastItem() }}</span> dari <span class="font-bold text-zinc-900">{{ $vehicles->total() }}</span> unit
            </div>
            <div>
                {{ $vehicles->links() }}
            </div>
        </div>
    @endif

@endsection