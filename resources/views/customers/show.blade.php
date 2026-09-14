@extends('layouts.admin')

@section('title', 'Detail Customer')
@section('page-title', 'Detail Customer')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Detail Customer
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Informasi lengkap customer
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('customers.index') }}"
               class="px-4 py-2.5 border border-slate-300 rounded-lg
                      text-slate-600 hover:bg-slate-100 transition">
                ← Kembali
            </a>

            <a href="{{ route('customers.edit', $customer) }}"
               class="px-4 py-2.5 bg-slate-900 text-white rounded-lg
                      hover:bg-slate-700 transition">
                ✏️ Edit Customer
            </a>

        </div>

    </div>


    {{-- CUSTOMER HEADER --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

        <div class="flex items-center gap-5">

            <div class="w-16 h-16 rounded-full bg-slate-900 text-white
                        flex items-center justify-center
                        text-2xl font-bold">

                {{ strtoupper(substr($customer->name, 0, 1)) }}

            </div>

            <div>

                <h2 class="text-xl font-bold text-slate-800">
                    {{ $customer->name }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $customer->customer_code }}
                </p>

            </div>

        </div>

    </div>


    {{-- DATA CUSTOMER --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


        {{-- DATA PRIBADI --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <h3 class="text-lg font-semibold text-slate-800 mb-5">
                Data Pribadi
            </h3>

            <div class="space-y-4">

                <div>
                    <p class="text-xs text-slate-500 uppercase">
                        ID Customer
                    </p>

                    <p class="font-medium text-slate-800 mt-1">
                        {{ $customer->customer_code }}
                    </p>
                </div>


                <div>
                    <p class="text-xs text-slate-500 uppercase">
                        Nama Lengkap
                    </p>

                    <p class="font-medium text-slate-800 mt-1">
                        {{ $customer->name }}
                    </p>
                </div>


                <div>
                    <p class="text-xs text-slate-500 uppercase">
                        NIK
                    </p>

                    <p class="font-medium text-slate-800 mt-1">
                        {{ $customer->nik ?? '-' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- KONTAK --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <h3 class="text-lg font-semibold text-slate-800 mb-5">
                Kontak
            </h3>

            <div class="space-y-4">

                <div>
                    <p class="text-xs text-slate-500 uppercase">
                        No. HP
                    </p>

                    <p class="font-medium text-slate-800 mt-1">
                        {{ $customer->phone }}
                    </p>
                </div>


                <div>
                    <p class="text-xs text-slate-500 uppercase">
                        Email
                    </p>

                    <p class="font-medium text-slate-800 mt-1">
                        {{ $customer->email ?? '-' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- ALAMAT --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <h3 class="text-lg font-semibold text-slate-800 mb-5">
                Alamat
            </h3>

            <div class="space-y-4">

                <div>
                    <p class="text-xs text-slate-500 uppercase">
                        Alamat Lengkap
                    </p>

                    <p class="font-medium text-slate-800 mt-1 whitespace-pre-line">
                        {{ $customer->address ?? '-' }}
                    </p>
                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <p class="text-xs text-slate-500 uppercase">
                            Kota
                        </p>

                        <p class="font-medium text-slate-800 mt-1">
                            {{ $customer->city ?? '-' }}
                        </p>
                    </div>


                    <div>
                        <p class="text-xs text-slate-500 uppercase">
                            Provinsi
                        </p>

                        <p class="font-medium text-slate-800 mt-1">
                            {{ $customer->province ?? '-' }}
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- CATATAN --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <h3 class="text-lg font-semibold text-slate-800 mb-5">
                Catatan
            </h3>

            <p class="text-slate-600 whitespace-pre-line">
                {{ $customer->notes ?? 'Tidak ada catatan.' }}
            </p>

        </div>

    </div>


    {{-- DELETE --}}
    <div class="bg-red-50 border border-red-200 rounded-xl p-5
                flex flex-col md:flex-row
                md:items-center md:justify-between gap-4">

        <div>

            <h3 class="font-semibold text-red-700">
                Hapus Customer
            </h3>

            <p class="text-sm text-red-600 mt-1">
                Data customer yang dihapus tidak dapat dikembalikan.
            </p>

        </div>


        <form
            action="{{ route('customers.destroy', $customer) }}"
            method="POST"
            onsubmit="return confirm('Yakin ingin menghapus customer ini?')"
        >

            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="px-5 py-2.5 bg-red-600 text-white
                       rounded-lg hover:bg-red-700 transition"
            >
                🗑️ Hapus Customer
            </button>

        </form>

    </div>

</div>

@endsection