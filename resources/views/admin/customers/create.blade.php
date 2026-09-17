@extends('layouts.admin')

@section('title', 'Tambah Customer Baru')
@section('page-title', 'Data Pelanggan')

@section('content')
<div class="max-w-4xl space-y-6">

    {{-- HEADER SECTION --}}
    <div class="mb-6">
        <a href="{{ route('admin.customers.index') }}"
           class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 transition mb-2">
            <span>←</span>
            <span>Kembali ke Data Pelanggan</span>
        </a>
        <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
            TAMBAH DATA CUSTOMER BARU
        </h1>
        <p class="text-xs text-zinc-500 mt-1">
            Lengkapi formulir identitas calon pembeli atau pelanggan baru showroom.
        </p>
    </div>

    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 text-rose-800 text-xs font-semibold">
            <div class="font-bold uppercase tracking-wider mb-1">Terdapat kesalahan pengisian:</div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM CONTAINER (CARITA LUXURY DESIGN) --}}
    <form action="{{ route('admin.customers.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- SECTION 1: IDENTITAS & KONTAK --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    1. Identitas & Saluran Kontak
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- KODE CUSTOMER --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Kode Customer <span class="text-rose-600">*</span>
                    </label>
                    <input type="text"
                           name="customer_code"
                           value="{{ old('customer_code', 'CUST-' . strtoupper(Str::random(5))) }}"
                           placeholder="Contoh: CUST-0001"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code font-bold focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- NAMA LENGKAP --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Nama Lengkap (Sesuai KTP) <span class="text-rose-600">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Nama lengkap customer"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Nomor Induk Kependudukan (NIK)
                    </label>
                    <input type="text"
                           name="nik"
                           value="{{ old('nik') }}"
                           placeholder="16 Digit NIK KTP"
                           maxlength="16"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        No. HP / WhatsApp <span class="text-rose-600">*</span>
                    </label>
                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="Contoh: 08123456789"
                           required
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs font-mono-code focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                {{-- EMAIL --}}
                <div class="sm:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Alamat Email
                    </label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="customer@email.com"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>
            </div>
        </div>

        {{-- SECTION 2: ALAMAT DOMISILI --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    2. Alamat Domisili & Pengiriman
                </h2>
            </div>

            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Alamat Lengkap (Jalan, RT/RW, Kelurahan, Kecamatan)
                    </label>
                    <textarea name="address"
                              rows="3"
                              placeholder="Masukkan detail alamat lengkap domisili pelanggan..."
                              class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">{{ old('address') }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Kota / Kabupaten
                    </label>
                    <input type="text"
                           name="city"
                           value="{{ old('city') }}"
                           placeholder="Contoh: Karawang / Bekasi"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>

                <div>
                    <label class="block text-[11px] font-bold uppercase tracking-wider text-zinc-700 mb-1.5">
                        Provinsi
                    </label>
                    <input type="text"
                           name="province"
                           value="{{ old('province') }}"
                           placeholder="Contoh: Jawa Barat"
                           class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">
                </div>
            </div>
        </div>

        {{-- SECTION 3: CATATAN --}}
        <div class="bg-white border border-zinc-200 shadow-xs">
            <div class="px-6 py-4 border-b border-zinc-100 flex items-center gap-2">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h2 class="text-xs font-bold uppercase tracking-[0.15em] text-zinc-900">
                    3. Catatan Khusus Pelanggan
                </h2>
            </div>

            <div class="p-6">
                <textarea name="notes"
                          rows="3"
                          placeholder="Tuliskan catatan tambahan mengenai preferensi unit, leasing, atau riwayat kontak..."
                          class="w-full px-3 py-2.5 bg-zinc-50 border border-zinc-300 text-zinc-900 text-xs focus:bg-white focus:border-zinc-900 focus:outline-none transition">{{ old('notes') }}</textarea>
            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center justify-end gap-3 pt-2">
            <a href="{{ route('admin.customers.index') }}"
               class="px-5 py-2.5 border border-zinc-300 bg-white hover:bg-zinc-50 text-zinc-700 text-xs font-bold uppercase tracking-wider transition">
                Batal
            </a>

            <button type="submit"
                    class="px-6 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs flex items-center gap-2">
                <span>Simpan Data Customer</span>
                <span>→</span>
            </button>
        </div>

    </form>
</div>
@endsection
