<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller Endpoint AJAX untuk Master Data Model Kendaraan.
 *
 * Menyediakan layanan penyaringan model berdasarkan Brand tertentu (dependent dropdown)
 * serta pembuatan model baru secara asinkron (AJAX modal).
 */
class VehicleModelController extends Controller
{
    /**
     * Pencarian model kendaraan spesifik berdasarkan brand_id via AJAX.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
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
     * Menambahkan model kendaraan baru di bawah suatu brand tertentu secara dinamis via AJAX.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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

        // Pencegahan duplikasi nama model pada brand yang sama (case-insensitive)
        $exists = VehicleModel::where('brand_id', $validated['brand_id'])
            ->whereRaw('LOWER(name) = ?', [strtolower(trim($validated['name']))])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Model dengan nama tersebut sudah terdaftar pada merek ini.',
            ], 422);
        }

        $model = VehicleModel::create([
            'brand_id' => $validated['brand_id'],
            'name'     => trim($validated['name']),
        ]);

        return response()->json([
            'message' => 'Model kendaraan berhasil ditambahkan.',
            'data'    => $model,
        ], 201);
    }
}