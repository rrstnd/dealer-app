<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Model Data Pelanggan / Konsumen Showroom (Customers).
 *
 * Mengelola informasi biodata, identitas resmi (NIK), kontak (telepon & email),
 * domisili alamat pengiriman BPKB/STNK, serta riwayat seluruh pembelian unit.
 *
 * @property int $id
 * @property string $customer_code Kode unik pelanggan (contoh: CUST-001)
 * @property string $name Nama lengkap pelanggan
 * @property string|null $nik Nomor Induk Kependudukan (KTP) 16 digit
 * @property string $phone Nomor telepon / WhatsApp aktif
 * @property string|null $email Alamat surat elektronik (email)
 * @property string|null $address Alamat domisili lengkap
 * @property string|null $city Kota / Kabupaten
 * @property string|null $province Provinsi
 * @property string|null $notes Catatan khusus preferensi atau riwayat pelanggan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sale> $sales Daftar transaksi pembelian pelanggan ini
 */
class Customer extends Model
{
    /**
     * Kolom tabel database yang dapat diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
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
     * Relasi One-to-Many: Satu pelanggan dapat melakukan beberapa kali transaksi pembelian unit (Sale).
     *
     * @return HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}