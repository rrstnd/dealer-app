<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Master Data Jenis / Tipe Kendaraan.
 *
 * Contoh entitas: Mobil (roda empat), Motor (roda dua).
 *
 * @property int $id
 * @property string $name Nama tipe (Mobil, Motor, dll.)
 * @property string|null $description Keterangan jenis kendaraan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vehicle> $vehicles Seluruh unit kendaraan berjenis ini
 */
class VehicleType extends Model
{
    /**
     * Kolom tabel yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi One-to-Many: Setiap tipe kendaraan terhubung ke seluruh unit kendaraan yang bertipe ini.
     *
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}