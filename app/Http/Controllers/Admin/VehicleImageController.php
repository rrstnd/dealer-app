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
 * Controller Pengelolaan Berkas Galeri Foto Kendaraan Panel Admin.
 *
 * Mengatur upload berkas gambar ke disk storage 'public', penetapan foto sampul utama (is_primary),
 * penghapusan berkas fisik beserta data di database, dan penataan urutan tampilan.
 */
class VehicleImageController extends Controller
{
    /**
     * Mengunggah dan menyimpan foto baru untuk unit kendaraan tertentu.
     * Foto pertama yang diunggah otomatis ditetapkan sebagai foto utama (is_primary = true).
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function store(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240', // Batas ukuran berkas maksimal 10MB
            ],
        ]);

        DB::transaction(function () use ($request, $vehicle) {
            $hasImages = $vehicle->images()->exists();
            $currentSort = $vehicle->images()->count();

            foreach ($request->file('images') as $file) {
                // Simpan berkas gambar fisik ke direktori storage/app/public/vehicles
                $path = $file->store('vehicles', 'public');

                // Jika belum ada foto sama sekali, foto pertama ini otomatis menjadi foto utama (primary)
                $vehicle->images()->create([
                    'image_path' => $path,
                    'is_primary' => !$hasImages,
                    'sort_order' => $currentSort,
                ]);

                $hasImages = true;
                $currentSort++;
            }
        });

        return back()->with('success', 'Foto kendaraan berhasil diunggah dan ditambahkan ke galeri.');
    }

    /**
     * Menghapus foto dari galeri kendaraan, menghapus berkas fisik dari storage,
     * serta mengalihkan status 'is_primary' ke foto berikutnya jika foto yang dihapus adalah foto utama.
     *
     * @param Vehicle $vehicle
     * @param VehicleImage $image
     * @return RedirectResponse
     */
    public function destroy(Vehicle $vehicle, VehicleImage $image): RedirectResponse
    {
        // Validasi keamanan relasi: pastikan foto benar-benar milik kendaraan yang dimaksud
        abort_unless($image->vehicle_id === $vehicle->id, 404);

        $wasPrimary = $image->is_primary;

        // 1. Hapus berkas gambar fisik dari disk storage 'public'
        Storage::disk('public')->delete($image->image_path);

        // 2. Hapus data record foto dari database
        $image->delete();

        // 3. Jika yang dihapus adalah foto utama, jadikan foto berikutnya yang ada sebagai foto utama baru
        if ($wasPrimary) {
            $newPrimary = $vehicle->images()->orderBy('sort_order')->first();
            if ($newPrimary) {
                $newPrimary->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Foto kendaraan berhasil dihapus.');
    }

    /**
     * Menetapkan salah satu foto galeri sebagai foto utama (Primary Image / Thumbnail Sampul).
     *
     * @param Vehicle $vehicle
     * @param VehicleImage $image
     * @return RedirectResponse
     */
    public function setPrimary(Vehicle $vehicle, VehicleImage $image): RedirectResponse
    {
        abort_unless($image->vehicle_id === $vehicle->id, 404);

        DB::transaction(function () use ($vehicle, $image) {
            // Reset seluruh status foto lain milik unit ini menjadi non-primary
            $vehicle->images()->update(['is_primary' => false]);

            // Set foto yang dipilih menjadi primary
            $image->update(['is_primary' => true]);
        });

        return back()->with('success', 'Foto utama kendaraan berhasil diperbarui.');
    }
}