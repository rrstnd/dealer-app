<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    protected $fillable = [
        'stock_code',
        'vehicle_type_id',
        'brand_id',
        'model_id',
        'variant',
        'year',
        'color',
        'transmission',
        'fuel_type',
        'engine_capacity',
        'mileage',
        'license_plate',
        'chassis_number',
        'engine_number',
        'registration_year',
        'purchase_price',
        'selling_price',
        'status',
        'description',
    ];

    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function model(): BelongsTo
    {
        return $this->belongsTo(
            VehicleModel::class,
            'model_id'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class)
            ->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(VehicleImage::class)
            ->where('is_primary', true);
    }
}
