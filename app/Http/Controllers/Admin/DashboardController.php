<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Vehicle;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalVehicles = Vehicle::count();

        $availableVehicles = Vehicle::where('status', 'AVAILABLE')->count();

        $soldVehicles = Vehicle::where('status', 'SOLD')->count();

        $reservedVehicles = Vehicle::where('status', 'RESERVED')->count();

        $totalCustomers = Customer::count();

        $recentSales = Sale::with([
            'customer',
            'vehicle.brand',
            'vehicle.model',
        ])
            ->latest('sale_date')
            ->take(5)
            ->get();

        $vehicles = Vehicle::with([
            'brand',
            'model',
            'primaryImage',
        ])
            ->latest()
            ->take(6)
            ->get();

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