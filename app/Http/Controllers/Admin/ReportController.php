<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Controller Laporan & Ekspor Transaksi Penjualan Panel Admin.
 */
class ReportController extends Controller
{
    /**
     * Menampilkan laporan penjualan dengan filter rentang tanggal & rangkuman total (Omset/Pendapatan & Diskon).
     *
     * @param Request $request
     * @return View
     */
    public function sales(Request $request): View
    {
        // 1. Validasi rentang tanggal dari request filter
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        // 2. Query transaksi yang sudah COMPLETED (Selesai)
        $query = Sale::with([
            'customer',
            'vehicle.brand',
            'vehicle.model',
        ])->where('status', 'COMPLETED');

        if ($request->filled('date_from')) {
            $query->whereDate('sale_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('sale_date', '<=', $request->date_to);
        }

        // Ambil data penjualan dengan Pagination (15 record per halaman)
        $sales = $query
            ->latest('sale_date')
            ->paginate(15)
            ->withQueryString();

        // 3. Kalkulasi Ringkasan Laporan (Total Transaksi, Total Omset Revenue, Total Diskon)
        $summaryQuery = Sale::where('status', 'COMPLETED');

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
     * Mengunduh file Excel (.xlsx) laporan penjualan berdasarkan rentang tanggal.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportSales(Request $request)
    {
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $dateFrom = $request->input('date_from');
        $dateTo   = $request->input('date_to');

        // Menyusun nama file ekspor secara dinamis
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