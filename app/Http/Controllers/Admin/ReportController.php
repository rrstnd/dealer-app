<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalesExport;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function sales(Request $request): View
    {
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

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

        $sales = $query
            ->latest('sale_date')
            ->paginate(15)
            ->withQueryString();

        $summaryQuery = Sale::where('status', 'COMPLETED');

        if ($request->filled('date_from')) {
            $summaryQuery->whereDate('sale_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $summaryQuery->whereDate('sale_date', '<=', $request->date_to);
        }

        $totalTransactions = (clone $summaryQuery)->count();

        $totalRevenue = (clone $summaryQuery)->sum('final_price');

        $totalDiscount = (clone $summaryQuery)->sum('discount');

        return view('admin.reports.sales', compact(
            'sales',
            'totalTransactions',
            'totalRevenue',
            'totalDiscount'
        ));
    }

    public function exportSales(Request $request)
    {
        $request->validate([
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

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