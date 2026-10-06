<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;

/**
 * Controller Rangkuman Eksekutif Dashboard Utama Panel Admin.
 *
 * Mengagregasi metrik statistik penting showroom: jumlah stok kendaraan berdasarkan status,
 * total pelanggan terdaftar, 5 riwayat penjualan terbaru, dan 6 unit kendaraan terkini.
 */
class DashboardController extends Controller
{
    /**
     * Menampilkan halaman ikhtisar statistik dashboard admin.
     *
     * @return View
     */
    public function index(\Illuminate\Http\Request $request): View
    {
        // 1. Ambil nilai filter bulan dan tahun dari request (jika kosong, gunakan bulan dan tahun saat ini)
        $month = $request->input('month', date('m'));
        $year = $request->input('year', date('Y'));

        // 2. Hitung jumlah Motor yang Masuk (berdasarkan tanggal dibuat / created_at)
        $motorMasuk = Vehicle::whereHas('vehicleType', function ($q) {
            $q->whereRaw('LOWER(name) = ?', ['motor']);
        })->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();

        // 3. Hitung jumlah Mobil yang Masuk (berdasarkan tanggal dibuat / created_at)
        $mobilMasuk = Vehicle::whereHas('vehicleType', function ($q) {
            $q->whereRaw('LOWER(name) = ?', ['mobil']);
        })->whereMonth('created_at', $month)->whereYear('created_at', $year)->count();

        // 4. Hitung jumlah Motor yang Terjual
        // - Termasuk kendaraan dengan status SOLD (Terjual)
        // - ATAU kendaraan yang telah dihapus (Soft Deleted)
        $motorTerjual = Vehicle::withTrashed()
            ->whereHas('vehicleType', function ($q) {
                $q->whereRaw('LOWER(name) = ?', ['motor']);
            })
            ->where(function ($query) use ($month, $year) {
                $query->where(function ($q) use ($month, $year) {
                    $q->where('status', Vehicle::STATUS_SOLD)
                      ->whereMonth('updated_at', $month)
                      ->whereYear('updated_at', $year);
                })->orWhere(function ($q) use ($month, $year) {
                    $q->whereNotNull('deleted_at')
                      ->whereMonth('deleted_at', $month)
                      ->whereYear('deleted_at', $year);
                });
            })->count();

        // 5. Hitung jumlah Mobil yang Terjual
        // - Termasuk kendaraan dengan status SOLD (Terjual)
        // - ATAU kendaraan yang telah dihapus (Soft Deleted)
        $mobilTerjual = Vehicle::withTrashed()
            ->whereHas('vehicleType', function ($q) {
                $q->whereRaw('LOWER(name) = ?', ['mobil']);
            })
            ->where(function ($query) use ($month, $year) {
                $query->where(function ($q) use ($month, $year) {
                    $q->where('status', Vehicle::STATUS_SOLD)
                      ->whereMonth('updated_at', $month)
                      ->whereYear('updated_at', $year);
                })->orWhere(function ($q) use ($month, $year) {
                    $q->whereNotNull('deleted_at')
                      ->whereMonth('deleted_at', $month)
                      ->whereYear('deleted_at', $year);
                });
            })->count();

        // 6. Ambil 6 Unit Kendaraan Terbaru yang Masuk ke Showroom untuk ditampilkan di bawah kotak statistik
        $vehicles = Vehicle::with([
            'brand',
            'model',
            'primaryImage',
        ])
            ->latest()
            ->take(6)
            ->get();

        // 7. Render Tampilan View Dashboard dan kirim semua variabel yang sudah dihitung
        return view('admin.dashboard.index', compact(
            'motorMasuk',
            'mobilMasuk',
            'motorTerjual',
            'mobilTerjual',
            'vehicles',
            'month',
            'year'
        ));
    }
}