@extends('layouts.admin')

@section('title', 'Edit Customer')
@section('page-title', 'Edit Customer')

@section('content')

<div class="max-w-5xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Edit Customer
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Perbarui informasi customer
            </p>
        </div>

        <a href="{{ route('admin.customers.show', $customer) }}"
           class="px-4 py-2.5 border border-slate-300 rounded-lg
                  text-slate-600 hover:bg-slate-100 transition">
            ← Kembali
        </a>

    </div>


    {{-- ERROR VALIDATION --}}
    @if ($errors->any())

        <div class="bg-red-50 border border-red-200 rounded-xl p-5">

            <div class="font-semibold text-red-700 mb-2">
                Terdapat kesalahan:
            </div>

            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORM --}}
    <form
        action="{{ route('admin.customers.update', $customer) }}"
        method="POST"
        class="space-y-6"
    >

        @csrf
        @method('PUT')


        {{-- DATA PRIBADI --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <h2 class="text-lg font-semibold text-slate-800 mb-6">
                Data Pribadi
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                {{-- ID CUSTOMER --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        ID Customer
                    </label>

                    <input
                        type="text"
                        name="{{ $customer->id }}"
                        value="{{ old('id', $customer->id) }}"
                        required
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-lg focus:ring-2 focus:ring-slate-400
                               focus:border-slate-400 outline-none"
                    >

                </div>


                {{-- NAMA --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $customer->name) }}"
                        required
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-lg focus:ring-2 focus:ring-slate-400
                               focus:border-slate-400 outline-none"
                    >

                </div>


                {{-- NIK --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        NIK
                    </label>

                    <input
                        type="text"
                        name="nik"
                        value="{{ old('nik', $customer->nik) }}"
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-lg focus:ring-2 focus:ring-slate-400
                               focus:border-slate-400 outline-none"
                    >

                </div>


                {{-- PHONE --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        No. HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $customer->phone) }}"
                        required
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-lg focus:ring-2 focus:ring-slate-400
                               focus:border-slate-400 outline-none"
                    >

                </div>


                {{-- EMAIL --}}
                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $customer->email) }}"
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-lg focus:ring-2 focus:ring-slate-400
                               focus:border-slate-400 outline-none"
                    >

                </div>

            </div>

        </div>


        {{-- ALAMAT --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <h2 class="text-lg font-semibold text-slate-800 mb-6">
                Alamat
            </h2>

            <div class="space-y-5">


                {{-- ALAMAT LENGKAP --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-2">
                        Alamat Lengkap
                    </label>

                    <textarea
                        name="address"
                        rows="4"
                        class="w-full px-4 py-3 border border-slate-300
                               rounded-lg focus:ring-2 focus:ring-slate-400
                               focus:border-slate-400 outline-none"
                    >{{ old('address', $customer->address) }}</textarea>

                </div>


                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- KOTA --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Kota
                        </label>

                        <input
                            type="text"
                            name="city"
                            value="{{ old('city', $customer->city) }}"
                            class="w-full px-4 py-3 border border-slate-300
                                   rounded-lg focus:ring-2 focus:ring-slate-400
                                   focus:border-slate-400 outline-none"
                        >

                    </div>


                    {{-- PROVINSI --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Provinsi
                        </label>

                        <input
                            type="text"
                            name="province"
                            value="{{ old('province', $customer->province) }}"
                            class="w-full px-4 py-3 border border-slate-300
                                   rounded-lg focus:ring-2 focus:ring-slate-400
                                   focus:border-slate-400 outline-none"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- CATATAN --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

            <h2 class="text-lg font-semibold text-slate-800 mb-6">
                Catatan
            </h2>

            <textarea
                name="notes"
                rows="4"
                placeholder="Catatan tambahan..."
                class="w-full px-4 py-3 border border-slate-300
                       rounded-lg focus:ring-2 focus:ring-slate-400
                       focus:border-slate-400 outline-none"
            >{{ old('notes', $customer->notes) }}</textarea>

        </div>


        {{-- BUTTON --}}
        <div class="flex flex-col-reverse md:flex-row md:justify-end gap-3">

            <a
                href="{{ route('admin.customers.show', $customer) }}"
                class="px-6 py-3 border border-slate-300 rounded-lg
                       text-slate-600 text-center hover:bg-slate-100 transition"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-6 py-3 bg-slate-900 text-white rounded-lg
                       hover:bg-slate-700 transition"
            >
                💾 Simpan Perubahan
            </button>

        </div>

    </form>

</div>

@endsection



