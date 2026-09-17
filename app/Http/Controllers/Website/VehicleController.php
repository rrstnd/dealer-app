<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controller Katalog Kendaraan (Publik Website) Suja Mobilindo.
 *
 * Mengelola antarmuka penelusuran katalog unit oleh pengunjung website,
 * termasuk pencarian kata kunci, penyaringan multi-parameter (merek, jenis transmisi, bahan bakar,
 * tahun produksi, rentang harga), pengurutan dinamis (sorting), serta tampilan spesifikasi detail unit.
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
        // 1. Validasi parameter query pencarian & filter dari request URL
        $request->validate([
            'search'          => 'nullable|string|max:100',
            'vehicle_type_id' => 'nullable|integer|exists:vehicle_types,id',
            'brand_id'        => 'nullable|integer|exists:brands,id',
            'year_min'        => 'nullable|integer|min:1900|max:2100',
            'year_max'        => 'nullable|integer|min:1900|max:2100',
            'price_min'       => 'nullable|numeric|min:0',
            'price_max'       => 'nullable|numeric|min:0',
            'price_range'     => 'nullable|string',
            'year'            => 'nullable|integer|min:1900|max:2100',
            'transmission'    => 'nullable|string|max:50',
            'fuel_type'       => 'nullable|string|max:50',
            'sort'            => 'nullable|in:price_asc,price_desc,year_desc',
        ]);

        // 2. Inisialisasi Query Builder kendaraan hanya untuk unit yang berstatus siap jual (AVAILABLE)
        $query = Vehicle::with([
            'brand',
            'model',
            'vehicleType',
            'primaryImage',
        ])->where('status', Vehicle::STATUS_AVAILABLE);

        // 3. Filter Pencarian Teks Bebas (Kode Stok, Plat Nomor, Nama Brand, atau Nama Model)
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

        // 6. Filter Jenis Transmisi (Automatic / Manual / CVT)
        if ($request->filled('transmission')) {
            $query->where('transmission', 'like', '%' . $request->transmission . '%');
        }

        // 7. Filter Jenis Bahan Bakar (Bensin / Diesel / Hybrid / Listrik)
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', 'like', '%' . $request->fuel_type . '%');
        }

        // 8. Filter Tahun Pembuatan
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        if ($request->filled('year_min')) {
            $query->where('year', '>=', $request->year_min);
        }
        if ($request->filled('year_max')) {
            $query->where('year', '<=', $request->year_max);
        }

        // 9. Filter Rentang Harga Jual (Preset Cepat atau Input Manual)
        if ($request->filled('price_range')) {
            switch ($request->price_range) {
                case 'under_150':
                    $query->where('selling_price', '<', 150000000);
                    break;
                case '150_300':
                    $query->whereBetween('selling_price', [150000000, 300000000]);
                    break;
                case '300_500':
                    $query->whereBetween('selling_price', [300000000, 500000000]);
                    break;
                case 'above_500':
                    $query->where('selling_price', '>', 500000000);
                    break;
            }
        } else {
            if ($request->filled('price_min')) {
                $query->where('selling_price', '>=', $request->price_min);
            }
            if ($request->filled('price_max')) {
                $query->where('selling_price', '<=', $request->price_max);
            }
        }

        // 10. Opsi Pengurutan Data (Sorting)
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
                $query->latest(); // Default: unit yang paling baru diinput ke sistem
                break;
        }

        // 11. Paginasi Hasil (12 unit per halaman) & sertakan seluruh parameter filter di URL
        $vehicles = $query
            ->paginate(12)
            ->withQueryString();

        // 12. Ambil master data pendukung untuk dropdown filter pada tampilan katalog
        $brands       = Brand::orderBy('name')->get();
        $vehicleTypes = VehicleType::orderBy('name')->get();

        return view('website.vehicles.index', compact('vehicles', 'brands', 'vehicleTypes'));
    }

    /**
     * Menampilkan detail lengkap satu unit kendaraan beserta galeri dokumentasi foto fisik.
     *
     * @param Vehicle $vehicle
     * @return View
     */
    public function show(Vehicle $vehicle): View
    {
        // Pengunjung umum hanya diperkenankan melihat halaman detail unit yang berstatus AVAILABLE
        abort_unless(
            $vehicle->status === Vehicle::STATUS_AVAILABLE,
            404,
            'Kendaraan yang dicari tidak ditemukan atau sudah tidak tersedia.'
        );

        // Eager load seluruh relasi data pendukung spesifikasi unit dan galeri foto
        $vehicle->load([
            'brand',
            'model',
            'vehicleType',
            'images',
        ]);

        return view('website.vehicles.show', compact('vehicle'));
    }
}