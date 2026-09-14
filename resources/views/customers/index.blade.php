@extends('layouts.admin')

@section('title', 'Daftar Customer')
@section('page-title', 'Customer Management')

@section('content')
<div class="space-y-6">

    {{-- HEADER & TITLE --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <div>
            <div class="flex items-center gap-3">
                <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-slate-900 tracking-tight">
                        Daftar Customer
                    </h1>
                    <p class="text-xs font-medium text-slate-500 mt-0.5">
                        Kelola basis data pelanggan dealer dan riwayat kontak
                    </p>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.customers.create') }}"
           class="inline-flex items-center justify-center gap-2
                  bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm
                  px-4 py-2.5 rounded-xl shadow-sm shadow-blue-500/20
                  transition-all duration-200 active:scale-[0.98]">
            <svg class="w-4 h-4" stroke="currentColor" fill="none" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            <span>Tambah Customer</span>
        </a>
    </div>

    {{-- SUCCESS ALERT --}}
    @if (session('success'))
        <div class="flex items-center justify-between p-4 bg-emerald-50 border border-emerald-200/80 rounded-xl text-emerald-800 text-sm animate-fade-in">
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-600 hover:text-emerald-900 text-lg">&times;</button>
        </div>
    @endif

    {{-- STATS SUMMARY WIDGETS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total Customer</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ $customers->total() }}</h3>
            </div>
            <div class="w-11 h-11 bg-slate-100 text-slate-600 rounded-xl flex items-center justify-center font-semibold text-lg">
                👥
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Terdaftar Bulan Ini</p>
                <h3 class="text-2xl font-bold text-emerald-600 mt-1">+{{ $customers->count() }}</h3>
            </div>
            <div class="w-11 h-11 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-semibold text-lg">
                ✨
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Halaman Aktif</p>
                <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $customers->currentPage() }} <span class="text-xs font-normal text-slate-400">/ {{ $customers->lastPage() }}</span></h3>
            </div>
            <div class="w-11 h-11 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-semibold text-lg">
                📄
            </div>
        </div>
    </div>

    {{-- SEARCH & FILTER BAR --}}
    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm">
        <form method="GET" action="{{ route('admin.customers.index') }}" class="flex flex-col sm:flex-row items-center gap-3">
            <div class="relative w-full flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari berdasarkan Kode, Nama, NIK, atau HP..."
                    class="w-full pl-10 pr-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl
                           focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500
                           transition duration-150 outline-none text-slate-800 placeholder-slate-400"
                >
            </div>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <button
                    type="submit"
                    class="flex-1 sm:flex-none px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-medium rounded-xl transition shadow-sm">
                    Cari Data
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.customers.index') }}"
                       class="px-4 py-2.5 border border-slate-200 text-slate-600 text-sm font-medium rounded-xl hover:bg-slate-50 transition">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- DATA TABLE --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50/80 border-b border-slate-100 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">NIK</th>
                        <th class="px-6 py-4">Kontak</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150 group">

                            {{-- NAME & CODE WITH AVATAR --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white font-semibold text-xs flex items-center justify-center shadow-sm shrink-0">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.customers.show', $customer) }}" class="font-semibold text-slate-900 hover:text-blue-600 transition">
                                            {{ $customer->name }}
                                        </a>
                                        <div class="text-xs text-slate-400 font-mono mt-0.5">
                                            {{ $customer->customer_code }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            {{-- NIK --}}
                            <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-slate-600">
                                @if($customer->nik)
                                    <span class="bg-slate-100 px-2.5 py-1 rounded-md text-slate-700 font-medium">
                                        {{ $customer->nik }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic">-</span>
                                @endif
                            </td>

                            {{-- PHONE & EMAIL --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-slate-800">{{ $customer->phone }}</span>
                                    
                                    {{-- WHATSAPP DIRECT ACTION BUTTON --}}
                                    @php
                                        $cleanPhone = preg_replace('/[^0-9]/', '', $customer->phone);
                                        if (str_starts_with($cleanPhone, '0')) {
                                            $cleanPhone = '62' . substr($cleanPhone, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" title="Chat via WhatsApp"
                                       class="text-emerald-500 hover:text-emerald-700 bg-emerald-50 p-1 rounded-lg transition">
                                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="text-xs text-slate-400 mt-0.5">
                                    {{ $customer->email ?? 'Tidak ada email' }}
                                </div>
                            </td>

                            {{-- LOCATION --}}
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-600">
                                @if($customer->city || $customer->province)
                                    <div class="font-medium text-slate-700">{{ $customer->city ?? '-' }}</div>
                                    <div class="text-slate-400">{{ $customer->province }}</div>
                                @else
                                    <span class="text-slate-400 italic">-</span>
                                @endif
                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs font-medium">
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- SHOW --}}
                                    <a href="{{ route('admin.customers.show', $customer) }}"
                                       title="Lihat Detail"
                                       class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.customers.edit', $customer) }}"
                                       title="Edit Customer"
                                       class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST"
                                          onsubmit="return confirm('Hapus data customer {{ $customer->name }}?')" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Customer"
                                                class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-semibold text-slate-800 text-base">Tidak Ada Customer Ditemukan</h3>
                                <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">
                                    @if(request('search'))
                                        Pencarian dengan kata kunci "{{ request('search') }}" tidak menemukan hasil.
                                    @else
                                        Belum ada data customer yang tersimpan di sistem. Tambahkan customer pertama Anda.
                                    @endif
                                </p>
                                @if(!request('search'))
                                    <a href="{{ route('admin.customers.create') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-medium hover:bg-blue-700 transition">
                                        ＋ Tambah Customer Baru
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if ($customers->hasPages())
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm px-6 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-xs text-slate-500 font-medium">
                    Menampilkan <span class="font-semibold text-slate-800">{{ $customers->firstItem() }}</span> - <span class="font-semibold text-slate-800">{{ $customers->lastItem() }}</span> dari <span class="font-semibold text-slate-800">{{ $customers->total() }}</span> customer
                </div>
                <div>
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
