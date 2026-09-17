<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model Data Utama Kendaraan (Mobil & Motor).
 *
 * Mengelola informasi atribut fisik, spesifikasi teknis, legalitas (BPKB/STNK/Plat),
 * harga beli/jual, status ketersediaan inventaris showroom, dan galeri dokumentasi foto unit.
 *
 * @property int $id
 * @property string $stock_code Kode unik unit inventaris (contoh: STK-0001)
 * @property int $vehicle_type_id ID jenis kendaraan (Mobil/Motor)
 * @property int $brand_id ID merek kendaraan (Toyota, Honda, dll.)
 * @property int $model_id ID model spesifik (Avanza, Civic, dll.)
 * @property string|null $variant Varian / tipe trim (contoh: 1.5 Veloz Q CVT)
 * @property int $year Tahun pembuatan unit kendaraan
 * @property string|null $color Warna bodi kendaraan
 * @property string|null $transmission Jenis transmisi (Automatic / Manual / CVT)
 * @property string|null $fuel_type Bahan bakar (Bensin / Diesel / Hybrid / Listrik)
 * @property int|null $engine_capacity Kapasitas mesin dalam satuan CC (contoh: 1500)
 * @property int|null $mileage Jarak tempuh odometer dalam kilometer (contoh: 45000)
 * @property string|null $license_plate Nomor polisi / plat nomor kendaraan
 * @property string|null $chassis_number Nomor rangka kendaraan (VIN)
 * @property string|null $engine_number Nomor mesin kendaraan
 * @property int|null $registration_year Tahun registrasi / pajak STNK
 * @property float $purchase_price Harga beli / modal perolehan unit
 * @property float $selling_price Harga jual yang ditawarkan ke konsumen
 * @property string $status Status unit: AVAILABLE, RESERVED, SOLD, SERVICE, INACTIVE
 * @property string|null $description Deskripsi kelengkapan atau catatan kondisi unit
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\VehicleType $vehicleType Tipe kendaraan (Mobil / Motor)
 * @property-read \App\Models\Brand $brand Merek kendaraan
 * @property-read \App\Models\VehicleModel $model Model kendaraan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VehicleImage> $images Seluruh foto galeri kendaraan
 * @property-read \App\Models\VehicleImage|null $primaryImage Foto sampul / utama kendaraan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sale> $sales Riwayat transaksi unit ini
 */
class Vehicle extends Model
{
    /**
     * Definisi konstanta status unit inventaris showroom:
     */
    public const STATUS_AVAILABLE = 'AVAILABLE';  // Siap dijual di website publik & showroom
    public const STATUS_RESERVED  = 'RESERVED';   // Sedang di-booking / tanda jadi oleh pelanggan
    public const STATUS_SOLD      = 'SOLD';       // Sudah terjual lunas
    public const STATUS_SERVICE   = 'SERVICE';    // Sedang perbaikan / salon / inspeksi teknis
    public const STATUS_INACTIVE  = 'INACTIVE';   // Dinonaktifkan dari listing (tidak tampil di publik)

    /**
     * Kolom tabel yang dapat diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
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
     * Konversi tipe data otomatis (Type Casting).
     *
     * @var array<string, string>
     */
    protected $casts = [
        'year'              => 'integer',
        'engine_capacity'   => 'integer',
        'mileage'           => 'integer',
        'registration_year' => 'integer',
        'purchase_price'    => 'decimal:2',
        'selling_price'     => 'decimal:2',
    ];

    /**
     * Relasi Many-to-One: Setiap kendaraan memiliki 1 tipe kendaraan (Mobil / Motor).
     *
     * @return BelongsTo
     */
    public function vehicleType(): BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }

    /**
     * Relasi Many-to-One: Setiap kendaraan berinduk pada 1 Merek / Brand (Toyota, Honda, dll.).
     *
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relasi Many-to-One: Setiap kendaraan berinduk pada 1 Model Kendaraan (Avanza, Brio, dll.).
     *
     * @return BelongsTo
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    /**
     * Relasi One-to-Many: Setiap kendaraan dapat memiliki banyak foto galeri.
     * Diurutkan berdasarkan kolom 'sort_order' secara menaik.
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class)->orderBy('sort_order');
    }

    /**
     * Relasi One-to-One: Foto utama / thumbnail sampul yang ditampilkan pada katalog website.
     *
     * @return HasOne
     */
    public function primaryImage(): HasOne
    {
        return $this->hasOne(VehicleImage::class)->where('is_primary', true);
    }

    /**
     * Relasi One-to-Many: Riwayat transaksi penjualan yang melibatkan kendaraan ini.
     *
     * @return HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
