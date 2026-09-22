<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleMovement extends Model
{
    protected $fillable = [
        'vehicle_id',
        'type',
        'movement_date',
        'reference',
        'notes',
    ];

    protected $casts = [
        'movement_date' => 'date',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}