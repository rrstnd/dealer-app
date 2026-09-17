@extends('layouts.admin')

@section('title', 'Detail Customer: ' . $customer->name)
@section('page-title', 'Data Pelanggan')

@section('content')
<div class="max-w-5xl space-y-6">

    {{-- HEADER & ACTIONS --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 border border-zinc-200 shadow-xs">
        <div>
            <a href="{{ route('admin.customers.index') }}"
               class="inline-flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-zinc-500 hover:text-zinc-900 transition mb-2">
                <span>←</span>
                <span>Kembali ke Data Pelanggan</span>
            </a>
            <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                DETAIL PROFIL PELANGGAN
            </h1>
            <p class="text-xs text-zinc-500 mt-0.5">
                Informasi profil lengkap, identitas resmi, dan riwayat kontak calon pembeli showroom.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.customers.edit', $customer) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                </svg>
                <span>Edit Profil</span>
            </a>
        </div>
    </div>

    {{-- HERO PROFILE CARD (CARITA LUXURY STYLE) --}}
    <div class="bg-white border border-zinc-200 shadow-xs p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="w-16 h-16 bg-zinc-950 text-white text-xl font-bold flex items-center justify-center shrink-0 tracking-widest border border-zinc-800">
                    {{ strtoupper(substr($customer->name, 0, 2)) }}
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <h2 class="text-xl font-bold text-zinc-900 uppercase tracking-wider">{{ $customer->name }}</h2>
                        <span class="px-2 py-0.5 border border-emerald-200 bg-emerald-50 text-emerald-800 text-[10px] font-bold uppercase tracking-wider">
                            Aktif
                        </span>
                    </div>
                    <p class="text-xs font-mono-code text-zinc-400 mt-1">ID PELANGGAN: {{ $customer->customer_code }}</p>
                    <p class="text-xs text-zinc-500 mt-1.5 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        {{ $customer->city ? $customer->city . ', ' . $customer->province : 'Domisili belum ditentukan' }}
                    </p>
                </div>
            </div>

            {{-- QUICK CONTACT BUTTONS --}}
            @php
                $cleanPhone = preg_replace('/[^0-9]/', '', $customer->phone);
                if (str_starts_with($cleanPhone, '0')) {
                    $cleanPhone = '62' . substr($cleanPhone, 1);
                }
            @endphp
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <a href="https://wa.me/{{ $cleanPhone }}" target="_blank"
                   class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider transition border border-emerald-200">
                    <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    <span>Hubungi WhatsApp</span>
                </a>
                <a href="tel:{{ $customer->phone }}"
                   class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-zinc-100 hover:bg-zinc-200 text-zinc-800 text-xs font-bold uppercase tracking-wider transition border border-zinc-300">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1.01 1.01 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>Panggilan Telepon</span>
                </a>
            </div>
        </div>
    </div>

    {{-- DETAILED SPECIFICATION GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- IDENTITAS PRIBADI --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Informasi Identitas Resmi</h3>
            </div>

            <div class="space-y-3">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">ID Customer</span>
                    <span class="text-xs font-mono-code font-bold text-zinc-900 mt-0.5 block">{{ $customer->customer_code }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Nama Lengkap</span>
                    <span class="text-xs font-semibold text-zinc-800 mt-0.5 block">{{ $customer->name }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">NIK (KTP)</span>
                    <span class="text-xs font-mono-code text-zinc-800 mt-0.5 block">{{ $customer->nik ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- KONTAK & EMAIL --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Saluran Komunikasi</h3>
            </div>

            <div class="space-y-3">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Nomor Telepon / HP</span>
                    <span class="text-xs font-mono-code font-bold text-zinc-900 mt-0.5 block">{{ $customer->phone }}</span>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Alamat Email</span>
                    <span class="text-xs font-medium text-zinc-800 mt-0.5 block">{{ $customer->email ?? 'Tidak ada email terdaftar' }}</span>
                </div>
            </div>
        </div>

        {{-- ALAMAT DOMISILI --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Alamat Domisili</h3>
            </div>

            <div class="space-y-3">
                <div>
                    <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Alamat Jalan / RT / RW</span>
                    <p class="text-xs text-zinc-700 mt-0.5 leading-relaxed">{{ $customer->address ?? '-' }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-1">
                    <div>
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Kota / Kabupaten</span>
                        <span class="text-xs font-semibold text-zinc-800 mt-0.5 block">{{ $customer->city ?? '-' }}</span>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-zinc-400 uppercase tracking-wider block">Provinsi</span>
                        <span class="text-xs font-semibold text-zinc-800 mt-0.5 block">{{ $customer->province ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- CATATAN KHUSUS --}}
        <div class="bg-white border border-zinc-200 shadow-xs p-6 space-y-4">
            <div class="flex items-center gap-2 border-b border-zinc-100 pb-3">
                <span class="w-1.5 h-1.5 bg-[#881337]"></span>
                <h3 class="font-bold text-zinc-900 text-xs uppercase tracking-[0.15em]">Catatan Tambahan Dealer</h3>
            </div>

            <div>
                <p class="text-xs text-zinc-600 leading-relaxed italic bg-zinc-50 p-4 border border-zinc-200">
                    {{ $customer->notes ? '"' . $customer->notes . '"' : 'Tidak ada catatan tambahan untuk customer ini.' }}
                </p>
            </div>
        </div>

    </div>

    {{-- DANGER ZONE --}}
    <div class="bg-rose-50/70 border border-rose-200 p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h4 class="font-bold text-rose-900 text-xs uppercase tracking-wider">Hapus Data Customer</h4>
            <p class="text-xs text-rose-600 mt-0.5">Tindakan ini akan menghapus permanen catatan customer ini dari sistem showroom.</p>
        </div>
        <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST"
              onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen data customer {{ $customer->name }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white font-bold text-xs uppercase tracking-wider transition cursor-pointer">
                Hapus Customer
            </button>
        </form>
    </div>

</div>
@endsection
