<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleLog;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Controller Pengelolaan Inventaris Kendaraan (CRUD & Manajemen Stok) Panel Admin.
 *
 * Mengatur pencarian inventaris, penambahan unit baru dengan pembuatan master data dinamis
 * (Tipe, Brand, Model), pembaruan data teknis/spesifikasi, penghapusan unit, dan detail unit.
 */
class VehicleController extends Controller
{
    /**
     * Menampilkan daftar inventaris kendaraan showroom dengan filter pencarian dan status.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        // Inisialisasi eager loading relasi untuk efisiensi kueri database (mencegah N+1 problem)
        $query = Vehicle::with([
            'vehicleType',
            'brand',
            'model',
        ]);

        // Filter Pencarian Bebas: Kode Stok, Plat Nomor, Nama Brand, atau Nama Model
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

        // Filter Berdasarkan Status Inventaris (AVAILABLE, RESERVED, SOLD, SERVICE, INACTIVE)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ambil data terbaru dengan paginasi 10 item dan sertakan parameter URL filter
        $vehicles = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Menampilkan formulir pendaftaran unit kendaraan baru ke dalam inventaris.
     *
     * @return View
     */
    public function create(): View
    {
        // Dapatkan usulan nomor kode stok otomatis berikutnya
        $nextStockCode = $this->generateNextStockCode();

        return view('admin.vehicles.create', compact('nextStockCode'));
    }

