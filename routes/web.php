<?php

use Illuminate\Support\Facades\Route;

// Controller Website (Public Access)
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\VehicleController as WebsiteVehicleController;

// Controller Admin (Management Access)
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\VehicleImageController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\VehicleTypeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\VehicleModelController;

/*
|--------------------------------------------------------------------------
| WEBSITE / PUBLIC ROUTES
|--------------------------------------------------------------------------
| Rute untuk pengunjung umum (Website Suja Mobilindo).
| Tidak memerlukan otentikasi (login).
*/

// Halaman Utama / Landing Page
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Katalog Kendaraan (Daftar & Filter)
Route::get('/vehicles', [WebsiteVehicleController::class, 'index'])
    ->name('vehicles.index');

// Detail Kendaraan
Route::get('/vehicles/{vehicle}', [WebsiteVehicleController::class, 'show'])
    ->name('vehicles.show');


/*
|--------------------------------------------------------------------------
| ADMIN PORTAL ROUTES
|--------------------------------------------------------------------------
| Rute untuk panel administrasi aplikasi Suja Mobilindo.
| Wajib melewati middleware 'auth' (harus login terlebih dahulu).
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // --- DASHBOARD ADMIN ---
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // --- MANAJEMEN KENDARAAN (VEHICLES) ---
        Route::get('/vehicles', [VehicleController::class, 'index'])
            ->name('vehicles.index');

        Route::get('/vehicles/create', [VehicleController::class, 'create'])
            ->name('vehicles.create');

        Route::post('/vehicles', [VehicleController::class, 'store'])
            ->name('vehicles.store');

        Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])
            ->name('vehicles.edit');

        Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])
            ->name('vehicles.update');

        Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])
            ->name('vehicles.show');

        Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])
            ->name('vehicles.destroy');

        // --- AJAX SEARCH & STORE UNTUK MASTER DATA ---
        Route::get('/vehicle-types/search', [VehicleTypeController::class, 'search'])
            ->name('vehicle-types.search');

        Route::post('/vehicle-types', [VehicleTypeController::class, 'store'])
            ->name('vehicle-types.store');

        Route::get('/brands/search', [BrandController::class, 'search'])
            ->name('brands.search');

        Route::post('/brands', [BrandController::class, 'store'])
            ->name('brands.store');

        Route::get('/vehicle-models/search', [VehicleModelController::class, 'search'])
            ->name('vehicle-models.search');

        Route::post('/vehicle-models', [VehicleModelController::class, 'store'])
            ->name('vehicle-models.store');

        // --- MANAJEMEN FOTO KENDARAAN (VEHICLE IMAGES) ---
        Route::post('/vehicles/{vehicle}/images', [VehicleImageController::class, 'store'])
            ->name('vehicles.images.store');

        Route::delete('/vehicles/{vehicle}/images/{image}', [VehicleImageController::class, 'destroy'])
            ->name('vehicles.images.destroy');

        Route::patch('/vehicles/{vehicle}/images/{image}/primary', [VehicleImageController::class, 'setPrimary'])
            ->name('vehicles.images.primary');

        // --- MANAJEMEN PELANGGAN (CUSTOMERS) ---
        Route::get('/customers', [CustomerController::class, 'index'])
            ->name('customers.index');

        Route::get('/customers/create', [CustomerController::class, 'create'])
            ->name('customers.create');

        Route::post('/customers', [CustomerController::class, 'store'])
            ->name('customers.store');

        Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
            ->name('customers.edit');

        Route::put('/customers/{customer}', [CustomerController::class, 'update'])
            ->name('customers.update');

        Route::get('/customers/{customer}', [CustomerController::class, 'show'])
            ->name('customers.show');

        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
            ->name('customers.destroy');

        // --- TRANSAKSI PENJUALAN (SALES) ---
        Route::get('/sales', [SaleController::class, 'index'])
            ->name('sales.index');

        Route::get('/sales/create', [SaleController::class, 'create'])
            ->name('sales.create');

        Route::post('/sales', [SaleController::class, 'store'])
            ->name('sales.store');

        Route::get('/sales/{sale}/edit', [SaleController::class, 'edit'])
            ->name('sales.edit');

        Route::get('/sales/{sale}', [SaleController::class, 'show'])
            ->name('sales.show');

        Route::put('/sales/{sale}', [SaleController::class, 'update'])
            ->name('sales.update');

        Route::patch('/sales/{sale}/cancel', [SaleController::class, 'cancel'])
            ->name('sales.cancel');

        // --- LAPORAN (REPORTS) ---
        Route::get('/reports', [ReportController::class, 'sales'])
            ->name('reports.sales');

        Route::get('/reports/sales/export', [ReportController::class, 'exportSales'])
            ->name('reports.sales.export');
    });

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
| Route default dari Laravel Breeze untuk Login, Register, Logout, dll.
*/
require __DIR__ . '/auth.php';