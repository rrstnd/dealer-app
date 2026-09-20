@extends('layouts.admin')

@section('title', 'Tambah Kendaraan Baru')
@section('page-title', 'Tambah Kendaraan')

@section('content')

    {{-- TOP NAVIGATION --}}
    <div class="mb-6">
        <a href="{{ route('admin.vehicles.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 transition mb-2">
            <span>←</span>
            <span>Kembali ke Upload Kendaraan</span>
        </a>
        <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
            TAMBAH UNIT KENDARAAN BARU
        </h1>
        <p class="text-xs text-zinc-500 mt-1">
            Lengkapi formulir di bawah ini untuk mendaftarkan unit kendaraan baru ke dalam sistem inventaris showroom.
        </p>
    </div>

    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="mb-6 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold">
            <div class="font-bold uppercase tracking-wider mb-1">Terdapat kesalahan pengisian data:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CONTAINER (CARITA LUXURY DESIGN) --}}
    <form action="{{ route('admin.vehicles.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- SECTION 1: INFORMASI UTAMA & MODEL --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    1. Informasi Utama & Model Kendaraan
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                {{-- Stock Code --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-600 mb-1.5">
                        Kode Stok (Auto)
                    </label>
                    <input type="text"
                           name="stock_code"
                           value="{{ old('stock_code', $nextStockCode) }}"
                           readonly
                           class="w-full px-3 py-2.5 bg-zinc-100 border border-zinc-300 text-zinc-600 text-xs font-mono-code font-bold cursor-not-allowed">
                    <p class="text-[10px] text-zinc-400 mt-1">Dibuat otomatis oleh penomoran sistem.</p>
                </div>

                {{-- Type --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Jenis Kendaraan <span class="text-rose-600">*</span>
                    </label>
                    <input type="text"
                           name="type"
                           value="{{ old('type') }}"
                           placeholder="Contoh: Mobil / Motor"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Brand --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Merek Kendaraan <span class="text-rose-600">*</span>
                    </label>
                    <input type="text"
                           name="brand"
                           value="{{ old('brand') }}"
                           placeholder="Contoh: Toyota / Honda / BMW"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Model --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Nama Model <span class="text-rose-600">*</span>
                    </label>
                    <input type="text"
                           name="model"
                           value="{{ old('model') }}"
                           placeholder="Contoh: Fortuner / Civic / NMAX"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Variant --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Varian / Tipe Spesifik
                    </label>
                    <input type="text"
                           name="variant"
                           value="{{ old('variant') }}"
                           placeholder="Contoh: 2.8 VRZ GR-Sport"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Year --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Tahun Perakitan <span class="text-rose-600">*</span>
                    </label>
                    <input type="number"
                           name="year"
                           value="{{ old('year', date('Y')) }}"
                           placeholder="2022"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>
            </div>
        </div>

        {{-- SECTION 2: SPESIFIKASI TEKNIS & DOKUMEN --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    2. Spesifikasi Teknis & Kelengkapan Dokumen
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                {{-- Color --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Warna Kendaraan
                    </label>
                    <input type="text"
                           name="color"
                           value="{{ old('color') }}"
                           placeholder="Contoh: Hitam Metalik"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Transmisi --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Transmisi
                    </label>
                    <select name="transmission"
                            class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition">
                        <option value="">-- Pilih Transmisi --</option>
                        <option value="Automatic" {{ old('transmission') === 'Automatic' ? 'selected' : '' }}>Otomatis (A/T)</option>
                        <option value="Manual" {{ old('transmission') === 'Manual' ? 'selected' : '' }}>Manual (M/T)</option>
                        <option value="CVT" {{ old('transmission') === 'CVT' ? 'selected' : '' }}>CVT</option>
                    </select>
                </div>

                {{-- Bahan Bakar --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Bahan Bakar
                    </label>
                    <select name="fuel_type"
                            class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition">
                        <option value="">-- Pilih Bahan Bakar --</option>
                        <option value="Bensin" {{ old('fuel_type') === 'Bensin' ? 'selected' : '' }}>Bensin</option>
                        <option value="Diesel" {{ old('fuel_type') === 'Diesel' ? 'selected' : '' }}>Diesel</option>
                        <option value="Hybrid" {{ old('fuel_type') === 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                        <option value="Listrik" {{ old('fuel_type') === 'Listrik' ? 'selected' : '' }}>Listrik (EV)</option>
                    </select>
                </div>

                {{-- Kapasitas Mesin --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Kapasitas Mesin (CC)
                    </label>
                    <input type="number"
                           name="engine_capacity"
                           value="{{ old('engine_capacity') }}"
                           placeholder="Contoh: 2400"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Kilometer --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Jarak Tempuh (KM)
                    </label>
                    <input type="number"
                           name="mileage"
                           value="{{ old('mileage') }}"
                           placeholder="Contoh: 35000"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Plat Nomor --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Nomor Polisi (Plat)
                    </label>
                    <input type="text"
                           name="license_plate"
                           value="{{ old('license_plate') }}"
                           placeholder="Contoh: B 1234 XYZ"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs uppercase font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Nomor Rangka --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Nomor Rangka (VIN)
                    </label>
                    <input type="text"
                           name="chassis_number"
                           value="{{ old('chassis_number') }}"
                           placeholder="Nomor Rangka Kendaraan"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs uppercase font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- Nomor Mesin --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Nomor Mesin
                    </label>
                    <input type="text"
                           name="engine_number"
                           value="{{ old('engine_number') }}"
                           placeholder="Nomor Mesin Kendaraan"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs uppercase font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>
            </div>
        </div>

        {{-- SECTION 3: HARGA, STATUS, & CATATAN --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    3. Penetapan Harga & Status Showroom
                </h2>
            </div>

            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    {{-- Purchase Price --}}
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                            Harga Beli / Modal (Rp) <span class="text-rose-600">*</span>
                        </label>
                        <input type="number"
                               name="purchase_price"
                               value="{{ old('purchase_price') }}"
                               placeholder="Contoh: 180000000"
                               required
                               class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                    </div>

                    {{-- Selling Price --}}
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                            Harga Jual Showroom (Rp) <span class="text-rose-600">*</span>
                        </label>
                        <input type="number"
                               name="selling_price"
                               value="{{ old('selling_price') }}"
                               placeholder="Contoh: 210000000"
                               required
                               class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code font-bold focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                            Status Inventaris <span class="text-rose-600">*</span>
                        </label>
                        <select name="status"
                                required
                                class="w-full px-3 py-2.5 bg-white border border-zinc-300 text-zinc-800 text-xs focus:outline-none focus:border-zinc-900 transition">
                            <option value="AVAILABLE" {{ old('status', 'AVAILABLE') === 'AVAILABLE' ? 'selected' : '' }}>Tersedia (Ready Stock)</option>
                            <option value="RESERVED" {{ old('status') === 'RESERVED' ? 'selected' : '' }}>Tanda Jadi (Booked)</option>
                            <option value="SOLD" {{ old('status') === 'SOLD' ? 'selected' : '' }}>Terjual (Sold)</option>
                            <option value="SERVICE" {{ old('status') === 'SERVICE' ? 'selected' : '' }}>Servis (Maintenance)</option>
                            <option value="INACTIVE" {{ old('status') === 'INACTIVE' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Deskripsi / Catatan Tambahan Unit
                    </label>
                    <textarea name="description"
                              rows="4"
                              placeholder="Kondisi mesin, riwayat servis, kelengkapan surat-surat, atau fitur istimewa kendaraan..."
                              class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.vehicles.index') }}"
               class="px-5 py-2.5 border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-700 text-xs font-bold uppercase tracking-wider transition">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs flex items-center gap-2">
                <span>Simpan Kendaraan</span>
                <span>→</span>
            </button>
        </div>

    </form>

@endsection
