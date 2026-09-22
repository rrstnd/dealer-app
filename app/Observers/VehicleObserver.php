<?php

namespace App\Observers;

use App\Models\Vehicle;
use App\Models\VehicleMovement;

class VehicleObserver
{
    /**
     * Handle the Vehicle "updated" event.
     */
    public function updated(Vehicle $vehicle): void
    {
        /*
        |--------------------------------------------------------------------------
        | AVAILABLE → SOLD
        |--------------------------------------------------------------------------
        */

        if (
            $vehicle->wasChanged('status')
            && $vehicle->status === 'SOLD'
        ) {
            /*
            |--------------------------------------------------------------------------
            | Buat movement OUT terlebih dahulu
            |--------------------------------------------------------------------------
            */

            $movement = VehicleMovement::create([
                'vehicle_id' => $vehicle->id,
                'type' => 'OUT',
                'movement_date' => now()->toDateString(),
                'reference' => null,
                'notes' => 'Kendaraan terjual',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Generate nomor invoice
            |--------------------------------------------------------------------------
            */

            $invoiceNumber = 'INV-' .
                now()->format('Y') .
                '-' .
                str_pad(
                    $movement->id,
                    4,
                    '0',
                    STR_PAD_LEFT
                );

            /*
            |--------------------------------------------------------------------------
            | Simpan invoice ke reference
            |--------------------------------------------------------------------------
            */

            $movement->update([
                'reference' => $invoiceNumber,
            ]);
        }
    }
}