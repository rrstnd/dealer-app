<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller Pengelolaan Data Pelanggan / Konsumen (CRUD) Panel Admin Suja Mobilindo.
 *
 * Mengelola pendaftaran pelanggan baru, validasi identitas (NIK & Nomor HP),
 * pencarian multi-kolom, pembaruan profil pelanggan, serta penghapusan data.
 */
class CustomerController extends Controller
{
    /**
     * Menampilkan daftar seluruh data pelanggan dengan fitur pencarian teks dan paginasi.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Customer::query();

        // Fitur Pencarian Multi-Kolom: Kode Pelanggan, Nama Lengkap, NIK KTP, atau Nomor Telepon
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('customer_code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Urutkan dari data yang paling baru diinput dengan paginasi 10 baris per halaman
        $customers = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Menampilkan formulir pendaftaran pelanggan baru.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.customers.create');
    }

    /**
     * Menyimpan data pelanggan baru ke database.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_code' => 'required|string|max:30|unique:customers,customer_code',
            'name'          => 'required|string|max:100',
            'nik'           => 'nullable|string|max:30|unique:customers,nik',
            'phone'         => 'required|string|max:30',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
            'city'          => 'nullable|string|max:100',
            'province'      => 'nullable|string|max:100',
            'notes'         => 'nullable|string',
        ]);

        Customer::create($validated);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data pelanggan berhasil ditambahkan.');
    }

    /**
     * Menampilkan rincian profil lengkap satu pelanggan beserta riwayat transaksi pembelian unit.
     *
     * @param Customer $customer
     * @return View
     */
    public function show(Customer $customer): View
    {
        $customer->load([
            'sales.vehicle.brand',
            'sales.vehicle.model',
        ]);

        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Menampilkan formulir pengeditan data pelanggan.
     *
     * @param Customer $customer
     * @return View
     */
    public function edit(Customer $customer): View
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Memperbarui data pelanggan yang telah tersimpan di database.
     * Mengabaikan ID pelanggan saat ini saat memeriksa keunikan Kode Pelanggan dan NIK.
     *
     * @param Request $request
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $validated = $request->validate([
            'customer_code' => 'required|string|max:30|unique:customers,customer_code,' . $customer->id,
            'name'          => 'required|string|max:100',
            'nik'           => 'nullable|string|max:30|unique:customers,nik,' . $customer->id,
            'phone'         => 'required|string|max:30',
            'email'         => 'nullable|email|max:255',
            'address'       => 'nullable|string',
            'city'          => 'nullable|string|max:100',
            'province'      => 'nullable|string|max:100',
            'notes'         => 'nullable|string',
        ]);

        $customer->update($validated);

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data pelanggan berhasil diperbarui.');
    }

    /**
     * Menghapus data pelanggan dari sistem.
     *
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        // Pastikan tidak menghapus pelanggan yang memiliki riwayat transaksi aktif
        if ($customer->sales()->exists()) {
            return redirect()
                ->route('admin.customers.index')
                ->with('error', 'Pelanggan ini memiliki riwayat transaksi penjualan dan tidak dapat dihapus.');
        }

        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data pelanggan berhasil dihapus.');
    }
}
