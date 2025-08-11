<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductImageResource\Pages;
use App\Filament\Resources\ProductImageResource\RelationManagers;
use App\Models\Product_image;
use App\Models\ProductImage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductImageResource extends Resource
{
    protected static ?string $model = Product_image::class;

    protected static ?string $navigationIcon = 'heroicon-s-rectangle-group';

    protected static ?string $navigationGroup = 'Products';
    protected static ?string $navigationLabel = 'Gambar Produk';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                Forms\Components\Select::make('media_type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->required()
                    ->default('image')
                    ->live(), // <-- [PENTING] Membuat form reaktif

                // Field untuk upload gambar, hanya muncul jika media_type = 'image'
                Forms\Components\FileUpload::make('image')
                    ->label('Upload Gambar')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('product-media')
                    ->required()
                    ->visible(fn(Get $get) => $get('media_type') === 'image'),

                // Field untuk upload video, hanya muncul jika media_type = 'video'
                Forms\Components\FileUpload::make('image') // Tetap 'image' karena nama kolomnya sama
                    ->label('Upload Video')
                    ->disk('public')
                    ->directory('product-media')
                    ->acceptedFileTypes(['video/mp4', 'video/quicktime', 'video/webm'])
                    ->required()
                    ->visible(fn(Get $get) => $get('media_type') === 'video'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->searchable()
                    ->sortable(),

                // Menampilkan preview gambar atau video
                Tables\Columns\ImageColumn::make('image')
                    ->label('Preview'),
                    // ->view('tables.columns.media-preview'), // Kita akan buat view custom ini

                Tables\Columns\BadgeColumn::make('media_type')
                    ->colors([
                        'primary' => 'image',
                        'success' => 'video',
                    ])
                    ->formatStateUsing(fn($state) => ucfirst($state)), // jadi 'Image' atau 'Video'
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
            'index' => Pages\ListProductImages::route('/'),
            'create' => Pages\CreateProductImage::route('/create'),
            'edit' => Pages\EditProductImage::route('/{record}/edit'),
        ];
    }
}
