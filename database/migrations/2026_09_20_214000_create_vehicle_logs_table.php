<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_logs', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['IN', 'OUT'])->default('IN');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->string('stock_code');
            $table->string('vehicle_name');
            $table->string('license_plate')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->string('user_name')->nullable();
            $table->timestamp('action_at')->useCurrent();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        // Populate historical IN logs for existing vehicles
        $vehicles = DB::table('vehicles')
            ->leftJoin('brands', 'vehicles.brand_id', '=', 'brands.id')
            ->leftJoin('vehicle_models', 'vehicles.model_id', '=', 'vehicle_models.id')
            ->select(
                'vehicles.id',
                'vehicles.stock_code',
                'vehicles.year',
                'vehicles.license_plate',
                'vehicles.selling_price',
                'vehicles.created_at',
                'brands.name as brand_name',
                'vehicle_models.name as model_name'
            )
            ->get();

        foreach ($vehicles as $vehicle) {
            $name = trim(($vehicle->brand_name ?? '') . ' ' . ($vehicle->model_name ?? '') . ' ' . $vehicle->year);
            DB::table('vehicle_logs')->insert([
                'type'          => 'IN',
                'vehicle_id'    => $vehicle->id,
                'stock_code'    => $vehicle->stock_code,
                'vehicle_name'  => $name ?: 'Kendaraan ' . $vehicle->stock_code,
                'license_plate' => $vehicle->license_plate,
                'price'         => $vehicle->selling_price,
                'user_name'     => 'System Admin',
                'action_at'     => $vehicle->created_at ?: now(),
                'notes'         => 'Kendaraan ditambahkan ke website.',
                'created_at'    => $vehicle->created_at ?: now(),
                'updated_at'    => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_logs');
    }
};
