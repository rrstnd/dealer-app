<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    /**
     * Search vehicle types.
     */
    public function search(Request $request)
    {
        $query = trim($request->get('q', ''));

        $types = VehicleType::query()
            ->when($query !== '', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'name']);

        return response()->json($types);
    }

    /**
     * Create new vehicle type.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                'unique:vehicle_types,name',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ]);

        $type = VehicleType::create($validated);

        return response()->json([
            'message' => 'Tipe kendaraan berhasil ditambahkan.',
            'data' => $type,
        ], 201);
    }
}