<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

/**
 * Controller Laporan Penjualan & Ekspor Data Finansial Panel Admin.
 *
 * Mengelola penyaringan data penjualan berstatus 'COMPLETED' berdasarkan rentang tanggal,
 * kalkulasi omset/revenue bersih dan total diskon, serta ekspor laporan ke format Microsoft Excel (.xlsx).
 */
class ReportController extends Controller
{
    /**
     * Menampilkan tabel laporan penjualan beserta ringkasan finansial (omset, diskon, volume transaksi).
     *
     * @param Request $request
     * @return View
     */
    public function sales(Request $request): View
    {
        // 1. Validasi filter rentang tanggal dari request
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        // 2. Query transaksi yang telah selesai (COMPLETED)
        $query = Sale::with([
            'customer',
            'vehicle.brand',
            'vehicle.model',
        ])->where('status', Sale::STATUS_COMPLETED);

        if ($request->filled('date_from')) {
            $query->whereDate('sale_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('sale_date', '<=', $request->date_to);
        }

        // Paginasi 15 transaksi per halaman dengan mempertahankan query string filter di URL
        $sales = $query
            ->latest('sale_date')
            ->paginate(15)
            ->withQueryString();

        // 3. Kalkulasi Ringkasan Finansial Laporan (Omset, Diskon, Total Unit Terjual)
        $summaryQuery = Sale::where('status', Sale::STATUS_COMPLETED);

        if ($request->filled('date_from')) {
            $summaryQuery->whereDate('sale_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $summaryQuery->whereDate('sale_date', '<=', $request->date_to);
        }

        $totalTransactions = (clone $summaryQuery)->count();
        $totalRevenue      = (clone $summaryQuery)->sum('final_price');
        $totalDiscount     = (clone $summaryQuery)->sum('discount');

        return view('admin.reports.sales', compact(
            'sales',
            'totalTransactions',
            'totalRevenue',
            'totalDiscount'
        ));
    }

    /**
     * Mengunduh berkas laporan transaksi penjualan dalam format spreadsheet Excel (.xlsx).
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function exportSales(Request $request): BinaryFileResponse
    {
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        // Menyusun penamaan berkas unduhan secara deskriptif sesuai rentang tanggal
        $fileName = 'laporan-penjualan';

        if ($dateFrom && $dateTo) {
            $fileName .= "-{$dateFrom}-sampai-{$dateTo}";
        } elseif ($dateFrom) {
            $fileName .= "-mulai-{$dateFrom}";
        } elseif ($dateTo) {
            $fileName .= "-sampai-{$dateTo}";
        }

        $fileName .= '.xlsx';

        return Excel::download(
            new SalesExport($dateFrom, $dateTo),
            $fileName
        );
    }
}