<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Master Data Merek / Brand Kendaraan.
 *
 * Contoh entitas: Toyota, Honda, Daihatsu, Suzuki, Mitsubishi, Yamaha, Kawasaki.
 *
 * @property int $id
 * @property string $name Nama merek / pabrikan kendaraan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VehicleModel> $vehicleModels Daftar model keluaran brand ini
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vehicle> $vehicles Seluruh unit kendaraan ber-merek ini
 */
class Brand extends Model
{
    /**
     * Kolom tabel yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Relasi One-to-Many: Satu merek memayungi banyak tipe model (contoh: Toyota -> Avanza, Innova, Fortuner).
     *
     * @return HasMany
     */
    public function vehicleModels(): HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }

    /**
     * Relasi One-to-Many: Satu merek terhubung ke semua unit inventaris kendaraan dengan merek ini.
     *
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}