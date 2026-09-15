<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Controller Manajerial Kendaraan (CRUD & Inventaris) Panel Admin.
 */
class VehicleController extends Controller
{
    /**
     * Menampilkan daftar inventaris kendaraan untuk Admin dengan fitur filter & pencarian.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Vehicle::with([
            'vehicleType',
            'brand',
            'model',
        ]);

        // Filter Pencarian Teks (Kode Stok, Plat Nomor, Merek, atau Model)
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

        // Filter Status Kendaraan (AVAILABLE, RESERVED, SOLD, SERVICE, INACTIVE)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $vehicles = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Menampilkan rincian detail kendaraan tertentu untuk Admin.
     *
     * @param Vehicle $vehicle
     * @return View
     */
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load([
            'brand',
            'model',
            'vehicleType',
            'images',
        ]);

        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Menghapus data kendaraan (Hanya jika belum terjual / status bukan SOLD).
     *
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Vehicle $vehicle)
    {
        if ($vehicle->status === 'SOLD') {
            return redirect()
                ->route('admin.vehicles.index')
                ->with('error', 'Kendaraan yang sudah SOLD tidak dapat dihapus.');
        }

        $vehicle->delete();

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }

    /**
     * Menghasilkan Kode Stok otomatis berikutnya.
     * Format contoh: STK-0001, STK-0002, dst.
     *
     * @return string
     */
    private function generateNextStockCode(): string
    {
        $lastNumber = Vehicle::where('stock_code', 'like', 'STK-%')
            ->get(['stock_code'])
            ->map(function ($vehicle) {
                return (int) str_replace('STK-', '', $vehicle->stock_code);
            })
            ->max() ?? 0;

        return 'STK-' . str_pad(
            $lastNumber + 1,
            4,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * Menampilkan form tambah kendaraan baru.
     *
     * @return View
     */
    public function create(): View
    {
        $nextStockCode = $this->generateNextStockCode();

        return view('admin.vehicles.create', compact(
            'nextStockCode'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | Master Data - Input berupa TEXT
            |--------------------------------------------------------------------------
            */
            'type' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:100',

            'variant' => 'nullable|string|max:100',
            'year' => 'required|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:50',
            'transmission' => 'nullable|string|max:20',
            'fuel_type' => 'nullable|string|max:20',
            'engine_capacity' => 'nullable|integer|min:1',
            'mileage' => 'nullable|integer|min:0',
            'license_plate' => 'nullable|string|max:15',

            'chassis_number' => 'nullable|string|max:50|unique:vehicles,chassis_number',
            'engine_number' => 'nullable|string|max:50|unique:vehicles,engine_number',
            'registration_year' => 'nullable|integer|min:1900|max:2100',

            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',

            'status' => 'required|in:AVAILABLE,RESERVED,SOLD,SERVICE,INACTIVE',
            'description' => 'nullable|string',
        ]);

        $vehicle = DB::transaction(function () use ($validated) {

            /*
            |--------------------------------------------------------------------------
            | Cari / buat Vehicle Type
            |--------------------------------------------------------------------------
            */
            $vehicleType = VehicleType::query()
                ->whereRaw('LOWER(name) = ?', [
                    strtolower(trim($validated['type']))
                ])
                ->first();

            if (!$vehicleType) {
                $vehicleType = VehicleType::create([
                    'name' => trim($validated['type']),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Cari / buat Brand
            |--------------------------------------------------------------------------
            */
            $brand = Brand::query()
                ->whereRaw('LOWER(name) = ?', [
                    strtolower(trim($validated['brand']))
                ])
                ->first();

            if (!$brand) {
                $brand = Brand::create([
                    'name' => trim($validated['brand']),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Cari / buat Model berdasarkan Brand
            |--------------------------------------------------------------------------
            */
            $vehicleModel = VehicleModel::query()
                ->where('brand_id', $brand->id)
                ->whereRaw('LOWER(name) = ?', [
                    strtolower(trim($validated['model']))
                ])
                ->first();

            if (!$vehicleModel) {
                $vehicleModel = VehicleModel::create([
                    'brand_id' => $brand->id,
                    'name' => trim($validated['model']),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Data kendaraan
            |--------------------------------------------------------------------------
            */
            return Vehicle::create([
                'stock_code' => $this->generateNextStockCode(),

                'vehicle_type_id' => $vehicleType->id,
                'brand_id' => $brand->id,
                'model_id' => $vehicleModel->id,

                'variant' => $validated['variant'] ?? null,
                'year' => $validated['year'],
                'color' => $validated['color'] ?? null,
                'transmission' => $validated['transmission'] ?? null,
                'fuel_type' => $validated['fuel_type'] ?? null,
                'engine_capacity' => $validated['engine_capacity'] ?? null,
                'mileage' => $validated['mileage'] ?? null,
                'license_plate' => $validated['license_plate'] ?? null,

                'chassis_number' => $validated['chassis_number'] ?? null,
                'engine_number' => $validated['engine_number'] ?? null,
                'registration_year' => $validated['registration_year'] ?? null,

                'purchase_price' => $validated['purchase_price'],
                'selling_price' => $validated['selling_price'],

                'status' => $validated['status'],
                'description' => $validated['description'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Vehicle $vehicle): View
    {
        $vehicle->load([
            'vehicleType',
            'brand',
            'model',
        ]);

        return view('admin.vehicles.edit', compact(
            'vehicle'
        ));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:50',
            'brand' => 'required|string|max:50',
            'model' => 'required|string|max:100',

            'variant' => 'nullable|string|max:100',
            'year' => 'required|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:50',
            'transmission' => 'nullable|string|max:20',
            'fuel_type' => 'nullable|string|max:20',
            'engine_capacity' => 'nullable|integer|min:1',
            'mileage' => 'nullable|integer|min:0',
            'license_plate' => 'nullable|string|max:15',

            'chassis_number' => [
                'nullable',
                'string',
                'max:50',
                'unique:vehicles,chassis_number,' . $vehicle->id,
            ],

            'engine_number' => [
                'nullable',
                'string',
                'max:50',
                'unique:vehicles,engine_number,' . $vehicle->id,
            ],

            'registration_year' => 'nullable|integer|min:1900|max:2100',

            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',

            'status' => 'required|in:AVAILABLE,RESERVED,SOLD,SERVICE,INACTIVE',

            'description' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $vehicle) {

            /*
            |--------------------------------------------------------------------------
            | Cari / buat Vehicle Type
            |--------------------------------------------------------------------------
            */

            $vehicleType = VehicleType::query()
                ->whereRaw('LOWER(name) = ?', [
                    strtolower(trim($validated['type']))
                ])
                ->first();

            if (!$vehicleType) {
                $vehicleType = VehicleType::create([
                    'name' => trim($validated['type']),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Cari / buat Brand
            |--------------------------------------------------------------------------
            */

            $brand = Brand::query()
                ->whereRaw('LOWER(name) = ?', [
                    strtolower(trim($validated['brand']))
                ])
                ->first();

            if (!$brand) {
                $brand = Brand::create([
                    'name' => trim($validated['brand']),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Cari / buat Model berdasarkan Brand
            |--------------------------------------------------------------------------
            */

            $vehicleModel = VehicleModel::query()
                ->where('brand_id', $brand->id)
                ->whereRaw('LOWER(name) = ?', [
                    strtolower(trim($validated['model']))
                ])
                ->first();

            if (!$vehicleModel) {
                $vehicleModel = VehicleModel::create([
                    'brand_id' => $brand->id,
                    'name' => trim($validated['model']),
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Update kendaraan
            |--------------------------------------------------------------------------
            */

            $vehicle->update([
                // Stock Code sengaja TIDAK diubah.
                // Nilai lama tetap dipertahankan.

                'vehicle_type_id' => $vehicleType->id,
                'brand_id' => $brand->id,
                'model_id' => $vehicleModel->id,

                'variant' => $validated['variant'] ?? null,
                'year' => $validated['year'],
                'color' => $validated['color'] ?? null,
                'transmission' => $validated['transmission'] ?? null,
                'fuel_type' => $validated['fuel_type'] ?? null,
                'engine_capacity' => $validated['engine_capacity'] ?? null,
                'mileage' => $validated['mileage'] ?? null,
                'license_plate' => $validated['license_plate'] ?? null,

                'chassis_number' => $validated['chassis_number'] ?? null,
                'engine_number' => $validated['engine_number'] ?? null,
                'registration_year' => $validated['registration_year'] ?? null,

                'purchase_price' => $validated['purchase_price'],
                'selling_price' => $validated['selling_price'],

                'status' => $validated['status'],
                'description' => $validated['description'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil diperbarui.');
    }
}