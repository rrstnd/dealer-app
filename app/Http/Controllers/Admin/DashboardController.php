<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Vehicle;
use Illuminate\View\View;

/**
 * Controller Rangkuman Eksekutif Dashboard Utama Panel Admin.
 *
 * Mengagregasi metrik statistik penting showroom: jumlah stok kendaraan berdasarkan status,
 * total pelanggan terdaftar, 5 riwayat penjualan terbaru, dan 6 unit kendaraan terkini.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan halaman ikhtisar statistik dashboard admin.
     *
     * @return View
     */
    public function index(): View
    {
        // 1. Agregasi Statistik Inventaris Kendaraan Showroom
        $totalVehicles     = Vehicle::count();
        $availableVehicles = Vehicle::where('status', Vehicle::STATUS_AVAILABLE)->count();
        $soldVehicles      = Vehicle::where('status', Vehicle::STATUS_SOLD)->count();
        $reservedVehicles  = Vehicle::where('status', Vehicle::STATUS_RESERVED)->count();

        // 2. Total Pelanggan Aktif Terdaftar
        $totalCustomers = Customer::count();

        // 3. 5 Transaksi Penjualan Terakhir (Eager load data pelanggan dan spesifikasi kendaraan)
        $recentSales = Sale::with([
            'customer',
            'vehicle.brand',
            'vehicle.model',
        ])
            ->latest('sale_date')
            ->latest('id')
            ->take(5)
            ->get();

        // 4. 6 Unit Kendaraan Terbaru yang Masuk ke Showroom
        $vehicles = Vehicle::with([
            'brand',
            'model',
            'primaryImage',
        ])
            ->latest()
            ->take(6)
            ->get();

        // 5. Render Tampilan View Dashboard
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