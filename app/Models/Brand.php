<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Master Data Merek / Brand Kendaraan (Contoh: Toyota, Honda, Yamaha).
 */
class Brand extends Model
{
    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi ke Daftar Model dari Brand Ini (Contoh: Toyota -> Avanza, Innova).
     */
    public function vehicleModels(): HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }

    /**
     * Relasi ke Seluruh Kendaraan Ber-merek Ini.
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}