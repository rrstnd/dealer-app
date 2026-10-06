<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\View\View;

/**
 * Controller Halaman Depan / Beranda (Landing Page Publik) Suja Mobilindo.
 *
 * Mengelola etalase kendaraan unggulan terkini yang siap dipasarkan kepada pengunjung umum,
 * serta menyuplai master data Brand dan Tipe untuk bilah pencarian cepat di hero section.
 */
class HomeController extends Controller
{
    /**
     * Menampilkan beranda publik beserta 6 unit kendaraan terbaru berstatus 'AVAILABLE'.
     *
     * Eager loading relasi (brand, model, vehicleType, primaryImage) diimplementasikan
     * untuk mencegah masalah performa N+1 Query.
     *
     * @return View
     */
    public function index(): View
    {
        // 1. Ambil 6 unit kendaraan berstatus siap dijual (AVAILABLE).
        //    Unit yang di-pin admin (maks. 3) selalu tampil di posisi teratas sesuai urutan pin,
        //    sisanya diisi unit terbaru.
        $vehicles = Vehicle::with([
            'brand',
            'model',
            'vehicleType',
            'primaryImage',
        ])
            ->where('status', Vehicle::STATUS_AVAILABLE)
            ->orderByDesc('is_pinned')
            ->orderBy('pinned_at')
            ->latest()
            ->take(6)
            ->get();

        // 2. Ambil data Brand dan Tipe kendaraan untuk filter cepat di Beranda
        $brands       = Brand::orderBy('name')->get();
        $vehicleTypes = VehicleType::orderBy('name')->get();

        return view('website.home', compact('vehicles', 'brands', 'vehicleTypes'));
    }
}
