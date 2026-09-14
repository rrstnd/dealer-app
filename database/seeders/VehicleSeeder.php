<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\VehicleType;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // =========================
        // JENIS KENDARAAN
        // =========================

        $mobil = VehicleType::firstOrCreate([
            'name' => 'Mobil',
        ]);

        $motor = VehicleType::firstOrCreate([
            'name' => 'Motor',
        ]);

        // =========================
        // BRAND
        // =========================

        $toyota = Brand::firstOrCreate([
            'name' => 'Toyota',
        ]);

        $honda = Brand::firstOrCreate([
            'name' => 'Honda',
        ]);

        $yamaha = Brand::firstOrCreate([
            'name' => 'Yamaha',
        ]);

        $suzuki = Brand::firstOrCreate([
            'name' => 'Suzuki',
        ]);

        // =========================
        // MODEL
        // =========================

        $avanza = VehicleModel::firstOrCreate([
            'brand_id' => $toyota->id,
            'name' => 'Avanza',
        ]);

        $brio = VehicleModel::firstOrCreate([
            'brand_id' => $honda->id,
            'name' => 'Brio',
        ]);

        $nmax = VehicleModel::firstOrCreate([
            'brand_id' => $yamaha->id,
            'name' => 'NMAX',
        ]);

        $ertiga = VehicleModel::firstOrCreate([
            'brand_id' => $suzuki->id,
            'name' => 'Ertiga',
        ]);

        // =========================
        // KENDARAAN DUMMY
        // =========================

        Vehicle::firstOrCreate(
            [
                'stock_code' => 'MOB-001',
            ],
            [
                'vehicle_type_id' => $mobil->id,
                'brand_id' => $toyota->id,
                'model_id' => $avanza->id,
                'variant' => '1.5 G',
                'year' => 2022,
                'color' => 'Hitam',
                'transmission' => 'Automatic',
                'fuel_type' => 'Bensin',
                'engine_capacity' => 1500,
                'mileage' => 45000,
                'license_plate' => 'B 1234 XYZ',
                'registration_year' => 2022,
                'purchase_price' => 165000000,
                'selling_price' => 185000000,
                'status' => 'AVAILABLE',
                'description' => 'Toyota Avanza 1.5 G kondisi baik, siap digunakan.',
            ]
        );

        Vehicle::firstOrCreate(
            [
                'stock_code' => 'MOB-002',
            ],
            [
                'vehicle_type_id' => $mobil->id,
                'brand_id' => $honda->id,
                'model_id' => $brio->id,
                'variant' => '1.2 E',
                'year' => 2021,
                'color' => 'Putih',
                'transmission' => 'Manual',
                'fuel_type' => 'Bensin',
                'engine_capacity' => 1200,
                'mileage' => 38000,
                'license_plate' => 'B 5678 ABC',
                'registration_year' => 2021,
                'purchase_price' => 145000000,
                'selling_price' => 165000000,
                'status' => 'AVAILABLE',
                'description' => 'Honda Brio 1.2 E, irit dan cocok untuk penggunaan harian.',
            ]
        );

        Vehicle::firstOrCreate(
            [
                'stock_code' => 'MTR-001',
            ],
            [
                'vehicle_type_id' => $motor->id,
                'brand_id' => $yamaha->id,
                'model_id' => $nmax->id,
                'variant' => 'ABS',
                'year' => 2023,
                'color' => 'Matte Black',
                'transmission' => 'Automatic',
                'fuel_type' => 'Bensin',
                'engine_capacity' => 155,
                'mileage' => 12000,
                'license_plate' => 'B 9876 DEF',
                'registration_year' => 2023,
                'purchase_price' => 24000000,
                'selling_price' => 28000000,
                'status' => 'AVAILABLE',
                'description' => 'Yamaha NMAX ABS tahun 2023, kondisi terawat.',
            ]
        );

        Vehicle::firstOrCreate(
            [
                'stock_code' => 'MOB-003',
            ],
            [
                'vehicle_type_id' => $mobil->id,
                'brand_id' => $suzuki->id,
                'model_id' => $ertiga->id,
                'variant' => 'GX',
                'year' => 2020,
                'color' => 'Silver',
                'transmission' => 'Manual',
                'fuel_type' => 'Bensin',
                'engine_capacity' => 1500,
                'mileage' => 55000,
                'license_plate' => 'B 2468 GHI',
                'registration_year' => 2020,
                'purchase_price' => 130000000,
                'selling_price' => 150000000,
                'status' => 'AVAILABLE',
                'description' => 'Suzuki Ertiga GX, nyaman untuk keluarga.',
            ]
        );
    }
}