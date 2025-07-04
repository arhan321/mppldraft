<?php

namespace App\Observers;

use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderObserver
{
    /**
     * Dipanggil sesudah baris Order benar-benar tersimpan.
     */
    public function updated(Order $order): void
    {
        // Apakah kolom status barusan berubah ⇒ jadi "dibayar"?
        if ($order->wasChanged('status') && $order->status === 'dibayar') {
            DB::transaction(function () use ($order) {
                $vehicle = $order->vehicle()->lockForUpdate()->first();

                if ($vehicle && $vehicle->stok > 0) {
                    $vehicle->decrement('stok');   // stok -1
                } else {
                    throw new \RuntimeException('Stok kendaraan habis; transaksi dibatalkan.');
                }
            });
        }
    }
}
