<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Data Transaksi Penjualan Unit Kendaraan (Sales).
 *
 * Mengelola seluruh siklus hidup transaksi penjualan unit, nomor invoice, tanggal transaksi,
 * harga kendaraan, potongan harga (diskon), harga bersih (final), serta relasi ke data Pelanggan & Kendaraan.
 *
 * @property int $id
 * @property string $invoice_number Nomor faktur / invoice unik transaksi (contoh: INV-2026-0001)
 * @property int $customer_id ID referensi pelanggan pembeli
 * @property int $vehicle_id ID referensi unit kendaraan yang dijual
 * @property float $vehicle_price Harga jual acuan kendaraan saat transaksi
 * @property float $discount Potongan harga / diskon yang diberikan
 * @property float $final_price Harga akhir yang harus dibayarkan (vehicle_price - discount)
 * @property \Illuminate\Support\Carbon $sale_date Tanggal realisasi transaksi
 * @property string|null $sales_person Nama wiraniaga / staf sales yang melayani
 * @property string $status Status transaksi: DRAFT, BOOKED, COMPLETED, CANCELLED
 * @property string|null $notes Catatan tambahan transaksi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \App\Models\Customer $customer Relasi ke data pelanggan pembeli
 * @property-read \App\Models\Vehicle $vehicle Relasi ke data unit kendaraan yang terjual
 */
class Sale extends Model
{
    /**
     * Definisi konstanta status transaksi untuk mencegah hardcode string di controller/view.
     */
    public const STATUS_DRAFT     = 'DRAFT';      // Transaksi baru disiapkan (belum mengunci unit)
    public const STATUS_BOOKED    = 'BOOKED';     // Unit telah di-booking / DP (status unit menjadi RESERVED)
    public const STATUS_COMPLETED = 'COMPLETED';  // Transaksi lunas & selesai (status unit menjadi SOLD)
    public const STATUS_CANCELLED = 'CANCELLED';  // Transaksi dibatalkan (status unit kembali AVAILABLE)

    /**
     * Kolom tabel database yang dapat diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'vehicle_id',
        'vehicle_price',
        'discount',
        'final_price',
        'sale_date',
        'sales_person',
        'status',
        'notes',
    ];

    /**
     * Konversi tipe data otomatis (Type Casting) dari kolom database ke tipe data PHP/Carbon.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'sale_date'     => 'date',
        'vehicle_price' => 'decimal:2',
        'discount'      => 'decimal:2',
        'final_price'   => 'decimal:2',
    ];

    /**
     * Relasi Many-to-One: Setiap transaksi penjualan dimiliki oleh satu Pelanggan (Customer).
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi Many-to-One: Setiap transaksi penjualan mengikat satu unit Kendaraan (Vehicle).
     *
     * @return BelongsTo
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}