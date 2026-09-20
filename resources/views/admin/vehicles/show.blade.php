@extends('layouts.admin')

@section('title', 'Detail Kendaraan: ' . ($vehicle->brand->name ?? '') . ' ' . ($vehicle->model->name ?? ''))
@section('page-title', 'Detail Kendaraan')

@section('content')

    {{-- TOP NAVIGATION & ACTIONS --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <a href="{{ route('admin.vehicles.index') }}"
               class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 transition mb-2">
                <span>←</span>
                <span>Kembali ke Upload Kendaraan</span>
            </a>
            <div class="flex items-center gap-3">
                <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                    {{ $vehicle->brand->name ?? '-' }} <span class="font-bold">{{ $vehicle->model->name ?? '-' }}</span>
                </h1>
                <div>
                    @if ($vehicle->status === 'AVAILABLE')
                        <span class="px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-emerald-200 bg-emerald-50 text-emerald-800">
                            TERSEDIA
                        </span>
                    @elseif ($vehicle->status === 'RESERVED')
                        <span class="px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-amber-200 bg-amber-50 text-amber-800">
                            BOOKED
                        </span>
                    @elseif ($vehicle->status === 'SOLD')
                        <span class="px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-zinc-900 bg-zinc-900 text-white">
                            TERJUAL
                        </span>
                    @else
                        <span class="px-2.5 py-1 text-[10px] font-bold tracking-wider uppercase border border-zinc-200 bg-zinc-100 text-zinc-600">
                            {{ $vehicle->status }}
                        </span>
                    @endif
                </div>
            </div>
            <p class="text-xs text-zinc-400 mt-1 font-mono-code uppercase tracking-wider">
                KODE STOK: {{ $vehicle->stock_code }} &bull; TAHUN: {{ $vehicle->year }}
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('vehicles.show', $vehicle) }}" target="_blank"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-800 text-xs font-bold uppercase tracking-wider transition">
                <span>Pratinjau Web</span>
                <span class="text-rose-600">↗</span>
            </a>

            <a href="{{ route('admin.vehicles.edit', $vehicle) }}"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                <span>Edit Data Unit</span>
            </a>
        </div>
    </div>

    {{-- ALERTS --}}
    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold flex items-center gap-2">
            <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- SPECIFICATION SUMMARY GRID (CARITA LUXURY STYLE) --}}
    <div class="bg-white border border-zinc-200 mb-8 shadow-xs">
        <div class="px-6 py-4 border-b border-zinc-100 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    Spesifikasi & Informasi Detail Kendaraan
                </h2>
            </div>
            <span class="text-xs font-mono-code font-bold text-zinc-900">
                HARGA JUAL: Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
            </span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 divide-x divide-y divide-zinc-100 text-xs">
            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Kode Stok</span>
                <span class="font-mono-code font-bold text-zinc-900">{{ $vehicle->stock_code }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Tipe Kendaraan</span>
                <span class="font-semibold text-zinc-800">{{ $vehicle->vehicleType->name ?? '-' }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Merek</span>
                <span class="font-bold text-zinc-900 uppercase">{{ $vehicle->brand->name ?? '-' }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Model & Varian</span>
                <span class="font-semibold text-zinc-800">{{ $vehicle->model->name ?? '-' }} {{ $vehicle->variant }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Tahun Produksi</span>
                <span class="font-mono-code text-zinc-800 font-medium">{{ $vehicle->year }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Transmisi</span>
                <span class="font-semibold text-zinc-800">{{ $vehicle->transmission ?? '-' }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Warna Kendaraan</span>
                <span class="font-semibold text-zinc-800">{{ $vehicle->color ?? '-' }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Jarak Tempuh (Kilometer)</span>
                <span class="font-mono-code text-zinc-800 font-medium">{{ number_format($vehicle->mileage ?? 0, 0, ',', '.') }} KM</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Nomor Polisi (Plat)</span>
                <span class="font-mono-code font-bold text-zinc-900 uppercase">{{ $vehicle->license_plate ?? '-' }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Bahan Bakar</span>
                <span class="font-semibold text-zinc-800">{{ $vehicle->fuel_type ?? '-' }}</span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Harga Modal / Beli</span>
                <span class="font-mono-code font-bold text-zinc-600">
                    Rp {{ number_format($vehicle->purchase_price ?? 0, 0, ',', '.') }}
                </span>
            </div>

            <div class="p-4 space-y-1">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block">Harga Jual Showroom</span>
                <span class="font-mono-code font-bold text-rose-700">
                    Rp {{ number_format($vehicle->selling_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        @if($vehicle->description)
            <div class="p-4 border-t border-zinc-100 bg-zinc-50/40">
                <span class="text-[10px] font-bold uppercase tracking-wider text-zinc-400 block mb-1">Catatan / Deskripsi Kendaraan</span>
                <p class="text-xs text-zinc-600 leading-relaxed">{{ $vehicle->description }}</p>
            </div>
        @endif
    </div>

    {{-- GALERI FOTO & UPLOAD SECTION --}}
    <div class="bg-white border border-zinc-200 mb-8 shadow-xs">
        <div class="px-6 py-4 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div>
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                    <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                        Manajemen Galeri Foto Unit
                    </h2>
                </div>
                <p class="text-[11px] text-zinc-400 mt-0.5">
                    Unggah foto resolusi tinggi untuk katalog publik showroom (Maks. 5MB per foto)
                </p>
            </div>

            {{-- UPLOAD FORM IN HEADER --}}
            <form action="{{ route('admin.vehicles.images.store', $vehicle) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="flex items-center gap-2">
                @csrf
                <input type="file"
                       name="image"
                       accept=".jpg,.jpeg,.png,.webp"
                       required
                       class="text-xs text-zinc-500 file:mr-3 file:py-2 file:px-4 file:border-0 file:text-xs file:font-bold file:uppercase file:tracking-wider file:bg-zinc-100 file:text-zinc-800 hover:file:bg-zinc-200 cursor-pointer">

                <button type="submit"
                        class="px-4 py-2 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-wider transition shadow-xs shrink-0">
                    + Unggah Foto
                </button>
            </form>
        </div>

        <div class="p-6">
            @if($vehicle->images->count())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($vehicle->images as $image)
                        <div class="border border-zinc-200 bg-white group flex flex-col justify-between overflow-hidden shadow-2xs hover:border-zinc-900 transition">
                            <div class="relative aspect-[4/3] bg-zinc-100 overflow-hidden">
                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                     alt="Foto Unit"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-200">

                                @if($image->is_primary)
                                    <div class="absolute top-2 left-2 bg-[#881337] text-white text-[9px] font-mono-code font-bold uppercase tracking-wider px-2 py-0.5 shadow-sm">
                                        FOTO UTAMA
                                    </div>
                                @endif
                            </div>

                            <div class="p-3 bg-zinc-50/70 border-t border-zinc-100 flex items-center justify-between gap-2">
                                @if(!$image->is_primary)
                                    <form action="{{ route('admin.vehicles.images.primary', [$vehicle, $image]) }}"
                                          method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="text-[11px] font-bold uppercase tracking-wider text-zinc-700 hover:text-rose-700 transition cursor-pointer">
                                            ★ Jadikan Utama
                                        </button>
                                    </form>
                                @else
                                    <span class="text-[11px] font-mono-code text-zinc-400 uppercase">Tampil di Cover</span>
                                @endif

                                <form action="{{ route('admin.vehicles.images.destroy', [$vehicle, $image]) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus foto ini dari galeri?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-[11px] font-bold uppercase tracking-wider text-rose-600 hover:text-rose-800 transition cursor-pointer"
                                            title="Hapus Foto">
                                        ✕ Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="py-12 text-center text-zinc-400">
                    <svg class="w-10 h-10 mx-auto text-zinc-300 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Belum Ada Foto Kendaraan</p>
                    <p class="text-[11px] text-zinc-400 mt-1">Pilih file foto di atas lalu klik tombol "Unggah Foto" untuk menambahkan ke galeri.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
