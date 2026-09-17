<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Seeder Utama Database Dealer App (Suja Mobilindo).
 *
 * Menyiapkan basis data awal yang lengkap untuk kebutuhan pengembangan dan demonstrasi:
 * 1. Akun Pengguna Administrator Utama (admin@dealer.com)
 * 2. Master Data Jenis Kendaraan (Mobil, Motor)
 * 3. Master Data Brand / Merek Populer (Toyota, Honda, Suzuki, Yamaha)
 * 4. Master Data Model Spesifik (Avanza, Innova, Brio, City, Ertiga, NMAX)
 * 5. Data Sampel Pelanggan / Konsumen
 * 6. Data Sampel Inventaris Unit Kendaraan Siap Jual
 * 7. Galeri Foto Sampel Kendaraan
 * 8. Riwayat Transaksi Penjualan Selesai (Invoice COMPLETED)
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan proses seeding ke seluruh tabel database.
     *
     * @return void
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. AKUN ADMINISTRATOR DEFAULT (BREEZE AUTH)
        |--------------------------------------------------------------------------
        | Akun login default untuk pengujian panel admin:
        | Email: admin@dealer.com
        | Password: password
        */
        User::firstOrCreate(
            ['email' => 'admin@dealer.com'],
            [
                'name'              => 'Administrator Suja',
                'password'          => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 2. MASTER DATA TIPE KENDARAAN (VEHICLE TYPES)
        |--------------------------------------------------------------------------
        */
        $carType = DB::table('vehicle_types')->insertGetId([
            'name'        => 'Mobil',
            'description' => 'Kendaraan roda empat',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $motorcycleType = DB::table('vehicle_types')->insertGetId([
            'name'        => 'Motor',
            'description' => 'Kendaraan roda dua',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. MASTER DATA MEREK (BRANDS)
        |--------------------------------------------------------------------------
        */
        $toyota = DB::table('brands')->insertGetId([
            'name'       => 'Toyota',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $honda = DB::table('brands')->insertGetId([
            'name'       => 'Honda',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $suzuki = DB::table('brands')->insertGetId([
            'name'       => 'Suzuki',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $yamaha = DB::table('brands')->insertGetId([
            'name'       => 'Yamaha',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | 4. MASTER DATA MODEL KENDARAAN (VEHICLE MODELS)
        |--------------------------------------------------------------------------
        */
        $avanza = DB::table('vehicle_models')->insertGetId([
            'brand_id'   => $toyota,
            'name'       => 'Avanza',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $innova = DB::table('vehicle_models')->insertGetId([
            'brand_id'   => $toyota,
            'name'       => 'Innova',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $brio = DB::table('vehicle_models')->insertGetId([
            'brand_id'   => $honda,
            'name'       => 'Brio',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $city = DB::table('vehicle_models')->insertGetId([
            'brand_id'   => $honda,
            'name'       => 'City',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $ertiga = DB::table('vehicle_models')->insertGetId([
            'brand_id'   => $suzuki,
            'name'       => 'Ertiga',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $nmax = DB::table('vehicle_models')->insertGetId([
            'brand_id'   => $yamaha,
            'name'       => 'NMAX',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | 5. DATA SAMPEL PELANGGAN (CUSTOMERS)
        |--------------------------------------------------------------------------
        */
        $customer1 = DB::table('customers')->insertGetId([
            'customer_code' => 'CUS-0001',
            'name'          => 'Andi Pratama',
            'nik'           => '3171000000000001',
            'phone'         => '081234567890',
            'email'         => 'andi@example.com',
            'address'       => 'Jl. Contoh No. 1',
            'city'          => 'Jakarta Selatan',
            'province'      => 'DKI Jakarta',
            'notes'         => 'Pelanggan loyal showroom',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $customer2 = DB::table('customers')->insertGetId([
            'customer_code' => 'CUS-0002',
            'name'          => 'Budi Santoso',
            'nik'           => '3171000000000002',
            'phone'         => '081298765432',
            'email'         => 'budi@example.com',
            'address'       => 'Jl. Contoh No. 2',
            'city'          => 'Tangerang Selatan',
            'province'      => 'Banten',
            'notes'         => 'Pelanggan cash keras',
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | 6. DATA SAMPEL INVENTARIS UNIT KENDARAAN (VEHICLES)
        |--------------------------------------------------------------------------
        */
        $vehicles = [];

        $vehicles[] = [
            'stock_code'        => 'STK-AVZ-001',
            'vehicle_type_id'   => $carType,
            'brand_id'          => $toyota,
            'model_id'          => $avanza,
            'variant'           => '1.5 G',
            'year'              => 2023,
            'color'             => 'Hitam',
            'transmission'      => 'AT',
            'fuel_type'         => 'Bensin',
            'engine_capacity'   => 1500,
            'mileage'           => 25000,
            'license_plate'     => 'B 1234 ABC',
            'chassis_number'    => 'DEMOCHASSIS0001',
            'engine_number'     => 'DEMOENGINE0001',
            'registration_year' => 2023,
            'purchase_price'    => 185000000,
            'selling_price'     => 215000000,
            'status'            => 'AVAILABLE',
            'description'       => 'Toyota Avanza kondisi mulus terawat, service record berkala bengkel resmi.',
        ];

        $vehicles[] = [
            'stock_code'        => 'STK-BRIO-001',
            'vehicle_type_id'   => $carType,
            'brand_id'          => $honda,
            'model_id'          => $brio,
            'variant'           => '1.2 E',
            'year'              => 2022,
            'color'             => 'Putih',
            'transmission'      => 'MT',
            'fuel_type'         => 'Bensin',
            'engine_capacity'   => 1200,
            'mileage'           => 32000,
            'license_plate'     => 'B 2345 DEF',
            'chassis_number'    => 'DEMOCHASSIS0002',
            'engine_number'     => 'DEMOENGINE0002',
            'registration_year' => 2022,
            'purchase_price'    => 125000000,
            'selling_price'     => 145000000,
            'status'            => 'AVAILABLE',
            'description'       => 'Honda Brio irit dan sangat lincah, cocok untuk mobilitas perkotaan.',
        ];

        $vehicles[] = [
            'stock_code'        => 'STK-INNOVA-001',
            'vehicle_type_id'   => $carType,
            'brand_id'          => $toyota,
            'model_id'          => $innova,
            'variant'           => '2.4 V Diesel',
            'year'              => 2021,
            'color'             => 'Abu-abu Metalik',
            'transmission'      => 'AT',
            'fuel_type'         => 'Diesel',
            'engine_capacity'   => 2400,
            'mileage'           => 48000,
            'license_plate'     => 'B 3456 GHI',
            'chassis_number'    => 'DEMOCHASSIS0003',
            'engine_number'     => 'DEMOENGINE0003',
            'registration_year' => 2021,
            'purchase_price'    => 320000000,
            'selling_price'     => 365000000,
            'status'            => 'AVAILABLE',
            'description'       => 'Kijang Innova Reborn Diesel bertenaga dan kabin sangat nyaman.',
        ];

        $vehicles[] = [
            'stock_code'        => 'STK-ERTIGA-001',
            'vehicle_type_id'   => $carType,
            'brand_id'          => $suzuki,
            'model_id'          => $ertiga,
            'variant'           => 'GX',
            'year'              => 2020,
            'color'             => 'Silver Metalik',
            'transmission'      => 'MT',
            'fuel_type'         => 'Bensin',
            'engine_capacity'   => 1500,
            'mileage'           => 55000,
            'license_plate'     => 'B 4567 JKL',
            'chassis_number'    => 'DEMOCHASSIS0004',
            'engine_number'     => 'DEMOENGINE0004',
            'registration_year' => 2020,
            'purchase_price'    => 140000000,
            'selling_price'     => 165000000,
            'status'            => 'AVAILABLE',
            'description'       => 'Suzuki Ertiga GX, suspensi empuk dan hemat BBM untuk keluarga.',
        ];

        $vehicles[] = [
            'stock_code'        => 'STK-CITY-001',
            'vehicle_type_id'   => $carType,
            'brand_id'          => $honda,
            'model_id'          => $city,
            'variant'           => 'Hatchback RS',
            'year'              => 2022,
            'color'             => 'Merah Metalik',
            'transmission'      => 'CVT',
            'fuel_type'         => 'Bensin',
            'engine_capacity'   => 1500,
            'mileage'           => 28000,
            'license_plate'     => 'B 5678 MNO',
            'chassis_number'    => 'DEMOCHASSIS0005',
            'engine_number'     => 'DEMOENGINE0005',
            'registration_year' => 2022,
            'purchase_price'    => 260000000,
            'selling_price'     => 295000000,
            'status'            => 'AVAILABLE',
            'description'       => 'Honda City Hatchback RS sporty dengan fitur ultra seat yang fleksibel.',
        ];

        $vehicles[] = [
            'stock_code'        => 'STK-NMAX-001',
            'vehicle_type_id'   => $motorcycleType,
            'brand_id'          => $yamaha,
            'model_id'          => $nmax,
            'variant'           => 'Connected ABS',
            'year'              => 2023,
            'color'             => 'Matte Black',
            'transmission'      => 'AT',
            'fuel_type'         => 'Bensin',
            'engine_capacity'   => 155,
            'mileage'           => 11000,
            'license_plate'     => 'B 6789 PQR',
            'chassis_number'    => 'DEMOCHASSIS0006',
            'engine_number'     => 'DEMOENGINE0006',
            'registration_year' => 2023,
            'purchase_price'    => 25000000,
            'selling_price'     => 29000000,
            'status'            => 'AVAILABLE',
            'description'       => 'Yamaha NMAX ABS kondisi sangat istimewa, ban tebal dan kunci lengkap.',
        ];

        $vehicleIds = [];

        foreach ($vehicles as $vehicle) {
            $vehicle['created_at'] = now();
            $vehicle['updated_at'] = now();

            $vehicleIds[] = DB::table('vehicles')->insertGetId($vehicle);
        }

        /*
        |--------------------------------------------------------------------------
        | 7. FOTO SAMPUL / GALERI KENDARAAN (VEHICLE IMAGES)
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
        | 8. DATA DUMMY TRANSAKSI PENJUALAN SELESAI (SALES)
        |--------------------------------------------------------------------------
        */
        $cityVehicleId = $vehicleIds[4];

        DB::table('sales')->insert([
            'invoice_number' => 'INV-2026-0001',
            'customer_id'    => $customer1,
            'vehicle_id'     => $cityVehicleId,
            'vehicle_price'  => 305000000,
            'discount'       => 5000000,
            'final_price'    => 300000000,
            'sale_date'      => now()->toDateString(),
            'sales_person'   => 'Admin Demo Suja',
            'status'         => 'COMPLETED',
            'notes'          => 'Data transaksi penjualan sampel awal sistem.',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }
}