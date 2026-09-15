<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Controller Transaksi Penjualan Unit Kendaraan Panel Admin Suja Mobilindo.
 */
class SaleController extends Controller
{
    /**
     * Menampilkan daftar seluruh riwayat transaksi penjualan.
     *
     * @return View
     */
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

    /**
     * Menampilkan form pembuatan transaksi penjualan baru.
     *
     * @return View
     */
    public function create(): View
    {
        $customers = Customer::orderBy('name')->get();

        // Hanya mengambil unit kendaraan yang masih AVAILABLE
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

    /**
     * Menyimpan transaksi penjualan baru ke database.
     * Menggunakan DB Transaction & Pessimistic Locking (lockForUpdate) untuk mencegah race condition.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'customer_id'  => 'required|integer|exists:customers,id',
            'vehicle_id'   => 'required|integer|exists:vehicles,id',
            'discount'     => 'nullable|numeric|min:0',
            'status'       => 'required|in:DRAFT,BOOKED,COMPLETED,CANCELLED',
            'sale_date'    => 'required|date',
            'sales_person' => 'nullable|string|max:100',
            'notes'        => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            // Lock record kendaraan untuk update aman
            $vehicle = Vehicle::where('id', $validated['vehicle_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // Kendaraan harus dalam kondisi AVAILABLE
            if ($vehicle->status !== 'AVAILABLE') {
                abort(422, 'Kendaraan sudah tidak tersedia untuk dijual.');
            }

            $vehiclePrice = $vehicle->selling_price;
            $discount     = $validated['discount'] ?? 0;

            if ($discount > $vehiclePrice) {
                abort(422, 'Discount tidak boleh lebih besar dari harga kendaraan.');
            }

            $finalPrice = $vehiclePrice - $discount;

            // Generate nomor invoice transaksi otomatis (Contoh: INV-2026-0001)
            $invoiceNumber = 'INV-' . now()->format('Y') . '-' .
                str_pad((Sale::max('id') ?? 0) + 1, 4, '0', STR_PAD_LEFT);

            // Simpan data transaksi penjualan
            Sale::create([
                'invoice_number' => $invoiceNumber,
                'customer_id'    => $validated['customer_id'],
                'vehicle_id'     => $vehicle->id,
                'vehicle_price'  => $vehiclePrice,
                'discount'       => $discount,
                'final_price'    => $finalPrice,
                'sale_date'      => $validated['sale_date'],
                'sales_person'   => $validated['sales_person'] ?? null,
                'status'         => $validated['status'],
                'notes'          => $validated['notes'] ?? null,
            ]);

            // Update status kendaraan sesuai status transaksi
            if ($validated['status'] === 'COMPLETED') {
                $vehicle->update(['status' => 'SOLD']);
            } elseif ($validated['status'] === 'BOOKED') {
                $vehicle->update(['status' => 'RESERVED']);
            }
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Penjualan berhasil disimpan.');
    }

    /**
     * Menampilkan detail lengkap satu transaksi penjualan.
     *
     * @param Sale $sale
     * @return View
     */
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

    /**
     * Menampilkan form edit transaksi penjualan.
     *
     * @param Sale $sale
     * @return View
     */
    public function edit(Sale $sale): View
    {
        $customers = Customer::orderBy('name')->get();

        // Opsi kendaraan: kendaraan yang AVAILABLE + kendaraan yang saat ini sedang dipilih di transaksi ini
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

    /**
     * Memperbarui transaksi penjualan yang ada.
     *
     * @param Request $request
     * @param Sale $sale
     * @return RedirectResponse
     */
    public function update(Request $request, Sale $sale): RedirectResponse
    {
        if ($sale->status === 'CANCELLED') {
            return back()->withErrors([
                'sale' => 'Transaksi yang sudah dibatalkan tidak dapat diedit.',
            ]);
        }

        $validated = $request->validate([
            'customer_id'  => 'required|integer|exists:customers,id',
            'vehicle_id'   => 'required|integer|exists:vehicles,id',
            'discount'     => 'nullable|numeric|min:0',
            'status'       => 'required|in:DRAFT,BOOKED,COMPLETED,CANCELLED',
            'sale_date'    => 'required|date',
            'sales_person' => 'nullable|string|max:100',
            'notes'        => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $sale) {
            $oldVehicle = Vehicle::where('id', $sale->vehicle_id)->lockForUpdate()->firstOrFail();
            $newVehicle = Vehicle::where('id', $validated['vehicle_id'])->lockForUpdate()->firstOrFail();

            // Jika unit kendaraan diganti
            if ($oldVehicle->id !== $newVehicle->id) {
                if ($newVehicle->status !== 'AVAILABLE') {
                    abort(422, 'Kendaraan baru sudah tidak tersedia.');
                }

                // Kembalikan kendaraan lama ke status AVAILABLE
                if (in_array($sale->status, ['BOOKED', 'DRAFT'])) {
                    $oldVehicle->update(['status' => 'AVAILABLE']);
                }
            }

            if ($newVehicle->id !== $sale->vehicle_id && $newVehicle->status !== 'AVAILABLE') {
                abort(422, 'Kendaraan sudah tidak tersedia.');
            }

            $vehiclePrice = $newVehicle->selling_price;
            $discount     = $validated['discount'] ?? 0;

            if ($discount > $vehiclePrice) {
                abort(422, 'Discount tidak boleh lebih besar dari harga kendaraan.');
            }

            $finalPrice = $vehiclePrice - $discount;

            $sale->update([
                'customer_id'   => $validated['customer_id'],
                'vehicle_id'    => $newVehicle->id,
                'vehicle_price' => $vehiclePrice,
                'discount'      => $discount,
                'final_price'   => $finalPrice,
                'sale_date'     => $validated['sale_date'],
                'sales_person'  => $validated['sales_person'] ?? null,
                'status'        => $validated['status'],
                'notes'         => $validated['notes'] ?? null,
            ]);

            // Sinkronisasi status unit kendaraan
            if ($validated['status'] === 'COMPLETED') {
                $newVehicle->update(['status' => 'SOLD']);
            } elseif ($validated['status'] === 'BOOKED') {
                $newVehicle->update(['status' => 'RESERVED']);
            } elseif (in_array($validated['status'], ['DRAFT', 'CANCELLED'])) {
                $newVehicle->update(['status' => 'AVAILABLE']);
            }
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Penjualan berhasil diperbarui.');
    }

    /**
     * Membatalkan transaksi penjualan (Mengembalikan status kendaraan ke AVAILABLE).
     *
     * @param Sale $sale
     * @return RedirectResponse
     */
    public function cancel(Sale $sale): RedirectResponse
    {
        if ($sale->status === 'CANCELLED') {
            return back()->withErrors([
                'sale' => 'Transaksi sudah dibatalkan.',
            ]);
        }

        DB::transaction(function () use ($sale) {
            $vehicle = Vehicle::where('id', $sale->vehicle_id)->lockForUpdate()->firstOrFail();

            if ($sale->status === 'COMPLETED') {
                abort(422, 'Transaksi yang sudah COMPLETED tidak dapat dibatalkan.');
            }

            $sale->update(['status' => 'CANCELLED']);
            $vehicle->update(['status' => 'AVAILABLE']);
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Penjualan berhasil dibatalkan.');
    }
}