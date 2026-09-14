<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VehicleImageController extends Controller
{
    /**
     * Upload foto kendaraan.
     */
    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        DB::transaction(function () use ($request, $vehicle) {

            $hasImages = $vehicle->images()->exists();

            $path = $request->file('image')->store(
                'vehicles',
                'public'
            );

            $vehicle->images()->create([
                'image_path' => $path,
                'is_primary' => !$hasImages,
                'sort_order' => $vehicle->images()->count(),
            ]);
        });

        return back()->with(
            'success',
            'Foto kendaraan berhasil ditambahkan.'
        );
    }

    /**
     * Hapus foto kendaraan.
     */
    public function destroy(
        Vehicle $vehicle,
        VehicleImage $image
    ) {
        // Pastikan foto memang milik kendaraan tersebut.
        abort_unless(
            $image->vehicle_id === $vehicle->id,
            404
        );

        $wasPrimary = $image->is_primary;

        Storage::disk('public')->delete(
            $image->image_path
        );

        $image->delete();

        // Kalau foto utama dihapus,
        // jadikan foto pertama sebagai primary.
        if ($wasPrimary) {
            $newPrimary = $vehicle->images()
                ->orderBy('sort_order')
                ->first();

            if ($newPrimary) {
                $newPrimary->update([
                    'is_primary' => true,
                ]);
            }
        }

        return back()->with(
            'success',
            'Foto kendaraan berhasil dihapus.'
        );
    }

    /**
     * Jadikan foto sebagai foto utama.
     */
    public function setPrimary(
        Vehicle $vehicle,
        VehicleImage $image
    ) {
        abort_unless(
            $image->vehicle_id === $vehicle->id,
            404
        );

        DB::transaction(function () use ($vehicle, $image) {

            // Matikan primary sebelumnya.
            $vehicle->images()->update([
                'is_primary' => false,
            ]);

            // Jadikan foto yang dipilih sebagai primary.
            $image->update([
                'is_primary' => true,
            ]);
        });

        return back()->with(
            'success',
            'Foto utama berhasil diubah.'
        );
    }
}