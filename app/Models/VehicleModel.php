<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Master Data Model Kendaraan.
 *
 * Contoh entitas: Avanza (Brand: Toyota), Brio (Brand: Honda), NMAX (Brand: Yamaha).
 *
 * @property int $id
 * @property int $brand_id ID merek induk kendaraan
 * @property string $name Nama model kendaraan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Brand $brand Merek induk model ini
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vehicle> $vehicles Seluruh unit kendaraan bertipe model ini
 */
class VehicleModel extends Model
{
    /**
     * Kolom tabel yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'name',
    ];

    /**
     * Relasi Many-to-One: Setiap model kendaraan menginduk pada satu Brand.
     *
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relasi One-to-Many: Setiap model terhubung ke semua unit inventaris kendaraan dengan model ini.
     *
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'model_id');
    }
}