<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::with([
            'brand',
            'model',
            'vehicleType',
            'primaryImage',
        ])
            ->where('status', 'AVAILABLE')
            ->latest()
            ->take(6)
            ->get();

        return view('website.home', compact('vehicles'));
    }
}
