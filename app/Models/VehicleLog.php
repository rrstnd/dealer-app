<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'vehicle_id',
        'stock_code',
        'vehicle_name',
        'license_plate',
        'price',
        'user_name',
        'action_at',
        'notes',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'action_at' => 'datetime',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}
