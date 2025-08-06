<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreGaleryResource\Pages;
use App\Filament\Resources\StoreGaleryResource\RelationManagers;
use App\Models\Store_galery;
use App\Models\StoreGalery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreGaleryResource extends Resource
{
    protected static ?string $model = Store_galery::class;

    protected static ?string $navigationIcon = 'heroicon-c-camera';
    protected static ?string $navigationLabel = 'Galeri Toko';
    protected static ?string $navigationGroup = 'Galeri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoreGaleries::route('/'),
            'create' => Pages\CreateStoreGalery::route('/create'),
            'edit' => Pages\EditStoreGalery::route('/{record}/edit'),
        ];
    }
}
