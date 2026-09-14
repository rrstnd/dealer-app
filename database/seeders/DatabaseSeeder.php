<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Vehicle Types
        |--------------------------------------------------------------------------
        */

        $carType = DB::table('vehicle_types')->insertGetId([
            'name' => 'Mobil',
            'description' => 'Kendaraan roda empat',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $motorcycleType = DB::table('vehicle_types')->insertGetId([
            'name' => 'Motor',
            'description' => 'Kendaraan roda dua',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Brands
        |--------------------------------------------------------------------------
        */

        $toyota = DB::table('brands')->insertGetId([
            'name' => 'Toyota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $honda = DB::table('brands')->insertGetId([
            'name' => 'Honda',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $suzuki = DB::table('brands')->insertGetId([
            'name' => 'Suzuki',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $yamaha = DB::table('brands')->insertGetId([
            'name' => 'Yamaha',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Vehicle Models
        |--------------------------------------------------------------------------
        */

        $avanza = DB::table('vehicle_models')->insertGetId([
            'brand_id' => $toyota,
            'name' => 'Avanza',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $innova = DB::table('vehicle_models')->insertGetId([
            'brand_id' => $toyota,
            'name' => 'Innova',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $brio = DB::table('vehicle_models')->insertGetId([
            'brand_id' => $honda,
            'name' => 'Brio',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $city = DB::table('vehicle_models')->insertGetId([
            'brand_id' => $honda,
            'name' => 'City',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $ertiga = DB::table('vehicle_models')->insertGetId([
            'brand_id' => $suzuki,
            'name' => 'Ertiga',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $nmax = DB::table('vehicle_models')->insertGetId([
            'brand_id' => $yamaha,
            'name' => 'NMAX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        $customer1 = DB::table('customers')->insertGetId([
            'customer_code' => 'CUS-0001',
            'name' => 'Andi Pratama',
            'nik' => '3171000000000001',
            'phone' => '081234567890',
            'email' => 'andi@example.com',
            'address' => 'Jl. Contoh No. 1',
            'city' => 'Jakarta Selatan',
            'province' => 'DKI Jakarta',
            'notes' => 'Customer demo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $customer2 = DB::table('customers')->insertGetId([
            'customer_code' => 'CUS-0002',
            'name' => 'Budi Santoso',
            'nik' => '3171000000000002',
            'phone' => '081298765432',
            'email' => 'budi@example.com',
            'address' => 'Jl. Contoh No. 2',
            'city' => 'Tangerang Selatan',
            'province' => 'Banten',
            'notes' => 'Customer demo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Vehicles
        |--------------------------------------------------------------------------
        */

        $vehicles = [];

        $vehicles[] = [
            'stock_code' => 'STK-AVZ-001',
            'vehicle_type_id' => $carType,
            'brand_id' => $toyota,
            'model_id' => $avanza,
            'variant' => '1.5 G',
            'year' => 2023,
            'color' => 'Hitam',
            'transmission' => 'AT',
            'fuel_type' => 'Bensin',
            'engine_capacity' => 1500,
            'mileage' => 25000,
            'license_plate' => 'B 1234 ABC',
            'chassis_number' => 'DEMOCHASSIS0001',
            'engine_number' => 'DEMOENGINE0001',
            'registration_year' => 2023,
            'purchase_price' => 185000000,
            'selling_price' => 215000000,
            'status' => 'AVAILABLE',
            'description' => 'Toyota Avanza kondisi bagus, siap digunakan.',
        ];

        $vehicles[] = [
            'stock_code' => 'STK-BRIO-001',
            'vehicle_type_id' => $carType,
            'brand_id' => $honda,
            'model_id' => $brio,
            'variant' => '1.2 E',
            'year' => 2022,
            'color' => 'Putih',
            'transmission' => 'MT',
            'fuel_type' => 'Bensin',
            'engine_capacity' => 1200,
            'mileage' => 32000,
            'license_plate' => 'B 2345 DEF',
            'chassis_number' => 'DEMOCHASSIS0002',
            'engine_number' => 'DEMOENGINE0002',
            'registration_year' => 2022,
            'purchase_price' => 125000000,
            'selling_price' => 145000000,
            'status' => 'AVAILABLE',
            'description' => 'Honda Brio irit dan cocok untuk penggunaan harian.',
        ];

        $vehicles[] = [
            'stock_code' => 'STK-INNOVA-001',
            'vehicle_type_id' => $carType,
            'brand_id' => $toyota,
            'model_id' => $innova,
            'variant' => '2.0 G',
            'year' => 2021,
            'color' => 'Silver',
            'transmission' => 'AT',
            'fuel_type' => 'Bensin',
            'engine_capacity' => 2000,
            'mileage' => 45000,
            'license_plate' => 'B 3456 GHI',
            'chassis_number' => 'DEMOCHASSIS0003',
            'engine_number' => 'DEMOENGINE0003',
            'registration_year' => 2021,
            'purchase_price' => 290000000,
            'selling_price' => 325000000,
            'status' => 'AVAILABLE',
            'description' => 'Toyota Innova nyaman untuk keluarga.',
        ];

        $vehicles[] = [
            'stock_code' => 'STK-ERTIGA-001',
            'vehicle_type_id' => $carType,
            'brand_id' => $suzuki,
            'model_id' => $ertiga,
            'variant' => 'GX',
            'year' => 2020,
            'color' => 'Abu-abu',
            'transmission' => 'AT',
            'fuel_type' => 'Bensin',
            'engine_capacity' => 1500,
            'mileage' => 52000,
            'license_plate' => 'B 4567 JKL',
            'chassis_number' => 'DEMOCHASSIS0004',
            'engine_number' => 'DEMOENGINE0004',
            'registration_year' => 2020,
            'purchase_price' => 150000000,
            'selling_price' => 175000000,
            'status' => 'AVAILABLE',
            'description' => 'Suzuki Ertiga keluarga dengan kondisi terawat.',
        ];

        $vehicles[] = [
            'stock_code' => 'STK-CITY-001',
            'vehicle_type_id' => $carType,
            'brand_id' => $honda,
            'model_id' => $city,
            'variant' => 'V',
            'year' => 2022,
            'color' => 'Merah',
            'transmission' => 'CVT',
            'fuel_type' => 'Bensin',
            'engine_capacity' => 1500,
            'mileage' => 28000,
            'license_plate' => 'B 5678 MNO',
            'chassis_number' => 'DEMOCHASSIS0005',
            'engine_number' => 'DEMOENGINE0005',
            'registration_year' => 2022,
            'purchase_price' => 270000000,
            'selling_price' => 305000000,
            'status' => 'SOLD',
            'description' => 'Honda City demo dengan kondisi sangat baik.',
        ];

        $vehicles[] = [
            'stock_code' => 'STK-NMAX-001',
            'vehicle_type_id' => $motorcycleType,
            'brand_id' => $yamaha,
            'model_id' => $nmax,
            'variant' => 'ABS',
            'year' => 2023,
            'color' => 'Hitam',
            'transmission' => 'Automatic',
            'fuel_type' => 'Bensin',
            'engine_capacity' => 155,
            'mileage' => 12000,
            'license_plate' => 'B 6789 PQR',
            'chassis_number' => 'DEMOCHASSIS0006',
            'engine_number' => 'DEMOENGINE0006',
            'registration_year' => 2023,
            'purchase_price' => 28000000,
            'selling_price' => 33000000,
            'status' => 'AVAILABLE',
            'description' => 'Yamaha NMAX ABS kondisi terawat.',
        ];

        $vehicleIds = [];

        foreach ($vehicles as $vehicle) {
            $vehicle['created_at'] = now();
            $vehicle['updated_at'] = now();

            $vehicleIds[] = DB::table('vehicles')->insertGetId($vehicle);
        }

        /*
        |--------------------------------------------------------------------------
        | Vehicle Images
        |--------------------------------------------------------------------------
        */

        $imageFiles = [
            'vehicles/demo-avanza.svg',
            'vehicles/demo-brio.svg',
            'vehicles/demo-innova.svg',
            'vehicles/demo-ertiga.svg',
            'vehicles/demo-city.svg',
            'vehicles/demo-nmax.svg',
        ];

        foreach ($vehicleIds as $index => $vehicleId) {
            DB::table('vehicle_images')->insert([
                'vehicle_id' => $vehicleId,
                'image_path' => $imageFiles[$index],
                'is_primary' => true,
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Sales
        |--------------------------------------------------------------------------
        */

        $cityVehicleId = $vehicleIds[4];

        DB::table('sales')->insert([
            'invoice_number' => 'INV-2026-0001',
            'customer_id' => $customer1,
            'vehicle_id' => $cityVehicleId,
            'vehicle_price' => 305000000,
            'discount' => 5000000,
            'final_price' => 300000000,
            'sale_date' => now()->toDateString(),
            'sales_person' => 'Admin Demo',
            'status' => 'COMPLETED',
            'notes' => 'Data transaksi demo.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}