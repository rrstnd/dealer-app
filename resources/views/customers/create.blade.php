@extends('layouts.admin')

@section('title', 'Tambah Customer Baru')
@section('page-title', 'Customer Management')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- HEADER & BREADCRUMB --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <a href="{{ route('admin.customers.index') }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-blue-600 transition mb-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar Customer
            </a>
            <h1 class="text-xl font-bold text-slate-900 tracking-tight">
                Tambah Customer Baru
            </h1>
            <p class="text-xs font-medium text-slate-500 mt-0.5">
                Isi form di bawah ini untuk menginputkan data calon pembeli atau pelanggan baru
            </p>
        </div>
    </div>

    {{-- FORM CARD --}}
    <form action="{{ route('admin.customers.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- SECTION 1: IDENTITAS & KONTAK --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-slate-900 text-base">Identitas & Informasi Utama</h2>
                    <p class="text-xs text-slate-400">Data identitas resmi dan saluran komunikasi pelanggan</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- KODE CUSTOMER --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Kode Customer <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="customer_code"
                        value="{{ old('customer_code', 'CUST-' . strtoupper(Str::random(5))) }}"
                        placeholder="Contoh: CUST-0001"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl font-mono
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                        required
                    >
                    @error('customer_code')
                        <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NAMA LENGKAP --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Nama Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama lengkap sesuai KTP"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                        required
                    >
                    @error('name')
                        <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NIK --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        NIK (KTP)
                    </label>
                    <input
                        type="text"
                        name="nik"
                        value="{{ old('nik') }}"
                        placeholder="16 digit Nomor Induk Kependudukan"
                        maxlength="16"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl font-mono
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                    >
                    @error('nik')
                        <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- NO HP --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        No. HP / WhatsApp <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                        required
                    >
                    @error('phone')
                        <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                {{-- EMAIL --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Email
                    </label>
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh: customer@email.com"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                    >
                    @error('email')
                        <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- SECTION 2: ALAMAT DOMISILI --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="p-2 bg-emerald-50 text-emerald-600 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-slate-900 text-base">Alamat Domisili</h2>
                    <p class="text-xs text-slate-400">Lokasi tempat tinggal untuk pengiriman unit / STNK</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                {{-- ALAMAT LENGKAP --}}
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Alamat Lengkap (Jalan, RT/RW, Kecamatan)
                    </label>
                    <textarea
                        name="address"
                        rows="3"
                        placeholder="Masukkan nama jalan, nomor rumah, RT/RW, Kelurahan, Kecamatan..."
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                    >{{ old('address') }}</textarea>
                </div>

                {{-- KOTA --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Kota / Kabupaten
                    </label>
                    <input
                        type="text"
                        name="city"
                        value="{{ old('city') }}"
                        placeholder="Contoh: Karawang"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                    >
                </div>

                {{-- PROVINSI --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Provinsi
                    </label>
                    <input
                        type="text"
                        name="province"
                        value="{{ old('province') }}"
                        placeholder="Contoh: Jawa Barat"
                        class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                               focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                               transition outline-none text-slate-800"
                    >
                </div>
            </div>
        </div>

        {{-- SECTION 3: CATATAN --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 space-y-4">
            <div class="flex items-center gap-3 border-b border-slate-100 pb-4">
                <div class="p-2 bg-amber-50 text-amber-600 rounded-xl">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-slate-900 text-base">Catatan Tambahan</h2>
                    <p class="text-xs text-slate-400">Preferensi khusus, catatan leasing, atau preferensi unit</p>
                </div>
            </div>

            <textarea
                name="notes"
                rows="3"
                placeholder="Tuliskan catatan tambahan mengenai customer ini jika ada..."
                class="w-full px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                       focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                       transition outline-none text-slate-800"
            >{{ old('notes') }}</textarea>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex items-center justify-end gap-3 bg-white p-5 rounded-2xl border border-slate-100 shadow-sm">
            <a href="{{ route('admin.customers.index') }}"
               class="px-5 py-2.5 border border-slate-200 hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-xl transition">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl shadow-sm shadow-blue-500/20 transition active:scale-[0.98]">
                Simpan Customer
            </button>
        </div>
    </form>
</div>
@endsection
