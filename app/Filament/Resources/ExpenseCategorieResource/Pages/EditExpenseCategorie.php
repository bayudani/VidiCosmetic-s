<?php

namespace App\Filament\Resources\ExpenseCategorieResource\Pages;

use App\Filament\Resources\ExpenseCategorieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExpenseCategorie extends EditRecord
{
    protected static string $resource = ExpenseCategorieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
