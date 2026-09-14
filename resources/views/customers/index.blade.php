@extends('layouts.admin')

@section('title', 'Customer')
@section('page-title', 'Customer')

@section('content')

<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Customer
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Kelola data customer dealer
            </p>
        </div>

        <a href="{{ route('customers.create') }}"
           class="inline-flex items-center justify-center gap-2
                  bg-slate-900 text-white
                  px-5 py-3 rounded-lg
                  hover:bg-slate-700 transition">

            <span>＋</span>
            Tambah Customer
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))

        <div class="bg-emerald-50 border border-emerald-200
                    text-emerald-700
                    px-5 py-4 rounded-xl">

            {{ session('success') }}

        </div>

    @endif


    {{-- SEARCH --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">

        <form method="GET"
              action="{{ route('customers.index') }}"
              class="flex flex-col md:flex-row gap-3">

            <div class="flex-1">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari kode, nama, NIK, atau nomor HP..."
                    class="w-full px-4 py-3
                           border border-slate-300
                           rounded-lg
                           focus:ring-2 focus:ring-slate-400
                           focus:border-slate-400
                           outline-none"
                >

            </div>

            <button
                type="submit"
                class="px-6 py-3
                       bg-slate-900 text-white
                       rounded-lg
                       hover:bg-slate-700 transition">

                🔍 Cari

            </button>

            @if(request('search'))

                <a href="{{ route('customers.index') }}"
                   class="px-6 py-3
                          border border-slate-300
                          rounded-lg
                          text-slate-600
                          hover:bg-slate-100
                          text-center">

                    Reset

                </a>

            @endif

        </form>

    </div>


    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            Customer
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            NIK
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            No. HP
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left font-semibold text-slate-600">
                            Lokasi
                        </th>

                        <th class="px-6 py-4 text-right font-semibold text-slate-600">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse ($customers as $customer)

                        <tr class="hover:bg-slate-50 transition">

                            <td class="px-6 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $customer->name }}
                                </div>

                                <div class="text-xs text-slate-500 mt-1">
                                    {{ $customer->customer_code }}
                                </div>

                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $customer->nik ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $customer->phone }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">
                                {{ $customer->email ?? '-' }}
                            </td>

                            <td class="px-6 py-4 text-slate-600">

                                @if($customer->city || $customer->province)

                                    {{ $customer->city ?? '-' }}

                                    @if($customer->province)
                                        , {{ $customer->province }}
                                    @endif

                                @else
                                    -
                                @endif

                            </td>

                            <td class="px-6 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    <a href="{{ route('customers.show', $customer) }}"
                                       class="px-3 py-2
                                              text-slate-600
                                              hover:bg-slate-100
                                              rounded-lg">

                                        👁️

                                    </a>

                                    <a href="{{ route('customers.edit', $customer) }}"
                                       class="px-3 py-2
                                              text-blue-600
                                              hover:bg-blue-50
                                              rounded-lg">

                                        ✏️

                                    </a>

                                    <form
                                        action="{{ route('customers.destroy', $customer) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus customer ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-2
                                                   text-red-600
                                                   hover:bg-red-50
                                                   rounded-lg">

                                            🗑️

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6"
                                class="px-6 py-12 text-center">

                                <div class="text-4xl mb-3">
                                    👥
                                </div>

                                <p class="font-semibold text-slate-700">
                                    Belum ada customer
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Tambahkan customer pertama Anda.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- PAGINATION --}}
    @if ($customers->hasPages())

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 px-5 py-4">

            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between
                        gap-4">

                <div class="text-sm text-slate-500">

                    Menampilkan

                    <span class="font-semibold text-slate-700">
                        {{ $customers->firstItem() }}
                    </span>

                    -

                    <span class="font-semibold text-slate-700">
                        {{ $customers->lastItem() }}
                    </span>

                    dari

                    <span class="font-semibold text-slate-700">
                        {{ $customers->total() }}
                    </span>

                    customer

                </div>

                <div>
                    {{ $customers->links('vendor.pagination.tailwind-custom') }}
                </div>

            </div>

        </div>

    @endif

</div>

@endsection