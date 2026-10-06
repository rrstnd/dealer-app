@extends('layouts.admin')

@section('title', 'Tambah Kendaraan Baru')
@section('page-title', '')

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
    <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                <div class="grid grid-cols-1 gap-5">
                    {{-- Hidden Purchase Price --}}
                    <input type="hidden" name="purchase_price" value="0">

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

                    {{-- Default Status --}}
                    <input type="hidden" name="status" value="AVAILABLE">
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

        {{-- SECTION 4: DOKUMENTASI & FOTO KENDARAAN --}}
        <div class="bg-white border border-zinc-200 shadow-xs" x-data="photoUploader()">
            <div class="px-6 py-4 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                    <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                        4. Dokumentasi & Foto Kendaraan
                    </h2>
                </div>
                <span class="text-[10px] font-mono-code uppercase tracking-wider text-zinc-400">
                    Opsional (Maks. 10MB per foto)
                </span>
            </div>

            <div class="p-6 space-y-4">
                {{-- DROPZONE UPLOAD AREA --}}
                <div class="border-2 border-dashed border-zinc-300 hover:border-zinc-900 bg-zinc-50/70 hover:bg-white p-6 sm:p-8 text-center transition cursor-pointer relative group rounded-none"
                     @dragover.prevent
                     @drop.prevent="handleDrop($event)">

                    <input type="file"
                           id="vehicle-images-input"
                           name="images[]"
                           accept=".jpg,.jpeg,.png,.webp"
                           multiple
                           @change="handleFiles($event)"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                    <div class="space-y-2">
                        <div class="w-12 h-12 mx-auto bg-zinc-100 border border-zinc-200 text-zinc-700 flex items-center justify-center rounded-sm group-hover:scale-105 group-hover:bg-[#881337] group-hover:text-white transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-zinc-900">
                                Klik atau seret foto ke area ini
                            </p>
                            <p class="text-[11px] text-zinc-500 mt-1">
                                Format didukung: <span class="font-mono-code text-zinc-700">JPG, JPEG, PNG, WEBP</span>. Bisa pilih beberapa foto sekaligus.
                            </p>
                            <p class="text-[10px] text-rose-600 font-semibold mt-1">
                                ★ Foto pertama yang dipilih otomatis menjadi Foto Utama (Cover Depan) di katalog.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- PREVIEW GRID CONTAINER --}}
                <div x-show="previews.length > 0" x-cloak class="space-y-3 pt-2">
                    <div class="flex items-center justify-between border-b border-zinc-100 pb-2">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-zinc-900">
                                Pratinjau Foto Siap Diunggah
                            </span>
                            <span class="text-[11px] font-mono-code font-bold bg-[#881337] text-white px-2 py-0.5 rounded-none"
                                  x-text="previews.length + ' Foto Dipilih'">
                            </span>
                        </div>
                        <button type="button"
                                @click="clearFiles()"
                                class="text-[11px] font-bold uppercase tracking-wider text-rose-600 hover:text-rose-800 transition cursor-pointer">
                            ✕ Hapus Semua Foto
                        </button>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        <template x-for="(preview, index) in previews" :key="index">
                            <div class="border border-zinc-200 bg-zinc-50 overflow-hidden relative shadow-2xs group">
                                <div class="aspect-[4/3] bg-zinc-100 relative overflow-hidden">
                                    <img :src="preview.url" :alt="preview.name" class="w-full h-full object-cover">
                                    <template x-if="index === 0">
                                        <div class="absolute top-2 left-2 bg-[#881337] text-white text-[9px] font-mono-code font-bold uppercase tracking-wider px-2 py-0.5 shadow-sm">
                                            ★ FOTO UTAMA
                                        </div>
                                    </template>
                                    <template x-if="index > 0">
                                        <div class="absolute top-2 left-2 bg-zinc-900/80 text-white text-[9px] font-mono-code font-bold uppercase tracking-wider px-2 py-0.5"
                                             x-text="'Foto #' + (index + 1)">
                                        </div>
                                    </template>
                                </div>
                                <div class="p-2.5 bg-white border-t border-zinc-100">
                                    <p class="text-[11px] font-medium text-zinc-800 truncate" x-text="preview.name"></p>
                                    <p class="text-[10px] font-mono-code text-zinc-400" x-text="preview.size"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.vehicles.index') }}"
               class="px-5 py-2.5 border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-700 text-xs font-bold uppercase tracking-wider transition text-center w-full sm:w-auto">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs flex items-center justify-center gap-2 w-full sm:w-auto">
                <span>Simpan Kendaraan</span>
                <span>→</span>
            </button>
        </div>

    </form>

@endsection

@push('scripts')
<script>
    function photoUploader() {
        return {
            previews: [],
            handleFiles(event) {
                const files = event.target.files;
                this.loadFiles(files);
            },
            handleDrop(event) {
                const dt = event.dataTransfer;
                if (!dt || !dt.files) return;
                const input = document.getElementById('vehicle-images-input');
                if (input) {
                    input.files = dt.files;
                }
                this.loadFiles(dt.files);
            },
            loadFiles(files) {
                this.previews = [];
                if (!files || files.length === 0) return;

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (file.type && file.type.startsWith('image/')) {
                        this.previews.push({
                            url: URL.createObjectURL(file),
                            name: file.name,
                            size: (file.size / (1024 * 1024)).toFixed(2) + ' MB'
                        });
                    }
                }
            },
            clearFiles() {
                this.previews = [];
                const input = document.getElementById('vehicle-images-input');
                if (input) input.value = '';
            }
        }
    }
</script>
@endpush
