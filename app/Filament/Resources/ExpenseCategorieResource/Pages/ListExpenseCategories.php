<?php

namespace App\Filament\Resources\ExpenseCategorieResource\Pages;

use App\Filament\Resources\ExpenseCategorieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExpenseCategories extends ListRecords
{
    protected static string $resource = ExpenseCategorieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
