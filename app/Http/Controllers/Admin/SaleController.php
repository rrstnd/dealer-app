<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Vehicle;
use App\Models\VehicleMovement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function index(): View
    {
        $sales = Sale::with([
            'customer',
            'vehicle.brand',
            'vehicle.model',
        ])
            ->latest('sale_date')
            ->latest('id')
            ->paginate(15);

        return view('admin.sales.index', compact('sales'));
    }

    public function create(): View
    {
        $customers = Customer::orderBy('name')->get();

        $vehicles = Vehicle::with([
            'brand',
            'model',
        ])
            ->where('status', 'AVAILABLE')
            ->orderBy('stock_code')
            ->get();

        return view(
            'admin.sales.create',
            compact('customers', 'vehicles')
        );
    }

    public function edit(Sale $sale): View
    {
        $customers = Customer::orderBy('name')->get();

        $vehicles = Vehicle::with([
            'brand',
            'model',
        ])
            ->where(function ($query) use ($sale) {
                $query->where('status', 'AVAILABLE')
                    ->orWhere('id', $sale->vehicle_id);
            })
            ->orderBy('stock_code')
            ->get();

        return view(
            'admin.sales.edit',
            compact('sale', 'customers', 'vehicles')
        );
    }

    public function update(Request $request, Sale $sale): RedirectResponse
    {
        if ($sale->status === 'CANCELLED') {
            return back()->withErrors([
                'sale' => 'Transaksi yang sudah dibatalkan tidak dapat diedit.',
            ]);
        }

        $validated = $request->validate([
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            'vehicle_id' => [
                'required',
                'integer',
                'exists:vehicles,id',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                'in:DRAFT,BOOKED,COMPLETED,CANCELLED',
            ],

            'sale_date' => [
                'required',
                'date',
            ],

            'sales_person' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        DB::transaction(function () use ($validated, $sale) {

            /*
            |--------------------------------------------------------------------------
            | Aturan transaksi COMPLETED
            |--------------------------------------------------------------------------
            */

            if (
                $sale->status === 'COMPLETED'
                && $validated['status'] !== 'COMPLETED'
            ) {
                abort(
                    422,
                    'Transaksi yang sudah COMPLETED tidak dapat diubah ke status lain.'
                );
            }

            if (
                $sale->status === 'COMPLETED'
                && $validated['vehicle_id'] != $sale->vehicle_id
            ) {
                abort(
                    422,
                    'Kendaraan pada transaksi COMPLETED tidak dapat diganti.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Lock kendaraan
            |--------------------------------------------------------------------------
            */

            $oldVehicle = Vehicle::where('id', $sale->vehicle_id)
                ->lockForUpdate()
                ->firstOrFail();

            $newVehicle = Vehicle::where('id', $validated['vehicle_id'])
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Kalau kendaraan diganti
            |--------------------------------------------------------------------------
            */

            if ($oldVehicle->id !== $newVehicle->id) {

                if ($newVehicle->status !== 'AVAILABLE') {
                    abort(
                        422,
                        'Kendaraan baru sudah tidak tersedia.'
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Kendaraan lama dikembalikan AVAILABLE
                |--------------------------------------------------------------------------
                */

                if (in_array($sale->status, ['DRAFT', 'BOOKED'])) {
                    $oldVehicle->update([
                        'status' => 'AVAILABLE',
                    ]);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | Pastikan kendaraan tujuan tersedia
            |--------------------------------------------------------------------------
            */

            if (
                $newVehicle->id !== $sale->vehicle_id
                && $newVehicle->status !== 'AVAILABLE'
            ) {
                abort(
                    422,
                    'Kendaraan sudah tidak tersedia.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Hitung harga
            |--------------------------------------------------------------------------
            */

            $vehiclePrice = $newVehicle->selling_price;
            $discount = $validated['discount'] ?? 0;

            if ($discount > $vehiclePrice) {
                abort(
                    422,
                    'Discount tidak boleh lebih besar dari harga kendaraan.'
                );
            }

            $finalPrice = $vehiclePrice - $discount;

            /*
            |--------------------------------------------------------------------------
            | Update Sale
            |--------------------------------------------------------------------------
            */

            $sale->update([
                'customer_id' => $validated['customer_id'],
                'vehicle_id' => $newVehicle->id,
                'vehicle_price' => $vehiclePrice,
                'discount' => $discount,
                'final_price' => $finalPrice,
                'sale_date' => $validated['sale_date'],
                'sales_person' => $validated['sales_person'] ?? null,
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Atur status kendaraan
            |--------------------------------------------------------------------------
            */

            if ($validated['status'] === 'COMPLETED') {

                $newVehicle->update([
                    'status' => 'SOLD',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Buat Vehicle Movement OUT hanya saat transaksi
                | berubah menjadi COMPLETED
                |--------------------------------------------------------------------------
                */

                if ($sale->wasChanged('status')) {

                    VehicleMovement::create([
                        'vehicle_id' => $newVehicle->id,
                        'type' => 'OUT',
                        'movement_date' => $validated['sale_date'],
                        'reference' => $sale->invoice_number,
                        'notes' => 'Kendaraan terjual',
                    ]);
                }

            } elseif ($validated['status'] === 'BOOKED') {

                $newVehicle->update([
                    'status' => 'RESERVED',
                ]);

            } elseif (
                in_array($validated['status'], ['DRAFT', 'CANCELLED'])
            ) {

                $newVehicle->update([
                    'status' => 'AVAILABLE',
                ]);
            }
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Penjualan berhasil diperbarui.');
    }

    public function cancel(Sale $sale): RedirectResponse
    {
        if ($sale->status === 'CANCELLED') {
            return back()->withErrors([
                'sale' => 'Transaksi sudah dibatalkan.',
            ]);
        }

        DB::transaction(function () use ($sale) {

            $vehicle = Vehicle::where('id', $sale->vehicle_id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | COMPLETED tidak boleh dibatalkan
            |--------------------------------------------------------------------------
            */

            if ($sale->status === 'COMPLETED') {
                abort(
                    422,
                    'Transaksi yang sudah COMPLETED tidak dapat dibatalkan.'
                );
            }

            $sale->update([
                'status' => 'CANCELLED',
            ]);

            $vehicle->update([
                'status' => 'AVAILABLE',
            ]);
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Penjualan berhasil dibatalkan.');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id' => [
                'required',
                'integer',
                'exists:customers,id',
            ],

            'vehicle_id' => [
                'required',
                'integer',
                'exists:vehicles,id',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                'in:DRAFT,BOOKED,COMPLETED,CANCELLED',
            ],

            'sale_date' => [
                'required',
                'date',
            ],

            'sales_person' => [
                'nullable',
                'string',
                'max:100',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        DB::transaction(function () use ($validated) {

            $vehicle = Vehicle::where('id', $validated['vehicle_id'])
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Kendaraan harus AVAILABLE
            |--------------------------------------------------------------------------
            */

            if ($vehicle->status !== 'AVAILABLE') {
                abort(
                    422,
                    'Kendaraan sudah tidak tersedia untuk dijual.'
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Hitung harga
            |--------------------------------------------------------------------------
            */

            $vehiclePrice = $vehicle->selling_price;
            $discount = $validated['discount'] ?? 0;

            if ($discount > $vehiclePrice) {
                abort(
                    422,
                    'Discount tidak boleh lebih besar dari harga kendaraan.'
                );
            }

            $finalPrice = $vehiclePrice - $discount;

            /*
            |--------------------------------------------------------------------------
            | Generate nomor invoice
            |--------------------------------------------------------------------------
            */

            $invoiceNumber = 'INV-' . now()->format('Y') . '-' .
                str_pad(
                    (Sale::max('id') ?? 0) + 1,
                    4,
                    '0',
                    STR_PAD_LEFT
                );

            /*
            |--------------------------------------------------------------------------
            | Simpan Sale
            |--------------------------------------------------------------------------
            */

            $sale = Sale::create([
                'invoice_number' => $invoiceNumber,
                'customer_id' => $validated['customer_id'],
                'vehicle_id' => $vehicle->id,
                'vehicle_price' => $vehiclePrice,
                'discount' => $discount,
                'final_price' => $finalPrice,
                'sale_date' => $validated['sale_date'],
                'sales_person' => $validated['sales_person'] ?? null,
                'status' => $validated['status'],
                'notes' => $validated['notes'] ?? null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | COMPLETED
            |--------------------------------------------------------------------------
            */

            if ($validated['status'] === 'COMPLETED') {

                $vehicle->update([
                    'status' => 'SOLD',
                ]);

                /*
                |--------------------------------------------------------------------------
                | Catat kendaraan keluar
                |--------------------------------------------------------------------------
                */

                VehicleMovement::create([
                    'vehicle_id' => $vehicle->id,
                    'type' => 'OUT',
                    'movement_date' => $validated['sale_date'],
                    'reference' => $sale->invoice_number,
                    'notes' => 'Kendaraan terjual',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | BOOKED
            |--------------------------------------------------------------------------
            */

            if ($validated['status'] === 'BOOKED') {

                $vehicle->update([
                    'status' => 'RESERVED',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | DRAFT / CANCELLED
            |--------------------------------------------------------------------------
            */

            if (
                in_array($validated['status'], ['DRAFT', 'CANCELLED'])
            ) {

                $vehicle->update([
                    'status' => 'AVAILABLE',
                ]);
            }
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Penjualan berhasil disimpan.');
    }

    public function show(Sale $sale): View
    {
        $sale->load([
            'customer',
            'vehicle.brand',
            'vehicle.model',
            'vehicle.vehicleType',
        ]);

        return view('admin.sales.show', compact('sale'));
    }
}