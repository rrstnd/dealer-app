<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar seluruh data customer dengan fitur pencarian & paginasi.
     */
    public function index(Request $request): View
    {
        $query = Customer::query();

        // Fitur pencarian berdasarkan Kode, Nama, NIK, atau No HP
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('customer_code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('nik', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Ambil data terbaru dengan paginasi 10 item per halaman
        $customers = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Menampilkan formulir tambah customer baru.
     */
    public function create(): View
    {
        return view('admin.customers.create');
    }

    /**
     * Menyimpan data customer baru ke dalam database.
     */
    public function store(Request $request)
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
            ->with('success', 'Data Customer berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail lengkap seorang customer.
     */
    public function show(Customer $customer): View
    {
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Menampilkan formulir edit data customer.
     */
    public function edit(Customer $customer): View
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Memperbarui data customer yang sudah ada di database.
     */
    public function update(Request $request, Customer $customer)
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
            ->with('success', 'Data Customer berhasil diperbarui.');
    }

    /**
     * Menghapus data customer dari database.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('admin.customers.index')
            ->with('success', 'Data Customer berhasil dihapus.');
    }
}
