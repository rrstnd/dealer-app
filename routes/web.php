<?php

use Illuminate\Support\Facades\Route;

// Controller Website Publik (Akses Bebas Pengunjung)
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\VehicleController as WebsiteVehicleController;

// Controller Panel Administrasi (Akses Pengelola / Staf)
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
| WEBSITE / PUBLIC ROUTES (RUTE PUBLIK)
|--------------------------------------------------------------------------
| Rute yang dapat diakses secara bebas oleh pengunjung umum website.
| Tidak memerlukan proses autentikasi (login).
*/

// Halaman Utama / Landing Page Showcase Showroom
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Penelusuran Katalog Kendaraan (Daftar Unit, Pencarian Kata Kunci, Multi-Filter, Sorting)
Route::get('/vehicles', [WebsiteVehicleController::class, 'index'])
    ->name('vehicles.index');

// Halaman Detail & Galeri Spesifikasi Unit Kendaraan
Route::get('/vehicles/{vehicle}', [WebsiteVehicleController::class, 'show'])
    ->name('vehicles.show');


/*
|--------------------------------------------------------------------------
| ADMIN PORTAL ROUTES (PANEL ADMINISTRASI)
|--------------------------------------------------------------------------
| Rute untuk pengelolaan data showroom Suja Mobilindo.
| Wajib melewati middleware 'auth' (harus login terlebih dahulu sebagai admin/staf).
| Seluruh URL diawali dengan prefix '/admin' dan nama rute diawali dengan 'admin.'.
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

        // ==========================================
        // 1. DASHBOARD RINGKASAN EKSEKUTIF
        // ==========================================
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // ==========================================
        // 2. MANAJEMEN INVENTARIS KENDARAAN (VEHICLES)
        // ==========================================
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

        // ==========================================
        // 3. ENDPOINT AJAX MASTER DATA (SEARCH & MODAL QUICK-CREATE)
        // ==========================================
        // Autocomplete & Quick-Create Tipe Kendaraan
        Route::get('/vehicle-types/search', [VehicleTypeController::class, 'search'])
            ->name('vehicle-types.search');

        Route::post('/vehicle-types', [VehicleTypeController::class, 'store'])
            ->name('vehicle-types.store');

        // Autocomplete & Quick-Create Brand / Merek
        Route::get('/brands/search', [BrandController::class, 'search'])
            ->name('brands.search');

        Route::post('/brands', [BrandController::class, 'store'])
            ->name('brands.store');

        // Autocomplete & Quick-Create Model Kendaraan
        Route::get('/vehicle-models/search', [VehicleModelController::class, 'search'])
            ->name('vehicle-models.search');

        Route::post('/vehicle-models', [VehicleModelController::class, 'store'])
            ->name('vehicle-models.store');

        // ==========================================
        // 4. GALERI DOKUMENTASI FOTO KENDARAAN (VEHICLE IMAGES)
        // ==========================================
        // Upload foto baru ke unit
        Route::post('/vehicles/{vehicle}/images', [VehicleImageController::class, 'store'])
            ->name('vehicles.images.store');

        // Hapus foto dari galeri
        Route::delete('/vehicles/{vehicle}/images/{image}', [VehicleImageController::class, 'destroy'])
            ->name('vehicles.images.destroy');

        // Tetapkan sebagai foto sampul utama (Primary Thumbnail)
        Route::patch('/vehicles/{vehicle}/images/{image}/primary', [VehicleImageController::class, 'setPrimary'])
            ->name('vehicles.images.primary');

        // ==========================================
        // 5. MANAJEMEN DATA PELANGGAN (CUSTOMERS)
        // ==========================================
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

        // ==========================================
        // 6. TRANSAKSI PENJUALAN UNIT (SALES)
        // ==========================================
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

        // ==========================================
        // 7. LAPORAN & EKSPOR DATA KEUANGAN (REPORTS)
        // ==========================================
        Route::get('/reports', [ReportController::class, 'sales'])
            ->name('reports.sales');

        Route::get('/reports/sales/export', [ReportController::class, 'exportSales'])
            ->name('reports.sales.export');
    });

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (AUTENTIKASI BREEZE)
|--------------------------------------------------------------------------
| Rute autentikasi standar bawaan Laravel Breeze:
| Login, Register, Forgot Password, Reset Password, Confirm Password, dan Logout.
*/
require __DIR__ . '/auth.php';