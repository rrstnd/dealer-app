<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleMovement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehicleMovementController extends Controller
{
    public function index(Request $request): View
    {
        $query = VehicleMovement::with([
            'vehicle.brand',
            'vehicle.model',
            'vehicle.vehicleType',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('reference', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%")

                    ->orWhereHas('vehicle', function ($q) use ($search) {
                        $q->where('stock_code', 'like', "%{$search}%")
                            ->orWhere('license_plate', 'like', "%{$search}%");
                    })

                    ->orWhereHas('vehicle.brand', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })

                    ->orWhereHas('vehicle.model', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filter Type
        |--------------------------------------------------------------------------
        */

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        /*
        |--------------------------------------------------------------------------
        | Filter Date Range
        |--------------------------------------------------------------------------
        */

        if ($request->filled('date_from')) {
            $query->whereDate(
                'movement_date',
                '>=',
                $request->date_from
            );
        }

        if ($request->filled('date_to')) {
            $query->whereDate(
                'movement_date',
                '<=',
                $request->date_to
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Pagination
        |--------------------------------------------------------------------------
        */

        $movements = $query
            ->latest('movement_date')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view(
            'admin.vehicle-movements.index',
            compact('movements')
        );
    }
}