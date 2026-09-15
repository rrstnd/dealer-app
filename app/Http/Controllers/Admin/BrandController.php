<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Search brands.
     */
    public function search(Request $request)
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
     * Create new brand.
     */
    public function store(Request $request)
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