<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model Pengguna Sistem / Akun Administrator & Staf (Users).
 *
 * Digunakan oleh Laravel Breeze untuk autentikasi sesi, hashing password,
 * serta verifikasi hak akses ke panel admin dealer.
 *
 * @property int $id
 * @property string $name Nama lengkap pengguna / staf
 * @property string $email Alamat email login
 * @property \Illuminate\Support\Carbon|null $email_verified_at Waktu verifikasi email
 * @property string $password Hash password bcrypt pengguna
 * @property string|null $remember_token Token sesi remember me
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom tabel yang dapat diisi secara massal (Mass Assignment).
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Kolom atribut yang disembunyikan saat data diubah menjadi format Array / JSON (keamanan).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi tipe data otomatis (Type Casting).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
}
