<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehicleModelController extends Controller
{
    /**
     * Search vehicle models by brand.
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => [
                'required',
                'exists:brands,id',
            ],
            'q' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $query = trim($validated['q'] ?? '');

        $models = VehicleModel::query()
            ->where('brand_id', $validated['brand_id'])
            ->when($query !== '', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'brand_id', 'name']);

        return response()->json($models);
    }

    /**
     * Create new vehicle model.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id' => [
                'required',
                'exists:brands,id',
            ],
            'name' => [
                'required',
                'string',
                'max:100',
            ],
        ]);

        $exists = VehicleModel::where('brand_id', $validated['brand_id'])
            ->whereRaw('LOWER(name) = ?', [strtolower($validated['name'])])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Model dengan nama tersebut sudah ada pada brand ini.',
            ], 422);
        }

        $model = VehicleModel::create($validated);

        return response()->json([
            'message' => 'Model kendaraan berhasil ditambahkan.',
            'data' => $model,
        ], 201);
    }
}