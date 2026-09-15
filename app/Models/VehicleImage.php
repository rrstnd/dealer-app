<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Galeri Foto Kendaraan.
 */
class VehicleImage extends Model
{
    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'vehicle_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    /**
     * Casting tipe data kolom database.
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Relasi Kembali ke Unit Kendaraan.
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}