<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
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

        public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}