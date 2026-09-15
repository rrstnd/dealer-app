<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Controller Manajerial Galeri Foto Kendaraan Panel Admin.
 */
class VehicleImageController extends Controller
{
    /**
     * Mengunggah dan menyimpan foto kendaraan baru ke disk 'public'.
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function store(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240', // Maksimal 10MB
            ],
        ]);

        DB::transaction(function () use ($request, $vehicle) {
            // Cek apakah kendaraan sudah memiliki foto sebelumnya
            $hasImages = $vehicle->images()->exists();

            // Simpan file ke folder storage/app/public/vehicles
            $path = $request->file('image')->store('vehicles', 'public');

            // Jika belum ada foto, foto pertama yang diunggah otomatis dijadikan foto utama (is_primary = true)
            $vehicle->images()->create([
                'image_path' => $path,
                'is_primary' => !$hasImages,
                'sort_order' => $vehicle->images()->count(),
            ]);
        });

        return back()->with('success', 'Foto kendaraan berhasil ditambahkan.');
    }

    /**
     * Menghapus foto kendaraan dari database dan storage fisik.
     *
     * @param Vehicle $vehicle
     * @param VehicleImage $image
     * @return RedirectResponse
     */
    public function destroy(Vehicle $vehicle, VehicleImage $image): RedirectResponse
    {
        // Pengecekan keamanan: pastikan foto memang milik unit kendaraan yang bersangkutan
        abort_unless($image->vehicle_id === $vehicle->id, 404);

        $wasPrimary = $image->is_primary;

        // Hapus file fisik di storage
        Storage::disk('public')->delete($image->image_path);

        // Hapus record di database
        $image->delete();

        // Jika foto yang dihapus adalah foto utama, jadikan foto berikutnya sebagai foto utama
        if ($wasPrimary) {
            $newPrimary = $vehicle->images()->orderBy('sort_order')->first();
            if ($newPrimary) {
                $newPrimary->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Foto kendaraan berhasil dihapus.');
    }

    /**
     * Mengubah salah satu foto galeri menjadi foto utama (Primary Image).
     *
     * @param Vehicle $vehicle
     * @param VehicleImage $image
     * @return RedirectResponse
     */
    public function setPrimary(Vehicle $vehicle, VehicleImage $image): RedirectResponse
    {
        abort_unless($image->vehicle_id === $vehicle->id, 404);

        DB::transaction(function () use ($vehicle, $image) {
            // Reset seluruh status primary foto lain milik kendaraan ini
            $vehicle->images()->update(['is_primary' => false]);

            // Set foto yang dipilih sebagai primary
            $image->update(['is_primary' => true]);
        });

        return back()->with('success', 'Foto utama berhasil diubah.');
    }
}