    /**
     * Menyimpan data kendaraan baru ke database.
     *
     * Catatan Pengembangan:
     * Input Brand, Tipe, dan Model berupa teks bebas. Sistem akan mencari kecocokan nama
     * (case-insensitive) di database. Jika belum ada, sistem akan membuat master data baru secara dinamis
     * di dalam Database Transaction agar konsistensi relasi data tetap terjamin.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi masukan pengguna
        $validated = $request->validate([
            // Input Master Data Tekstual
            'type'              => 'required|string|max:50',
            'brand'             => 'required|string|max:50',
            'model'             => 'required|string|max:100',

            // Atribut Spesifikasi Fisik & Teknis
            'variant'           => 'nullable|string|max:100',
            'year'              => 'required|integer|min:1900|max:2100',
            'color'             => 'nullable|string|max:50',
            'transmission'      => 'nullable|string|max:20',
            'fuel_type'         => 'nullable|string|max:20',
            'engine_capacity'   => 'nullable|integer|min:1',
            'mileage'           => 'nullable|integer|min:0',
            'license_plate'     => 'nullable|string|max:15',

            // Legalitas Dokumen Kendaraan
            'chassis_number'    => 'nullable|string|max:50|unique:vehicles,chassis_number',
            'engine_number'     => 'nullable|string|max:50|unique:vehicles,engine_number',
            'registration_year' => 'nullable|integer|min:1900|max:2100',

            // Finansial & Status
            'purchase_price'    => 'required|numeric|min:0',
            'selling_price'     => 'required|numeric|min:0',
            'status'            => 'required|in:AVAILABLE,RESERVED,SOLD,SERVICE,INACTIVE',
            'description'       => 'nullable|string',
        ]);

        // 2. Eksekusi penyimpanan dalam satu Database Transaction utuh
        $vehicle = DB::transaction(function () use ($validated) {

            // A. Sinkronisasi Tipe Kendaraan (Mobil / Motor)
            $vehicleType = VehicleType::query()
                ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['type']))])
                ->first();

            if (!$vehicleType) {
                $vehicleType = VehicleType::create([
                    'name' => trim($validated['type']),
                ]);
            }

            // B. Sinkronisasi Brand / Merek Kendaraan
            $brand = Brand::query()
                ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['brand']))])
                ->first();

            if (!$brand) {
                $brand = Brand::create([
                    'name' => trim($validated['brand']),
                ]);
            }

            // C. Sinkronisasi Model Kendaraan di bawah Brand yang bersangkutan
            $vehicleModel = VehicleModel::query()
                ->where('brand_id', $brand->id)
                ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['model']))])
                ->first();

            if (!$vehicleModel) {
                $vehicleModel = VehicleModel::create([
                    'brand_id' => $brand->id,
                    'name'     => trim($validated['model']),
                ]);
            }

            // D. Pembuatan Record Kendaraan Baru
            $newVehicle = Vehicle::create([
                'stock_code'        => $this->generateNextStockCode(),
                'vehicle_type_id'   => $vehicleType->id,
                'brand_id'          => $brand->id,
                'model_id'          => $vehicleModel->id,
                'variant'           => $validated['variant'] ?? null,
                'year'              => $validated['year'],
                'color'             => $validated['color'] ?? null,
                'transmission'      => $validated['transmission'] ?? null,
                'fuel_type'         => $validated['fuel_type'] ?? null,
                'engine_capacity'   => $validated['engine_capacity'] ?? null,
                'mileage'           => $validated['mileage'] ?? null,
                'license_plate'     => $validated['license_plate'] ?? null,
                'chassis_number'    => $validated['chassis_number'] ?? null,
                'engine_number'     => $validated['engine_number'] ?? null,
                'registration_year' => $validated['registration_year'] ?? null,
                'purchase_price'    => $validated['purchase_price'],
                'selling_price'     => $validated['selling_price'],
                'status'            => $validated['status'],
                'description'       => $validated['description'] ?? null,
            ]);

            // E. Catat Log IN (Kendaraan Tambah/Masuk ke Website)
            VehicleLog::create([
                'type'          => 'IN',
                'vehicle_id'    => $newVehicle->id,
                'stock_code'    => $newVehicle->stock_code,
                'vehicle_name'  => trim($brand->name . ' ' . $vehicleModel->name . ' (' . $newVehicle->year . ')'),
                'license_plate' => $newVehicle->license_plate,
                'price'         => $newVehicle->selling_price,
                'user_name'     => auth()->user()->name ?? 'Admin',
                'action_at'     => now(),
                'notes'         => 'Kendaraan ditambahkan ke website.',
            ]);

            return $newVehicle;
        });

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan dengan kode stok: ' . $vehicle->stock_code);
    }

    /**
     * Menampilkan rincian detail data lengkap satu unit kendaraan beserta galeri foto.
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
     * Menampilkan formulir edit spesifikasi unit kendaraan.
     *
     * @param Vehicle $vehicle
     * @return View
     */
    public function edit(Vehicle $vehicle): View
    {
        $vehicle->load([
            'vehicleType',
            'brand',
            'model',
        ]);

        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Memperbarui data kendaraan yang telah ada di database.
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update(Request $request, Vehicle $vehicle): RedirectResponse
    {
        // 1. Validasi masukan pengguna
        $validated = $request->validate([
            'type'              => 'required|string|max:50',
            'brand'             => 'required|string|max:50',
            'model'             => 'required|string|max:100',
            'variant'           => 'nullable|string|max:100',
            'year'              => 'required|integer|min:1900|max:2100',
            'color'             => 'nullable|string|max:50',
            'transmission'      => 'nullable|string|max:20',
            'fuel_type'         => 'nullable|string|max:20',
            'engine_capacity'   => 'nullable|integer|min:1',
            'mileage'           => 'nullable|integer|min:0',
            'license_plate'     => 'nullable|string|max:15',

            // Abaikan ID kendaraan saat ini untuk validasi keunikan nomor rangka & mesin
            'chassis_number'    => [
                'nullable',
                'string',
                'max:50',
                'unique:vehicles,chassis_number,' . $vehicle->id,
            ],
            'engine_number'     => [
                'nullable',
                'string',
                'max:50',
                'unique:vehicles,engine_number,' . $vehicle->id,
            ],

            'registration_year' => 'nullable|integer|min:1900|max:2100',
            'purchase_price'    => 'required|numeric|min:0',
            'selling_price'     => 'required|numeric|min:0',
            'status'            => 'required|in:AVAILABLE,RESERVED,SOLD,SERVICE,INACTIVE',
            'description'       => 'nullable|string',
        ]);

        // 2. Eksekusi pembaruan dalam Database Transaction
        DB::transaction(function () use ($validated, $vehicle) {

            // A. Sinkronisasi / Buat Tipe Kendaraan
            $vehicleType = VehicleType::query()
                ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['type']))])
                ->first();

