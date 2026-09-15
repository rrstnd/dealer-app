<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Model Data Transaksi Penjualan Unit Kendaraan.
 * Mengelola nomor invoice, tanggal transaksi, harga unit, diskon, harga akhir, dan relasi ke Pelanggan & Kendaraan.
 */
class Sale extends Model
{
    /**
     * Kolom yang dapat diisi secara massal (Mass Assignment).
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
     * Casting tipe data kolom database ke tipe data PHP/Carbon.
     */
    protected $casts = [
        'sale_date'     => 'date',
        'vehicle_price' => 'decimal:2',
        'discount'      => 'decimal:2',
        'final_price'   => 'decimal:2',
    ];

    /**
     * Relasi ke Pelanggan (Customer).
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Relasi ke Kendaraan (Vehicle).
     */
    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }
}