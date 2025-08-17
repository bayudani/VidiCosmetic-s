<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchedulesResource\Pages;
use App\Filament\Resources\SchedulesResource\RelationManagers;
use App\Models\Schedules;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchedulesResource extends Resource
{
    protected static ?string $model = Schedules::class;

    // protected static ?string $navigationIcon = 'heroicon-o-clock';
    // di SchedulesResource.php
    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Atur Jadwal';
    protected static ?string $navigationGroup = 'Konsultasi';
    // UBAH JADI GINI
    // protected static ?string $navigationParentItem = 'Daftar Konsultasi';

    // parent item

    public static function canAccess(): bool
    {
        return auth()->user()->hasRole('owner');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('day_of_week')
                    ->label('Hari')
                    ->options([
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Minggu',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->label('Jam Mulai')
                    ->seconds(false)
                    ->displayFormat('H:i') // <-- PASTIKAN INI ADA
                    ->required(),
                Forms\Components\TimePicker::make('end_time')
                    ->label('Jam Selesai')
                    ->seconds(false)
                    ->displayFormat('H:i') // <-- PASTIKAN INI ADA
                    ->required(),
                Forms\Components\Toggle::make('is_active')->label('Aktifkan Jadwal Ini')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('Hari')
                    ->formatStateUsing(fn(int $state): string => [
                        1 => 'Senin',
                        2 => 'Selasa',
                        3 => 'Rabu',
                        4 => 'Kamis',
                        5 => 'Jumat',
                        6 => 'Sabtu',
                        7 => 'Minggu'
                    ][$state] ?? '')
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_time')->label('Mulai')->time('H:i'),
                Tables\Columns\TextColumn::make('end_time')->label('Selesai')->time('H:i'),
                Tables\Columns\IconColumn::make('is_active')->label('Status')->boolean(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSchedules::route('/'),
            'create' => Pages\CreateSchedules::route('/create'),
            'edit' => Pages\EditSchedules::route('/{record}/edit'),
        ];
    }
}
