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
 * Controller Manajemen Transaksi Penjualan Unit Kendaraan Panel Admin Suja Mobilindo.
 *
 * Mengelola alur order, pembuatan nomor invoice otomatis, kalkulasi diskon dan harga final,
 * penguncian baris database (pessimistic locking) untuk mencegah double-booking kendaraan,
 * serta sinkronisasi status inventaris kendaraan (AVAILABLE, RESERVED, SOLD).
 */
class SaleController extends Controller
{
    /**
     * Menampilkan daftar riwayat seluruh transaksi penjualan dengan relasi Pelanggan & Kendaraan.
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
     * Menampilkan formulir pendaftaran transaksi penjualan baru.
     * Hanya unit kendaraan dengan status 'AVAILABLE' yang ditampilkan untuk dipilih.
     *
     * @return View
     */
    public function create(): View
    {
        $customers = Customer::orderBy('name')->get();

        // Ambil unit yang berstatus AVAILABLE dan siap dijual
        $vehicles = Vehicle::with([
            'brand',
            'model',
        ])
            ->where('status', Vehicle::STATUS_AVAILABLE)
            ->orderBy('stock_code')
            ->get();

        return view('admin.sales.create', compact('customers', 'vehicles'));
    }

    /**
     * Menyimpan transaksi penjualan baru ke database.
     *
     * Catatan Pengembangan Penting:
     * - Menggunakan DB::transaction untuk memastikan atomisitas penyimpanan data penjualan dan pembaruan status unit.
     * - Menggunakan lockForUpdate() pada record kendaraan untuk mencegah Race Condition / Double Selling jika ada
     *   beberapa staf admin/sales yang menginput transaksi pada unit yang sama secara bersamaan.
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
            // 1. Kunci baris data kendaraan secara eksklusif (Pessimistic Locking)
            $vehicle = Vehicle::where('id', $validated['vehicle_id'])
                ->lockForUpdate()
                ->firstOrFail();

            // 2. Pastikan unit masih dalam status AVAILABLE
            if ($vehicle->status !== Vehicle::STATUS_AVAILABLE) {
                abort(422, 'Kendaraan ini sudah tidak tersedia untuk dijual (status: ' . $vehicle->status . ').');
            }

            $vehiclePrice = (float) $vehicle->selling_price;
            $discount     = (float) ($validated['discount'] ?? 0);

            if ($discount > $vehiclePrice) {
                abort(422, 'Nominal diskon tidak boleh melebihi harga jual kendaraan.');
            }

            $finalPrice = $vehiclePrice - $discount;

            // 3. Generate nomor faktur/invoice otomatis (Contoh: INV-2026-0001)
            $invoiceNumber = 'INV-' . now()->format('Y') . '-' .
                str_pad((Sale::max('id') ?? 0) + 1, 4, '0', STR_PAD_LEFT);

            // 4. Simpan record transaksi penjualan
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

            // 5. Sinkronisasi status inventaris kendaraan sesuai status transaksi
            if ($validated['status'] === Sale::STATUS_COMPLETED) {
                $vehicle->update(['status' => Vehicle::STATUS_SOLD]);
            } elseif ($validated['status'] === Sale::STATUS_BOOKED) {
                $vehicle->update(['status' => Vehicle::STATUS_RESERVED]);
            }
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Transaksi penjualan berhasil disimpan.');
    }

    /**
     * Menampilkan detail lengkap satu faktur transaksi penjualan beserta spesifikasi unit dan pembeli.
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
     * Menampilkan formulir edit transaksi penjualan.
     * Opsi kendaraan mencakup: Seluruh unit AVAILABLE + unit yang sedang dikaitkan pada transaksi ini.
     *
     * @param Sale $sale
     * @return View
     */
    public function edit(Sale $sale): View
    {
        $customers = Customer::orderBy('name')->get();

        $vehicles = Vehicle::with([
            'brand',
            'model',
        ])
            ->where(function ($query) use ($sale) {
                $query->where('status', Vehicle::STATUS_AVAILABLE)
                    ->orWhere('id', $sale->vehicle_id);
            })
            ->orderBy('stock_code')
            ->get();

        return view('admin.sales.edit', compact('sale', 'customers', 'vehicles'));
    }

