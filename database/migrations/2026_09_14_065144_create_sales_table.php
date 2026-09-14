<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->string('invoice_number', 50)->unique();

            $table->foreignId('customer_id')
                ->constrained('customers')
                ->restrictOnDelete();

            $table->foreignId('vehicle_id')
                ->constrained('vehicles')
                ->restrictOnDelete();

            $table->decimal('vehicle_price', 15, 2);

            $table->decimal('discount', 15, 2)
                ->default(0);

            $table->decimal('final_price', 15, 2);

            $table->date('sale_date');

            $table->string('sales_person', 100)
                ->nullable();

            $table->enum('status', [
                'DRAFT',
                'BOOKED',
                'COMPLETED',
                'CANCELLED',
            ])->default('DRAFT');

            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};