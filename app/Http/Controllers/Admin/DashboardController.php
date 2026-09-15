<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Vehicle;
use Illuminate\View\View;

/**
 * Controller untuk Dashboard Utama Panel Admin Suja Mobilindo.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan rangkuman statistik unit, pelanggan, transaksi penjualan terbaru, dan stok kendaraan terbaru.
     *
     * @return View
     */
    public function index(): View
    {
        // 1. Perhitungan Statistik Stok Kendaraan
        $totalVehicles     = Vehicle::count();
        $availableVehicles = Vehicle::where('status', 'AVAILABLE')->count();
        $soldVehicles      = Vehicle::where('status', 'SOLD')->count();
        $reservedVehicles  = Vehicle::where('status', 'RESERVED')->count();

        // 2. Total Pelanggan Terdaftar
        $totalCustomers = Customer::count();

        // 3. Transaksi Penjualan Terbaru (5 Transaksi Terakhir)
        $recentSales = Sale::with([
            'customer',
            'vehicle.brand',
            'vehicle.model',
        ])
            ->latest('sale_date')
            ->take(5)
            ->get();

        // 4. Daftar Stok Kendaraan Terbaru (6 Unit Terakhir)
        $vehicles = Vehicle::with([
            'brand',
            'model',
            'primaryImage',
        ])
            ->latest()
            ->take(6)
            ->get();

        // 5. Render Halaman Dashboard Admin
        return view('admin.dashboard.index', compact(
            'totalVehicles',
            'availableVehicles',
            'soldVehicles',
            'reservedVehicles',
            'totalCustomers',
            'recentSales',
            'vehicles'
        ));
    }
}