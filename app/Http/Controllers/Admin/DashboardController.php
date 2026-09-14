<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::with([
            'brand',
            'model',
            'primaryImage',
        ])
        ->latest()
        ->take(6)
        ->get();

        return view('dashboard.index', compact('vehicles'));
    }
}