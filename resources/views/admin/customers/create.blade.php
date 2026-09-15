@extends('layouts.admin')

@section('title', 'Tambah Customer')
@section('page-title', 'Tambah Customer')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-6">

        <a href="{{ route('admin.customers.index') }}"
           class="text-sm text-slate-500 hover:text-slate-800">

            ← Kembali ke Customer

        </a>

        <h1 class="text-2xl font-bold text-slate-800 mt-3">
            Tambah Customer
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Masukkan data customer baru
        </p>

    </div>


    <form action="{{ route('admin.customers.store') }}"
          method="POST"
          class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">

        @csrf


        {{-- IDENTITAS --}}
        <div class="mb-8">

            <h2 class="font-semibold text-lg text-slate-800 mb-4">
                Identitas Customer
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama customer"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
                        required
                    >

                    @error('name')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>
                    <label class="block text-sm font-medium mb-2">
                        NIK
                    </label>

                    <input
                        type="text"
                        name="nik"
                        value="{{ old('nik') }}"
                        placeholder="NIK customer"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
                    >

                    @error('nik')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>
                    <label class="block text-sm font-medium mb-2">
                        No. HP
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
                        required
                    >

                    @error('phone')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="customer@email.com"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
                    >

                    @error('email')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- ALAMAT --}}
        <div class="mb-8">

            <h2 class="font-semibold text-lg text-slate-800 mb-4">
                Alamat
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Alamat Lengkap
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        placeholder="Alamat lengkap customer"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
                    >{{ old('address') }}</textarea>

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Kota
                    </label>

                    <input
                        type="text"
                        name="city"
                        value="{{ old('city') }}"
                        placeholder="Contoh: Karawang"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
                    >

                </div>


                <div>

                    <label class="block text-sm font-medium mb-2">
                        Provinsi
                    </label>

                    <input
                        type="text"
                        name="province"
                        value="{{ old('province') }}"
                        placeholder="Contoh: Jawa Barat"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
                    >

                </div>

            </div>

        </div>


        {{-- CATATAN --}}
        <div class="mb-8">

            <h2 class="font-semibold text-lg text-slate-800 mb-4">
                Catatan
            </h2>

            <textarea
                name="notes"
                rows="4"
                placeholder="Catatan tambahan..."
                class="w-full px-4 py-3 border border-slate-300 rounded-lg outline-none focus:ring-2 focus:ring-slate-400"
            >{{ old('notes') }}</textarea>

        </div>


        {{-- BUTTON --}}
        <div class="flex justify-end gap-3 border-t pt-5">

            <a href="{{ route('admin.customers.index') }}"
               class="px-5 py-3 border border-slate-300 rounded-lg hover:bg-slate-100">

                Batal

            </a>

            <button
                type="submit"
                class="px-6 py-3 bg-slate-900 text-white rounded-lg hover:bg-slate-700">

                💾 Simpan Customer

            </button>

        </div>

    </form>

</div>

@endsection
