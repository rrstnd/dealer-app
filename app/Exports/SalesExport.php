<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * Handler Ekspor Laporan Penjualan ke Spreadsheet Excel (.xlsx).
 *
 * Mengimplementasikan antarmuka Maatwebsite/Laravel-Excel:
 * - FromQuery: Mengambil data secara streaming/chunking langsung dari database (hemat memori).
 * - WithHeadings: Menyediakan baris judul header kolom spreadsheet.
 * - WithMapping: Mengonversi format setiap objek model Sale ke baris array spreadsheet.
 * - ShouldAutoSize: Otomatis menyesuaikan lebar kolom Excel dengan panjang teks.
 */
class SalesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * Konstruktor penyaring data ekspor.
     *
     * @param string|null $dateFrom Batas awal tanggal transaksi (format: YYYY-MM-DD)
     * @param string|null $dateTo Batas akhir tanggal transaksi (format: YYYY-MM-DD)
     */
    public function __construct(
        protected ?string $dateFrom = null,
        protected ?string $dateTo = null,
    ) {
    }

    /**
     * Menyusun kueri data penjualan yang akan diekspor.
     * Hanya mencakup transaksi yang telah selesai (COMPLETED) dalam rentang tanggal.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        $query = Sale::query()
            ->with([
                'customer',
                'vehicle.brand',
                'vehicle.model',
            ])
            ->where('status', Sale::STATUS_COMPLETED);

        if ($this->dateFrom) {
            $query->whereDate('sale_date', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('sale_date', '<=', $this->dateTo);
        }

        return $query->latest('sale_date');
    }

    /**
     * Mendefinisikan baris judul (header) untuk lembar kerja Excel.
     *
     * @return array<int, string>
     */
    public function headings(): array
    {
        return [
            'Invoice',
            'Tanggal',
            'Customer',
            'Stock Code',
            'Brand',
            'Model',
            'Variant',
            'Harga Kendaraan',
            'Diskon',
            'Harga Final',
            'Status',
            'Sales Person',
            'Catatan',
        ];
    }

    /**
     * Memetakan data dari setiap entitas model Sale ke dalam format kolom baris Excel.
     *
     * @param Sale $sale
     * @return array<int, mixed>
     */
    public function map(mixed $sale): array
    {
        /** @var Sale $sale */
        return [
            $sale->invoice_number,
            $sale->sale_date?->format('d/m/Y'),
            $sale->customer?->name,
            $sale->vehicle?->stock_code,
            $sale->vehicle?->brand?->name,
            $sale->vehicle?->model?->name,
            $sale->vehicle?->variant,
            $sale->vehicle_price,
            $sale->discount,
            $sale->final_price,
            $sale->status,
            $sale->sales_person,
            $sale->notes,
        ];
    }
}