    /**
     * Memperbarui data transaksi penjualan yang telah ada.
     *
     * Mengatur penukaran unit kendaraan jika admin mengganti pilihan unit,
     * serta mengembalikan status unit lama menjadi AVAILABLE.
     *
     * @param Request $request
     * @param Sale $sale
     * @return RedirectResponse
     */
    public function update(Request $request, Sale $sale): RedirectResponse
    {
        if ($sale->status === Sale::STATUS_CANCELLED) {
            return back()->withErrors([
                'sale' => 'Transaksi yang sudah berstatus CANCELLED tidak dapat diedit kembali.',
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

            // Jika admin mengganti pilihan unit kendaraan pada transaksi ini
            if ($oldVehicle->id !== $newVehicle->id) {
                if ($newVehicle->status !== Vehicle::STATUS_AVAILABLE) {
                    abort(422, 'Unit kendaraan pengganti yang dipilih sudah tidak berstatus AVAILABLE.');
                }

                // Kembalikan unit kendaraan lama ke status AVAILABLE jika sebelumnya di-reserve/draft
                if (in_array($sale->status, [Sale::STATUS_BOOKED, Sale::STATUS_DRAFT])) {
                    $oldVehicle->update(['status' => Vehicle::STATUS_AVAILABLE]);
                }
            }

            if ($newVehicle->id !== $sale->vehicle_id && $newVehicle->status !== Vehicle::STATUS_AVAILABLE) {
                abort(422, 'Kendaraan yang dipilih sudah tidak tersedia.');
            }

            $vehiclePrice = (float) $newVehicle->selling_price;
            $discount     = (float) ($validated['discount'] ?? 0);

            if ($discount > $vehiclePrice) {
                abort(422, 'Nominal diskon tidak boleh melebihi harga kendaraan.');
            }

            $finalPrice = $vehiclePrice - $discount;

            // Perbarui data transaksi
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

            // Sinkronisasi status unit kendaraan baru sesuai status transaksi teranyar
            if ($validated['status'] === Sale::STATUS_COMPLETED) {
                $newVehicle->update(['status' => Vehicle::STATUS_SOLD]);
            } elseif ($validated['status'] === Sale::STATUS_BOOKED) {
                $newVehicle->update(['status' => Vehicle::STATUS_RESERVED]);
            } elseif (in_array($validated['status'], [Sale::STATUS_DRAFT, Sale::STATUS_CANCELLED])) {
                $newVehicle->update(['status' => Vehicle::STATUS_AVAILABLE]);
            }
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Data transaksi penjualan berhasil diperbarui.');
    }

    /**
     * Membatalkan transaksi penjualan secara resmi.
     * Mengembalikan status unit kendaraan terkait menjadi 'AVAILABLE' agar dapat dijual kembali.
     *
     * @param Sale $sale
     * @return RedirectResponse
     */
    public function cancel(Sale $sale): RedirectResponse
    {
        if ($sale->status === Sale::STATUS_CANCELLED) {
            return back()->withErrors([
                'sale' => 'Transaksi ini memang sudah dalam status dibatalkan (CANCELLED).',
            ]);
        }

        DB::transaction(function () use ($sale) {
            $vehicle = Vehicle::where('id', $sale->vehicle_id)->lockForUpdate()->firstOrFail();

            if ($sale->status === Sale::STATUS_COMPLETED) {
                abort(422, 'Transaksi yang sudah lunas (COMPLETED) tidak dapat dibatalkan secara langsung.');
            }

            // Ubah status transaksi menjadi CANCELLED dan kembalikan unit ke AVAILABLE
            $sale->update(['status' => Sale::STATUS_CANCELLED]);
            $vehicle->update(['status' => Vehicle::STATUS_AVAILABLE]);
        });

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Transaksi penjualan berhasil dibatalkan dan status unit telah dikembalikan ke AVAILABLE.');
    }
}