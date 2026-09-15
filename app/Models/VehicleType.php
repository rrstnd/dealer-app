<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Master Data Tipe Kendaraan (Contoh: Mobil, Motor).
 */
class VehicleType extends Model
{
    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi ke Seluruh Kendaraan Ber-tipe Ini.
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}