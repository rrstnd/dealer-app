<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('stock_code', 30)->unique();

            $table->foreignId('vehicle_type_id')
                ->constrained('vehicle_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('brand_id')
                ->constrained('brands')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('model_id')
                ->constrained('vehicle_models')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('variant', 100)->nullable();
            $table->unsignedSmallInteger('year');
            $table->string('color', 50)->nullable();
            $table->string('transmission', 20)->nullable();
            $table->string('fuel_type', 20)->nullable();
            $table->unsignedSmallInteger('engine_capacity')->nullable();
            $table->unsignedInteger('mileage')->nullable();
            $table->string('license_plate', 15)->nullable();
            $table->string('chassis_number', 50)->nullable()->unique();
            $table->string('engine_number', 50)->nullable()->unique();
            $table->unsignedSmallInteger('registration_year')->nullable();

            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->decimal('selling_price', 15, 2)->default(0);

            $table->string('status', 20)->default('AVAILABLE');
            $table->text('description')->nullable();

            $table->timestamps();

            $table->index('status');
            $table->index('year');
            $table->index('selling_price');
            $table->index('license_plate');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};