<?php

namespace App\Filament\Resources\StoreGaleryResource\Pages;

use App\Filament\Resources\StoreGaleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoreGaleries extends ListRecords
{
    protected static string $resource = StoreGaleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
