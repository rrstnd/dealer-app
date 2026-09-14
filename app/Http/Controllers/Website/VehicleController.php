<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(Request $request): View
    {
        $request->validate([
            'search' => 'nullable|string|max:100',

            'vehicle_type_id' => 'nullable|integer|exists:vehicle_types,id',
            'brand_id' => 'nullable|integer|exists:brands,id',

            'year_min' => 'nullable|integer|min:1900|max:2100',
            'year_max' => 'nullable|integer|min:1900|max:2100',

            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|min:0',

            'sort' => 'nullable|in:price_asc,price_desc,year_desc',
        ]);

        $query = Vehicle::with([
            'brand',
            'model',
            'vehicleType',
            'primaryImage',
        ])
            ->where('status', 'AVAILABLE');

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

        // Filter Vehicle Type (Mobil / Motor)
        if ($request->filled('vehicle_type_id')) {
            $query->where('vehicle_type_id', $request->vehicle_type_id);
        }

        // Filter Brand
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Tahun minimum
        if ($request->filled('year_min')) {
            $query->where('year', '>=', $request->year_min);
        }

        // Tahun maksimum
        if ($request->filled('year_max')) {
            $query->where('year', '<=', $request->year_max);
        }

        // Harga minimum
        if ($request->filled('price_min')) {
            $query->where('selling_price', '>=', $request->price_min);
        }

        // Harga maksimum
        if ($request->filled('price_max')) {
            $query->where('selling_price', '<=', $request->price_max);
        }

        // Sorting
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
                $query->latest();
                break;
        }

        $vehicles = $query
            ->paginate(12)
            ->withQueryString();

        $brands = Brand::orderBy('name')->get();
        $vehicleTypes = \App\Models\VehicleType::orderBy('name')->get();

        return view(
            'website.vehicles.index',
            compact('vehicles', 'brands', 'vehicleTypes')
        );
    }

    public function show(Vehicle $vehicle): View
    {
        // Public hanya boleh melihat kendaraan yang masih tersedia
        abort_unless(
            $vehicle->status === 'AVAILABLE',
            404
        );

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