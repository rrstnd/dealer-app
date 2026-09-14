<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleImageController;

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

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

Route::post('/vehicles/{vehicle}/images', [VehicleImageController::class, 'store'])
    ->name('vehicles.images.store');

Route::delete('/vehicles/{vehicle}/images/{image}', [VehicleImageController::class, 'destroy'])
    ->name('vehicles.images.destroy');

Route::patch('/vehicles/{vehicle}/images/{image}/primary', [VehicleImageController::class, 'setPrimary'])
    ->name('vehicles.images.primary');