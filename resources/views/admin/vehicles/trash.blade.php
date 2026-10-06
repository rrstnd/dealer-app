@extends('layouts.admin')

@section('title', 'Riwayat Kendaraan Terhapus')
@section('page-title', 'RIWAYAT TERHAPUS')

@section('content')

    {{-- HEADER SECTION --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-mono-code text-rose-600 font-bold uppercase tracking-widest">ARSIP & TRASH</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                RIWAYAT MOBIL & MOTOR TERHAPUS
            </h1>
            <p class="text-xs text-zinc-500 mt-1">
                Daftar lengkap unit mobil dan motor yang telah dihapus dari katalog aktif showroom. Anda dapat memulihkan unit kembali ke inventaris.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 w-full sm:w-auto shrink-0">
            <a href="{{ route('admin.vehicles.index') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-zinc-900 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs w-full sm:w-auto">
                <svg class="w-4 h-4 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                <span>Kembali Ke Inventaris</span>
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

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white border border-zinc-200 p-4 flex items-center justify-between shadow-2xs">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Total Kendaraan Terhapus</p>
                <p class="text-2xl font-black font-mono-code text-zinc-900 mt-1">{{ number_format($totalTrashed) }}</p>
            </div>
            <div class="w-10 h-10 bg-zinc-100 border border-zinc-200 text-zinc-700 flex items-center justify-center rounded-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
            </div>
        </div>

        <div class="bg-white border border-zinc-200 p-4 flex items-center justify-between shadow-2xs">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Mobil Terhapus</p>
                <p class="text-2xl font-black font-mono-code text-blue-900 mt-1">{{ number_format($totalMobilTrashed) }}</p>
            </div>
            <div class="w-10 h-10 bg-blue-50 border border-blue-200 text-blue-700 flex items-center justify-center rounded-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.4-1.7-1.1-2.2l-3.4-2.3c-.5-.4-1.2-.6-1.9-.6H7.4c-.7 0-1.4.2-1.9.6L2.1 10.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2m15 0a3 3 0 11-6 0m6 0a3 3 0 10-6 0M4 17a3 3 0 11-6 0m6 0a3 3 0 10-6 0M5 9l2-4h10l2 4"/>
                </svg>
            </div>
        </div>

        <div class="bg-white border border-zinc-200 p-4 flex items-center justify-between shadow-2xs">
            <div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-zinc-400">Motor Terhapus</p>
                <p class="text-2xl font-black font-mono-code text-emerald-900 mt-1">{{ number_format($totalMotorTrashed) }}</p>
            </div>
            <div class="w-10 h-10 bg-emerald-50 border border-emerald-200 text-emerald-700 flex items-center justify-center rounded-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="5.5" cy="17.5" r="3.5" stroke-width="1.8"/>
                    <circle cx="18.5" cy="17.5" r="3.5" stroke-width="1.8"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 6h3l2.5 5.5M5.5 17.5L9 11h5.5l2.5 6.5M9 11l-2-5H4"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- FILTER & SEARCH BAR --}}
    <div class="bg-white border border-zinc-200 p-4 mb-6 shadow-2xs">
        <form method="GET" action="{{ route('admin.vehicles.trash') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-3">
            <div class="flex-1 relative">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari Kode Stok, Plat Nomor, Merek, atau Model..."
                       class="w-full pl-9 pr-4 py-2 bg-zinc-50 border border-zinc-300 text-xs text-zinc-900 focus:outline-hidden focus:border-zinc-900 transition">
                <svg class="w-4 h-4 text-zinc-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <div class="w-full md:w-48">
                <select name="type"
                        class="w-full px-3 py-2 bg-zinc-50 border border-zinc-300 text-xs text-zinc-900 focus:outline-hidden focus:border-zinc-900 transition font-medium">
                    <option value="">-- Semua Tipe Unit --</option>
                    <option value="mobil" {{ request('type') === 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="motor" {{ request('type') === 'motor' ? 'selected' : '' }}>Motor</option>
                </select>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 shrink-0">
                <button type="submit"
                        class="px-5 py-2 bg-zinc-900 hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition w-full sm:w-auto">
                    Cari / Filter
                </button>

                @if (request()->filled('search') || request()->filled('type'))
                    <a href="{{ route('admin.vehicles.trash') }}"
                       class="px-4 py-2 bg-zinc-200 hover:bg-zinc-300 text-zinc-700 text-xs font-bold uppercase tracking-wider transition text-center w-full sm:w-auto">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- TRASHED VEHICLES TABLE --}}
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
                            <th class="px-5 py-3.5 text-left">Plat Nomor</th>
                            <th class="px-5 py-3.5 text-left">Harga Jual</th>
                            <th class="px-5 py-3.5 text-left">Waktu Dihapus</th>
                            <th class="px-5 py-3.5 text-right">Aksi Pemulihan</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-zinc-100">
                        @foreach ($vehicles as $vehicle)
                            <tr class="hover:bg-zinc-50/80 transition">
                                <td class="px-5 py-4 text-zinc-400 font-mono-code">
                                    {{ $loop->iteration + ($vehicles->currentPage() - 1) * $vehicles->perPage() }}
                                </td>

                                <td class="px-5 py-4 font-mono-code font-bold text-zinc-900">
                                    {{ $vehicle->stock_code }}
                                </td>

                                <td class="px-5 py-4">
                                    @php
                                        $typeName = strtolower($vehicle->vehicleType->name ?? '');
                                    @endphp
                                    @if ($typeName === 'mobil')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-blue-200 bg-blue-50 text-blue-800">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.4-1.7-1.1-2.2l-3.4-2.3c-.5-.4-1.2-.6-1.9-.6H7.4c-.7 0-1.4.2-1.9.6L2.1 10.8C1.4 11.3 1 12.1 1 13v3c0 .6.4 1 1 1h2m15 0a3 3 0 11-6 0m6 0a3 3 0 10-6 0M4 17a3 3 0 11-6 0m6 0a3 3 0 10-6 0M5 9l2-4h10l2 4"/>
                                            </svg>
                                            Mobil
                                        </span>
                                    @elseif ($typeName === 'motor')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-emerald-200 bg-emerald-50 text-emerald-800">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <circle cx="5.5" cy="17.5" r="3.5" stroke-width="2"/>
                                                <circle cx="18.5" cy="17.5" r="3.5" stroke-width="2"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 6h3l2.5 5.5M5.5 17.5L9 11h5.5l2.5 6.5M9 11l-2-5H4"/>
                                            </svg>
                                            Motor
                                        </span>
                                    @else
                                        <span class="inline-block px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-zinc-200 bg-zinc-100 text-zinc-700">
                                            {{ $vehicle->vehicleType->name ?? 'Lainnya' }}
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-bold text-zinc-900 uppercase">
                                        {{ $vehicle->brand->name ?? '-' }} {{ $vehicle->model->name ?? '-' }}
                                    </div>
                                    <div class="text-[11px] text-zinc-400 font-normal">
                                        {{ $vehicle->variant ?? '-' }} &bull; {{ $vehicle->year }} &bull; {{ $vehicle->transmission ?? '-' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 font-mono-code font-medium text-zinc-700 uppercase">
                                    {{ $vehicle->license_plate ?: '-' }}
                                </td>

                                <td class="px-5 py-4 font-bold text-zinc-950">
                                    Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                                </td>

                                <td class="px-5 py-4">
                                    <div class="font-mono-code font-bold text-rose-700">
                                        {{ $vehicle->deleted_at ? $vehicle->deleted_at->format('d M Y, H:i') : '-' }}
                                    </div>
                                    <div class="text-[10px] text-zinc-400">
                                        {{ $vehicle->deleted_at ? $vehicle->deleted_at->diffForHumans() : '' }}
                                    </div>
                                </td>

                                <td class="px-5 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-1.5 justify-end">
                                        {{-- RESTORE BUTTON --}}
                                        <form action="{{ route('admin.vehicles.restore', $vehicle->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Apakah Anda yakin ingin memulihkan unit kendaraan {{ $vehicle->stock_code }} kembali ke katalog aktif?')"
                                              class="inline-block">
                                            @csrf
                                            <button type="submit"
                                                    class="px-3 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-emerald-300 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 transition cursor-pointer flex items-center gap-1"
                                                    title="Pulihkan Kendaraan Ini">
                                                <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                </svg>
                                                <span>Pulihkan</span>
                                            </button>
                                        </form>

                                        {{-- FORCE DELETE BUTTON --}}
                                        <form action="{{ route('admin.vehicles.force-delete', $vehicle->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('PERINGATAN! Data kendaraan {{ $vehicle->stock_code }} akan dihapus secara PERMANEN dari database dan tidak bisa dikembalikan lagi. Lanjutkan?')"
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-rose-300 bg-rose-50 hover:bg-rose-100 text-rose-800 transition cursor-pointer flex items-center gap-1"
                                                    title="Hapus Permanen Dari Database">
                                                <svg class="w-3.5 h-3.5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                <span>Hapus Permanen</span>
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Tidak Ada Riwayat Kendaraan Terhapus</p>
                <p class="text-[11px] text-zinc-400 mt-1">
                    @if (request()->filled('search') || request()->filled('type'))
                        Tidak ada unit kendaraan terhapus yang sesuai dengan kata kunci atau filter tipe yang dipilih.
                    @else
                        Saat ini belum ada unit mobil atau motor yang terhapus dari inventaris.
                    @endif
                </p>
                @if (request()->filled('search') || request()->filled('type'))
                    <a href="{{ route('admin.vehicles.trash') }}"
                       class="inline-block mt-4 px-5 py-2 bg-zinc-900 hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition">
                        Reset Filter
                    </a>
                @endif
            </div>
        @endif
    </div>

    {{-- PAGINATION --}}
    @if ($vehicles->hasPages())
        <div class="mt-6 bg-white border border-zinc-200 px-5 py-4 shadow-xs flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="text-xs text-zinc-500 font-mono-code uppercase">
                Menampilkan <span class="font-bold text-zinc-900">{{ $vehicles->firstItem() }}</span> - <span class="font-bold text-zinc-900">{{ $vehicles->lastItem() }}</span> dari <span class="font-bold text-zinc-900">{{ $vehicles->total() }}</span> unit terhapus
            </div>
            <div>
                {{ $vehicles->links() }}
            </div>
        </div>
    @endif

@endsection
