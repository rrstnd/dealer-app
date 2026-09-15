<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Data Pelanggan / Customer Showroom.
 */
class Customer extends Model
{
    /**
     * Kolom yang dapat diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'customer_code',
        'name',
        'nik',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'notes',
    ];

    /**
     * Relasi ke Riwayat Transaksi Penjualan Pelanggan.
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}