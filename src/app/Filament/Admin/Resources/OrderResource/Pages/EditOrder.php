<?php

namespace App\Filament\Admin\Resources\OrderResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\OrderResource;

class EditOrder extends EditRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
{
    // status lama vs status baru
    $statusLama = $this->record->status ?? null;
    $statusBaru = $data['status'] ?? $statusLama;

    if ($statusLama !== 'dibayar' && $statusBaru === 'dibayar') {
        DB::transaction(function () {
            $this->record->vehicle()
                ->lockForUpdate()
                ->decrement('stok');
        });
    }

    return $data;
}
}
