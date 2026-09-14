<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Vehicle::with([
            'vehicleType',
            'brand',
            'model',
        ]);

        // Search
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

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

       $vehicles = $query->latest()->paginate(10)->withQueryString();

        return view('vehicles.index', compact('vehicles'));
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->load([
            'brand',
            'model',
            'vehicleType',
            'images',
        ]);

        return view('vehicles.show', compact('vehicle'));
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil dihapus.');
    }

    public function create(): View
    {
        $vehicleTypes = VehicleType::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $models = VehicleModel::orderBy('name')->get();

        return view('vehicles.create', compact(
            'vehicleTypes',
            'brands',
            'models'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'stock_code' => 'required|string|max:30|unique:vehicles,stock_code',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:vehicle_models,id',

            'variant' => 'nullable|string|max:100',
            'year' => 'required|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:50',
            'transmission' => 'nullable|string|max:20',
            'fuel_type' => 'nullable|string|max:20',
            'engine_capacity' => 'nullable|integer|min:1',
            'mileage' => 'nullable|integer|min:0',
            'license_plate' => 'nullable|string|max:15',

            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',

            'status' => 'required|in:AVAILABLE,RESERVED,SOLD,SERVICE,INACTIVE',
            'description' => 'nullable|string',
        ]);

        Vehicle::create($validated);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil ditambahkan.');
    }


    public function edit(Vehicle $vehicle): View
    {
        $vehicleTypes = VehicleType::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $models = VehicleModel::orderBy('name')->get();

        return view('vehicles.edit', compact(
            'vehicle',
            'vehicleTypes',
            'brands',
            'models'
        ));
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'stock_code' => 'required|string|max:30|unique:vehicles,stock_code,' . $vehicle->id,
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:vehicle_models,id',

            'variant' => 'nullable|string|max:100',
            'year' => 'required|integer|min:1900|max:2100',
            'color' => 'nullable|string|max:50',
            'transmission' => 'nullable|string|max:20',
            'fuel_type' => 'nullable|string|max:20',
            'engine_capacity' => 'nullable|integer|min:1',
            'mileage' => 'nullable|integer|min:0',
            'license_plate' => 'nullable|string|max:15',

            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',

            'status' => 'required|in:AVAILABLE,RESERVED,SOLD,SERVICE,INACTIVE',
            'description' => 'nullable|string',
        ]);

        $vehicle->update($validated);

        return redirect()
            ->route('admin.vehicles.index')
            ->with('success', 'Kendaraan berhasil diperbarui.');
    }
   
}
