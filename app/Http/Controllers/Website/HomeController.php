<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;

/**
 * Controller untuk Halaman Utama (Landing Page Website) Suja Mobilindo.
 */
class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama website beserta katalog kendaraan terbaru yang siap dijual.
     *
     * @return View
     */
    public function index(): View
    {
        // Mengambil 6 kendaraan terbaru dengan status 'AVAILABLE'
        // Eager Loading relasi (brand, model, vehicleType, primaryImage) untuk mencegah N+1 Query problem
        $vehicles = Vehicle::with([
            'brand',
            'model',
            'vehicleType',
            'primaryImage',
        ])
            ->where('status', 'AVAILABLE') // Hanya yang siap jual
            ->latest()                     // Urutkan dari yang terbaru diinput
            ->take(6)                      // Ambil maksimal 6 unit untuk ditampilkan di Beranda
            ->get();

        // Mengirimkan data kendaraan ke view website.home
        return view('website.home', compact('vehicles'));
    }
}

