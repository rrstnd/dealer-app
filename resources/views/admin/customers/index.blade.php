@extends('layouts.admin')

@section('title', 'Data Pelanggan')
@section('page-title', 'Data Pelanggan')

@section('content')
<div class="space-y-6">

    {{-- HEADER SECTION --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 border border-zinc-200 shadow-xs">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="text-xs font-mono-code text-rose-600 font-bold uppercase tracking-widest">CUSTOMER DATABASE</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-light tracking-[0.15em] text-zinc-900 uppercase">
                BASIS DATA PELANGGAN DEALER
            </h1>
            <p class="text-xs text-zinc-500 mt-1">
                Kelola basis data calon pembeli, pelanggan tetap, riwayat nomor kontak, dan domisili.
            </p>
        </div>

        <a href="{{ route('admin.customers.create') }}"
           class="inline-flex items-center justify-center gap-2 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest px-5 py-2.5 transition shadow-xs">
            <svg class="w-4 h-4" stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <span>Tambah Customer Baru</span>
        </a>
    </div>

    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-semibold">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 text-base cursor-pointer">&times;</button>
        </div>
    @endif

    {{-- STATS SUMMARY (CARITA MINIMALIST) --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 border border-zinc-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em]">Total Customer</p>
                <h3 class="text-2xl font-light text-zinc-900 mt-1 tracking-tight">{{ $customers->total() }}</h3>
            </div>
            <div class="w-10 h-10 bg-zinc-100 text-zinc-800 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 border border-zinc-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em]">Customer Halaman Ini</p>
                <h3 class="text-2xl font-light text-emerald-700 mt-1 tracking-tight">{{ $customers->count() }} Data</h3>
            </div>
            <div class="w-10 h-10 bg-emerald-50 text-emerald-700 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white p-5 border border-zinc-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-[10px] font-bold text-zinc-400 uppercase tracking-[0.2em]">Halaman Aktif</p>
                <h3 class="text-2xl font-light text-zinc-900 mt-1 tracking-tight font-mono-code">{{ $customers->currentPage() }} <span class="text-xs text-zinc-400">/ {{ $customers->lastPage() }}</span></h3>
            </div>
            <div class="w-10 h-10 bg-zinc-100 text-zinc-800 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- SEARCH & FILTER BAR --}}
    <div class="bg-white p-4 border border-zinc-200 shadow-xs">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative w-full flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-zinc-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari berdasarkan Kode Pelanggan, Nama, NIK, atau No HP..."
                    class="w-full pl-10 pr-4 py-2.5 text-xs bg-zinc-50 border border-zinc-300 focus:bg-white focus:border-zinc-950 transition outline-none text-zinc-800 placeholder-zinc-400">
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-zinc-950 hover:bg-black text-white text-xs font-bold uppercase tracking-widest transition shadow-xs">
                    Cari Data
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.customers.index') }}"
                       class="px-4 py-2.5 border border-zinc-300 bg-zinc-100 hover:bg-rose-50 text-zinc-700 hover:text-rose-700 text-xs font-bold uppercase tracking-wider transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- DATA TABLE --}}
    <div class="bg-white border border-zinc-200 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-zinc-600">
                <thead class="bg-zinc-100/90 border-b border-zinc-200 text-[10px] font-bold text-zinc-600 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">Customer</th>
                        <th class="px-5 py-3.5">NIK</th>
                        <th class="px-5 py-3.5">Kontak</th>
                        <th class="px-5 py-3.5">Domisili</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-zinc-50/80 transition-colors duration-150">

                            {{-- NAME & CODE WITH AVATAR --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 bg-zinc-950 text-white font-black text-xs flex items-center justify-center shrink-0 tracking-wider">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.customers.show', $customer) }}" class="font-bold text-zinc-900 uppercase hover:text-[#881337] transition">
                                            {{ $customer->name }}
                                        </a>
                                        <div class="text-[11px] text-zinc-400 font-mono-code">
                                            {{ $customer->customer_code }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- NIK --}}
                            <td class="px-5 py-4 whitespace-nowrap font-mono-code text-xs text-zinc-700">
                                @if($customer->nik)
                                    <span class="bg-zinc-100 px-2 py-0.5 border border-zinc-200 text-zinc-800 font-medium">
                                        {{ $customer->nik }}
                                    </span>
                                @else
                                    <span class="text-zinc-400 italic">-</span>
                                @endif
                            </td>

                            {{-- PHONE & EMAIL --}}
                            <td class="px-5 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="font-mono-code font-bold text-zinc-900">{{ $customer->phone }}</span>
                                    
                                    {{-- WHATSAPP DIRECT ACTION BUTTON --}}
                                    @php
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $customer->phone);
                                        if (str_starts_with($cleanPhone, '0')) {
                                            $cleanPhone = '62' . substr($cleanPhone, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" title="Chat via WhatsApp"
                                       class="text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200 p-1 transition">
                                        <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="text-[11px] text-zinc-400 mt-0.5">
                                    {{ $customer->email ?? 'Tidak ada email' }}
                                </div>
                            </td>

                            {{-- LOCATION --}}
                            <td class="px-5 py-4 whitespace-nowrap text-xs text-zinc-600">
                                @if($customer->city || $customer->province)
                                    <div class="font-medium text-zinc-900">{{ $customer->city ?? '-' }}</div>
                                    <div class="text-[11px] text-zinc-400">{{ $customer->province }}</div>
                                @else
                                    <span class="text-zinc-400 italic">-</span>
                                @endif
                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-5 py-4 whitespace-nowrap text-right">
                                <div class="inline-flex items-center gap-1.5 justify-end">
                                    <a href="{{ route('admin.customers.show', $customer) }}"
                                       class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-zinc-200 bg-white hover:bg-zinc-100 text-zinc-700 transition"
                                       title="Lihat Detail Customer">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.customers.edit', $customer) }}"
                                       class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-zinc-300 bg-zinc-100 hover:bg-zinc-200 text-zinc-800 transition"
                                       title="Edit Data Customer">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.customers.destroy', $customer) }}"
                                          method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data customer ini?')"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="px-2.5 py-1.5 text-[11px] font-bold uppercase tracking-wider border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 transition cursor-pointer"
                                                title="Hapus Customer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-16 text-center text-zinc-400">
                                <svg class="w-10 h-10 mx-auto text-zinc-300 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                <p class="text-xs font-bold uppercase tracking-wider text-zinc-700">Belum Ada Data Customer</p>
                                <p class="text-[11px] text-zinc-400 mt-1">Tambahkan data customer baru dengan mengklik tombol di atas.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($customers->hasPages())
        <div class="bg-white border border-zinc-200 px-5 py-4 shadow-xs flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="text-xs text-zinc-500 font-mono-code uppercase">
                Menampilkan <span class="font-bold text-zinc-900">{{ $customers->firstItem() }}</span> - <span class="font-bold text-zinc-900">{{ $customers->lastItem() }}</span> dari <span class="font-bold text-zinc-900">{{ $customers->total() }}</span> customer
            </div>
            <div>
                {{ $customers->links() }}
            </div>
        </div>
    @endif

</div>
@endsection
