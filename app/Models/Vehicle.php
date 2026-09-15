<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model Data Utama Kendaraan (Mobil & Motor).
 * Mengelola informasi atribut fisik, spesifikasi teknis, harga, status inventaris, dan galeri foto.
 */
class Vehicle extends Model
{
    /**
     * Kolom tabel yang dapat diisi secara massal (Mass Assignment).
     */
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

    /**
     * Relasi ke Tipe Kendaraan (Mobil / Motor).
     */
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
     * Relasi ke Merek / Brand (Toyota, Honda, Yamaha, dll.).
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relasi ke Model Kendaraan (Avanza, Brio, NMAX, dll.).
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    /**
     * Relasi ke Galeri Foto Kendaraan (Banyak Foto).
     */
    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class)->orderBy('sort_order');
    }

    /**
     * Relasi ke Foto Utama Kendaraan (1 Foto Primary).
     */
    public function primaryImage(): HasOne
    {
        return $this->hasOne(VehicleImage::class)->where('is_primary', true);
    }
}

