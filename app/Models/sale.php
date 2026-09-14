<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'vehicle_id',
        'vehicle_price',
        'discount',
        'final_price',
        'sale_date',
        'sales_person',
        'status',
        'notes',
    ];

    protected $casts = [
        'sale_date' => 'date',
        'vehicle_price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}