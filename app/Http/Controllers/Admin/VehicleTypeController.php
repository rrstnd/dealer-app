<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller AJAX Master Data Tipe Kendaraan (Mobil / Motor).
 */
class VehicleTypeController extends Controller
{
    /**
     * Pencarian tipe kendaraan via AJAX untuk autocompletion dropdown.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
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
     * Menambahkan tipe kendaraan baru secara dinamis via AJAX.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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