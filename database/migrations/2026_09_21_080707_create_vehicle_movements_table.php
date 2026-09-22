<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vehicle_id')
                ->constrained('vehicles')
                ->cascadeOnDelete();

            $table->enum('type', ['IN', 'OUT']);

            $table->date('movement_date');

            $table->string('reference')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index(['type', 'movement_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_movements');
    }
};