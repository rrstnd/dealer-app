<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    public function __construct(
        protected ?string $dateFrom = null,
        protected ?string $dateTo = null,
    ) {
    }

    public function query(): Builder
    {
        $query = Sale::query()
            ->with([
                'customer',
                'vehicle.brand',
                'vehicle.model',
            ])
            ->where('status', 'COMPLETED');

        if ($this->dateFrom) {
            $query->whereDate('sale_date', '>=', $this->dateFrom);
        }

        if ($this->dateTo) {
            $query->whereDate('sale_date', '<=', $this->dateTo);
        }

        return $query->latest('sale_date');
    }

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

    public function map(mixed $sale): array
    {
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