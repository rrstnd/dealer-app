<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Galeri Dokumentasi Foto Unit Kendaraan (Vehicle Images).
 *
 * Mengelola path berkas foto pada disk storage, status foto utama (is_primary),
 * serta urutan tampilan foto galeri (sort_order).
 *
 * @property int $id
 * @property int $vehicle_id ID referensi unit kendaraan pemilik foto
 * @property string $image_path Lokasi penyimpanan berkas di disk storage public (contoh: vehicles/abc.jpg)
 * @property bool $is_primary Penanda apakah foto ini dijadikan foto utama / thumbnail sampul
 * @property int $sort_order Urutan urut tampilan foto galeri (dimulai dari 0)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Vehicle $vehicle Unit kendaraan pemilik foto ini
 */
class VehicleImage extends Model
{
    /**
     * Kolom tabel yang dapat diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vehicle_id',
        'image_path',
        'is_primary',
        'sort_order',
    ];

    /**
     * Konversi tipe data otomatis (Type Casting).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Relasi Many-to-One: Setiap foto dimiliki oleh tepat 1 unit Kendaraan (Vehicle).
     *
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}