            if (!$vehicleType) {
                $vehicleType = VehicleType::create([
                    'name' => trim($validated['type']),
                ]);
            }

            // B. Sinkronisasi / Buat Brand
            $brand = Brand::query()
                ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['brand']))])
                ->first();

            if (!$brand) {
                $brand = Brand::create([
                    'name' => trim($validated['brand']),
                ]);
            }

            // C. Sinkronisasi / Buat Model pada Brand terkait
            $vehicleModel = VehicleModel::query()
                ->where('brand_id', $brand->id)
                ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['model']))])
                ->first();

            if (!$vehicleModel) {
                $vehicleModel = VehicleModel::create([
                    'brand_id' => $brand->id,
                    'name'     => trim($validated['model']),
                ]);
            }

            // D. Pembaruan data atribut kendaraan (Kode Stok tidak diubah demi konsistensi arsip)
            $vehicle->update([
                'vehicle_type_id'   => $vehicleType->id,
                'brand_id'          => $brand->id,
                'model_id'          => $vehicleModel->id,
                'variant'           => $validated['variant'] ?? null,
                'year'              => $validated['year'],
                'color'             => $validated['color'] ?? null,
                'transmission'      => $validated['transmission'] ?? null,
                'fuel_type'         => $validated['fuel_type'] ?? null,
                'engine_capacity'   => $validated['engine_capacity'] ?? null,
                'mileage'           => $validated['mileage'] ?? null,
                'license_plate'     => $validated['license_plate'] ?? null,
                'chassis_number'    => $validated['chassis_number'] ?? null,
                'engine_number'     => $validated['engine_number'] ?? null,
                'registration_year' => $validated['registration_year'] ?? null,
                'purchase_price'    => $validated['purchase_price'],
                'selling_price'     => $validated['selling_price'],
                'status'            => $validated['status'],
                'description'       => $validated['description'] ?? null,
            ]);
        });

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    /**
     * Menghapus data unit kendaraan dari inventaris.
     * Kendaraan yang sudah berstatus 'SOLD' dilarang dihapus untuk menjaga keutuhan riwayat laporan keuangan.
     *
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        if ($vehicle->status === Vehicle::STATUS_SOLD) {
            return redirect()
                ->route('admin.vehicles.index')
                ->with('error', 'Kendaraan yang sudah SOLD tidak dapat dihapus demi integritas data laporan.');
        }

        $vehicleName = trim(($vehicle->brand->name ?? '') . ' ' . ($vehicle->model->name ?? '') . ' (' . $vehicle->year . ')');

        // Catat Log OUT (Kendaraan Hapus/Keluar dari Website)
        VehicleLog::create([
            'type'          => 'OUT',
            'vehicle_id'    => null,
            'stock_code'    => $vehicle->stock_code,
            'vehicle_name'  => $vehicleName ?: 'Kendaraan ' . $vehicle->stock_code,
            'license_plate' => $vehicle->license_plate,
            'price'         => $vehicle->selling_price,
            'user_name'     => auth()->user()->name ?? 'Admin',
            'action_at'     => now(),
            'notes'         => 'Kendaraan dihapus dari website.',
        ]);

        $vehicle->delete();

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus dari inventaris.');
    }

    /**
     * Menghasilkan nomor Kode Stok otomatis berikutnya secara berurutan.
     * Mengambil angka tertinggi dari pola 'STK-XXXX' dan menambahkan 1 dengan padding 4 digit.
     * Contoh: STK-0001, STK-0002, dst.
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
}