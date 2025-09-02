<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExpenseResource\Pages;
use App\Filament\Resources\ExpenseResource\RelationManagers;
use App\Models\Expense;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExpenseResource extends Resource
{
    protected static ?string $model = Expense::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationLabel = 'Input Pengeluaran';
    protected static ?string $navigationGroup = 'Owner Area';

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('owner');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('expense_category_id')
                    ->label('Kategori Pengeluaran')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('description')->label('Keterangan')->required(),
                Forms\Components\TextInput::make('amount')->label('Jumlah')->numeric()->prefix('Rp')->required(),
                Forms\Components\DatePicker::make('expense_date')->label('Tanggal Pengeluaran')->required()->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('expense_date')->label('Tanggal')->date('d M Y')->sortable(),
                Tables\Columns\TextColumn::make('category.name')->label('Kategori Pengeluaran')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('description')->label('Keterangan')->searchable(),
                Tables\Columns\TextColumn::make('amount')->label('Jumlah')->money('IDR')->sortable(),
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
            'index' => Pages\ListExpenses::route('/'),
            'create' => Pages\CreateExpense::route('/create'),
            'edit' => Pages\EditExpense::route('/{record}/edit'),
        ];
    }
}
