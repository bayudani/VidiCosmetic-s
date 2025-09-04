<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnerProfileResource\Pages;
use App\Filament\Resources\OwnerProfileResource\RelationManagers;
use App\Models\OwnerProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OwnerProfileResource extends Resource
{
    protected static ?string $model = OwnerProfile::class;

    protected static ?string $navigationIcon = 'heroicon-c-user-circle';

    protected static ?string $navigationGroup = 'Owner Area';
    protected static ?string $navigationLabel = 'Profil Pemilik';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                // photo
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Profil')
                    ->image()
                    ->disk('public')
                    ->directory('owner_profiles')
                    ->nullable(),
                Forms\Components\Textarea::make('quotes')
                    ->label('Quotes')
                    ->nullable()
                    ->rows(3),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                // Forms\Components\TextInput::make('address')
                //     ->nullable()
                //     ->maxLength(200),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                // photo
                Tables\Columns\ImageColumn::make('photo')
                    ->disk('public')
                    ->circular()
                    ->size(50),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('quotes')
                    ->label('Quotes')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListOwnerProfiles::route('/'),
            'create' => Pages\CreateOwnerProfile::route('/create'),
            'edit' => Pages\EditOwnerProfile::route('/{record}/edit'),
        ];
    }
}
