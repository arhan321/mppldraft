<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Order;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;


class OrderVerificationController extends Controller
{
    /**
     * Verifikasi pembayaran & kurangi stok kendaraan.
     */
public function verify(Order $order): RedirectResponse
{
    Log::info('VERIFY controller fired', [
        'order_id'   => $order->id,
        'veh_id'     => $order->vehicle_id,
        'old_status' => $order->status,
    ]);

    abort_if($order->status !== 'proses', 403, 'Status order bukan PROSES');

    DB::transaction(function () use ($order) {
        $vehicle = Vehicle::whereKey($order->vehicle_id)
            ->lockForUpdate()
            ->firstOrFail();

        if ($vehicle->stok <= 0) {
            abort(409, 'Stok kendaraan habis');
        }

        $before = $vehicle->stok;
        $vehicle->decrement('stok');
        $after  = $vehicle->fresh()->stok;

        \Log::info('STOK UPDATED', compact('before', 'after'));

        $order->update([
            'status'              => 'dibayar',
            'payment_verified_at' => now(),
        ]);
    });

    return back()->with('filament_notifications', [[
        'title'  => 'Pembayaran diverifikasi',
        'body'   => 'Stok kendaraan telah dikurangi 1.',
        'status' => 'success',
    ]]);
}

}