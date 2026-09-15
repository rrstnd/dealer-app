<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller untuk Katalog Kendaraan (Publik Website) Suja Mobilindo.
 */
class VehicleController extends Controller
{
    /**
     * Menampilkan daftar katalog kendaraan yang tersedia dengan fitur Pencarian, Filtering, & Sorting.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // 1. Validasi parameter query pencarian & filter dari request
        $request->validate([
            'search'          => 'nullable|string|max:100',
            'vehicle_type_id' => 'nullable|integer|exists:vehicle_types,id',
            'brand_id'        => 'nullable|integer|exists:brands,id',
            'year_min'        => 'nullable|integer|min:1900|max:2100',
            'year_max'        => 'nullable|integer|min:1900|max:2100',
            'price_min'       => 'nullable|numeric|min:0',
            'price_max'       => 'nullable|numeric|min:0',
            'sort'            => 'nullable|in:price_asc,price_desc,year_desc',
        ]);

        // 2. Inisialisasi Query Builder kendaraan hanya dengan status 'AVAILABLE'
        $query = Vehicle::with([
            'brand',
            'model',
            'vehicleType',
            'primaryImage',
        ])->where('status', 'AVAILABLE');

        // 3. Filter Pencarian Teks (Kode Stok, Plat Nomor, Nama Brand, atau Nama Model)
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('stock_code', 'like', "%{$search}%")
                    ->orWhere('license_plate', 'like', "%{$search}%")
                    ->orWhereHas('brand', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('model', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // 4. Filter Tipe Kendaraan (Mobil / Motor)
        if ($request->filled('vehicle_type_id')) {
            $query->where('vehicle_type_id', $request->vehicle_type_id);
        }

        // 5. Filter Brand / Merek (Toyota, Honda, Yamaha, dll.)
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // 6. Filter Rentang Tahun Pembuatan
        if ($request->filled('year_min')) {
            $query->where('year', '>=', $request->year_min);
        }
        if ($request->filled('year_max')) {
            $query->where('year', '<=', $request->year_max);
        }

        // 7. Filter Rentang Harga Jual
        if ($request->filled('price_min')) {
            $query->where('selling_price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('selling_price', '<=', $request->price_max);
        }

        // 8. Opsi Pengurutan (Sorting)
        $sort = $request->get('sort');

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('selling_price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('selling_price', 'desc');
                break;

            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;

            default:
                $query->latest(); // Terbaru diinput
                break;
        }

        // 9. Ambil data dengan Pagination (12 kendaraan per halaman) & pertahankan Query String
        $vehicles = $query
            ->paginate(12)
            ->withQueryString();

        // 10. Ambil opsi Brand & Tipe Kendaraan untuk dropdown filter di view
        $brands = Brand::orderBy('name')->get();
        $vehicleTypes = VehicleType::orderBy('name')->get();

        return view(
            'website.vehicles.index',
            compact('vehicles', 'brands', 'vehicleTypes')
        );
    }

    /**
     * Menampilkan detail lengkap satu unit kendaraan.
     *
     * @param Vehicle $vehicle
     * @return View
     */
    public function show(Vehicle $vehicle): View
    {
        // Pengunjung umum hanya diperbolehkan melihat kendaraan yang berstatus AVAILABLE
        abort_unless(
            $vehicle->status === 'AVAILABLE',
            404
        );

        // Load relasi data lengkap (Brand, Model, Tipe, & Galeri Foto)
        $vehicle->load([
            'brand',
            'model',
            'vehicleType',
            'images',
        ]);

        return view(
            'website.vehicles.show',
            compact('vehicle')
        );
    }
}