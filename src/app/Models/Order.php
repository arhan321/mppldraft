<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Order extends Model
{
    protected $fillable = [
        'user_id',
        'vehicle_id',
        'tanggal_order',
        'status',
        'total_harga',
        'payment_method',
        'payment_amount',
        'payment_date',
        'payment_proof',
        'payment_notes',
        'payment_verified_at',
        'payment_rejected_at'
    ];

    protected $casts = [
        'tanggal_order' => 'date',
        'payment_details' => 'array',
        'payment_date' => 'date',
        'payment_proof' => 'string',
        'payment_verified_at' => 'datetime',
        'payment_rejected_at' => 'datetime',
    ];

    public function setPaymentProofAttribute($value)
    {
        // Jika upload baru, simpan sebagai path relative
        if ($value instanceof \Livewire\Features\SupportFileUploads\TemporaryUploadedFile) {
            $this->attributes['payment_proof'] = 'payment-proofs/' . $value->hashName();
        }
        // Jika dari form edit, simpan sebagai nama file saja
        elseif (is_string($value)) {
            $this->attributes['payment_proof'] = basename($value);
        }
    }

//    protected static function booted(): void
//     {
//         // Saat ORDER akan dibuat
//         static::creating(function (Order $order) {

//             // Jalankan di dalam transaksi DB
//             DB::transaction(function () use ($order) {

//                 /* ——— KUNCI baris kendaraan ——— */
//                 $vehicle = $order->vehicle()      // relasi belongsTo
//                     ->lockForUpdate()
//                     ->firstOrFail();

//                 if ($vehicle->stok <= 0) {
//                     // Gagal: stok habis ➜ lempar validasi agar Filament
//                     // otomatis menampilkan error di form
//                     throw ValidationException::withMessages([
//                         'vehicle_id' => 'Stok kendaraan habis.',
//                     ]);
//                 }

//                 /* ——— Kurangi stok & simpan ——— */
//                 $vehicle->decrement('stok');
//             });
//         });

//         // (opsional) saat ORDER di-hapus ⇒ kembalikan stok
//         static::deleted(function (Order $order) {
//             $order->vehicle()->increment('stok');
//         });
//     }

    protected static function booted(): void
    {
        /** ----------------------------------------------------------------
         *  CREATE  ➜ stok –1
         * ---------------------------------------------------------------- */
        static::creating(function (Order $order) {
            self::withdrawStock($order->vehicle_id);
        });

        /** ----------------------------------------------------------------
         *  UPDATE  ➜   • ganti mobil?      → stok lama +1, stok baru –1  
         *              • status → ditolak  → stok +1  
         *              • status dari ditolak → aktif → stok –1
         * ---------------------------------------------------------------- */
        static::updating(function (Order $order) {
            $oldVehicleId  = $order->getOriginal('vehicle_id');
            $newVehicleId  = $order->vehicle_id;
            $oldStatus     = $order->getOriginal('status');
            $newStatus     = $order->status;

            DB::transaction(function () use (
                $oldVehicleId, $newVehicleId, $oldStatus, $newStatus
            ) {

                // ① Jika kendaraan diganti
                if ($oldVehicleId !== $newVehicleId) {
                    self::returnStock($oldVehicleId);
                    self::withdrawStock($newVehicleId);
                } else {
                    // ② Kendaraan sama, tapi status berubah
                    if ($oldStatus !== 'ditolak' && $newStatus === 'ditolak') {
                        self::returnStock($newVehicleId);
                    }

                    if ($oldStatus === 'ditolak' && $newStatus !== 'ditolak') {
                        self::withdrawStock($newVehicleId);
                    }
                }
            });
        });

        /** ----------------------------------------------------------------
         *  DELETE  ➜ stok +1
         * ---------------------------------------------------------------- */
        static::deleted(function (Order $order) {
            self::returnStock($order->vehicle_id);
        });
    }

    /* ────────────────────────────────────────────────
     |  Helper terkapsulasi: tarik & kembalikan stok
     ────────────────────────────────────────────────*/
    private static function withdrawStock(int $vehicleId): void
    {
        DB::transaction(function () use ($vehicleId) {
            $vehicle = Vehicle::whereKey($vehicleId)->lockForUpdate()->firstOrFail();

            if ($vehicle->stok <= 0) {
                throw ValidationException::withMessages([
                    'vehicle_id' => 'Stok kendaraan habis.',
                ]);
            }

            $vehicle->decrement('stok');
        });
    }

    private static function returnStock(int $vehicleId): void
    {
        Vehicle::whereKey($vehicleId)
            ->lockForUpdate()
            ->increment('stok');
    }

    public function getPaymentProofUrlAttribute()
    {
        if (!$this->payment_proof) return null;
        return asset('storage/payment-proofs/' . basename($this->payment_proof));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function salesReport(): HasOne
    {
        return $this->hasOne(SalesReport::class);
    }

    public function scopePendingPayment($query)
    {
        return $query->where('status', 'pending')->whereNotNull('payment_proof');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(OrderPayment::class);
    }
}
