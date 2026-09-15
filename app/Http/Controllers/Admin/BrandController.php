<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controller AJAX Master Data Merek / Brand Kendaraan.
 */
class BrandController extends Controller
{
    /**
     * Pencarian merek kendaraan via AJAX untuk autocompletion dropdown.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $query = trim($request->get('q', ''));

        $brands = Brand::query()
            ->when($query !== '', function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->orderBy('name')
            ->limit(20)
            ->get(['id', 'name']);

        return response()->json($brands);
    }

    /**
     * Menambahkan merek kendaraan baru secara dinamis via AJAX.
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
                'unique:brands,name',
            ],
        ]);

        $brand = Brand::create($validated);

        return response()->json([
            'message' => 'Brand berhasil ditambahkan.',
            'data' => $brand,
        ], 201);
    }
}