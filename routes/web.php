<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\VehicleImageController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\VehicleController as WebsiteVehicleController;


/*
|--------------------------------------------------------------------------
| Website Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/vehicles', [WebsiteVehicleController::class, 'index'])
    ->name('vehicles.index');

Route::get('/vehicles/{vehicle}', [WebsiteVehicleController::class, 'show'])
    ->name('vehicles.show');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Vehicles
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


    // Vehicle Images
    Route::post('/vehicles/{vehicle}/images', [VehicleImageController::class, 'store'])
        ->name('vehicles.images.store');

    Route::delete('/vehicles/{vehicle}/images/{image}', [VehicleImageController::class, 'destroy'])
        ->name('vehicles.images.destroy');

    Route::patch('/vehicles/{vehicle}/images/{image}/primary', [VehicleImageController::class, 'setPrimary'])
        ->name('vehicles.images.primary');


    // Customers
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

    // Sales
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
});