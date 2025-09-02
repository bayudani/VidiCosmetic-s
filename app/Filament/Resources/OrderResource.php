<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;
use Illuminate\Database\Eloquent\Collection;


class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $navigationGroup = 'Transaksi';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['user', 'items.product']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Detail Pesanan')
                        ->schema([
                            Forms\Components\TextInput::make('order_number')->label('Order Number')->disabled(),
                            Forms\Components\TextInput::make('user.name')->label('Nama Customer')->disabled(),
                            Forms\Components\Textarea::make('shipping_address')->label('Alamat Pengiriman')->columnSpanFull()->disabled(),
                            Forms\Components\Select::make('order_status')
                                ->label('Status Pesanan')
                                ->options([
                                    'pending' => 'Pending',
                                    'processing' => 'Processing',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->required(),
                            Forms\Components\Select::make('payment_status')
                                ->label('Status Pembayaran')
                                ->options([
                                    'unpaid' => 'Unpaid',
                                    'paid' => 'Paid',
                                    'failed' => 'Failed',
                                ])
                                ->required(),
                        ])->columns(2),
                    Forms\Components\Wizard\Step::make('Item Pesanan')
                        ->schema([
                            Forms\Components\Repeater::make('items')
                                ->relationship()
                                ->schema([
                                    Forms\Components\Select::make('product_id')
                                        ->label('Produk')
                                        ->relationship('product', 'name')
                                        ->searchable()
                                        ->disabled(),
                                    Forms\Components\TextInput::make('quantity')->numeric()->disabled(),
                                    Forms\Components\TextInput::make('price')->label('Harga Satuan')->numeric()->disabled(),
                                ])->columns(3),
                        ]),
                    Forms\Components\Wizard\Step::make('Bukti Pembayaran')
                        ->schema([
                            Forms\Components\ViewField::make('proof_of_transaction_preview')
                                ->label('')
                                ->view('filament.components.display')
                        ]),
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_number')->label('Order ID')->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('Customer')->searchable(),
                Tables\Columns\TextColumn::make('total_amount')->label('Total')->money('IDR')->sortable(),
                Tables\Columns\BadgeColumn::make('order_status')
                    ->label('Status Pesanan')
                    ->colors([
                        'warning' => 'pending',
                        'primary' => 'processing',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                    ]),
                Tables\Columns\BadgeColumn::make('payment_status')
                    ->label('Status Pembayaran')
                    ->colors([
                        'warning' => 'unpaid',
                        'success' => 'paid',
                        'danger' => 'failed',
                    ]),
                Tables\Columns\TextColumn::make('created_at')->label('Tanggal')->dateTime('d M Y')->sortable(),
            ])
            ->filters([

                SelectFilter::make('order_status')
                    ->label('Status Pesanan')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ]),
                SelectFilter::make('payment_status')
                    ->label('Status Pembayaran')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ]),

                SelectFilter::make('created_at')
                    ->label('Tanggal Pesanan')
                    ->options([
                        'today' => 'Hari Ini',
                        'week' => 'Minggu Ini',
                        'month' => 'Bulan Ini',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['value'],
                            function (Builder $query, $value) {
                                if ($value === 'today') {
                                    $query->whereDate('created_at', today());
                                } elseif ($value === 'week') {
                                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                                } elseif ($value === 'month') {
                                    $query->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()]);
                                }
                            }
                        );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->label('Detail'),
                Tables\Actions\EditAction::make()->label('Ubah Status'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('confirm_payment')
                        ->label('Konfirmasi Pembayaran')
                        ->action(fn(Order $record) => $record->update(['payment_status' => 'paid']))
                        ->requiresConfirmation()
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->visible(fn(Order $record) => $record->payment_status === 'unpaid'),

                    Tables\Actions\Action::make('mark_as_completed')
                        ->label('Tandai Pengiriman')
                        ->action(fn(Order $record) => $record->update(['order_status' => 'processing']))
                        ->requiresConfirmation()
                        ->color('primary')
                        ->icon('heroicon-o-truck')
                        ->visible(fn(Order $record) => $record->order_status === 'pending'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export')
                ]),
            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
                    ->label('Ekspor Laporan')
                    ->withColumns([
                        Tables\Columns\TextColumn::make('items_list')
                            ->label('Rincian Produk')
                            ->getStateUsing(function (Order $record) {
                                if (!$record->relationLoaded('items')) {
                                    $record->load('items.product');
                                }
                                return $record->items->map(function ($item) {
                                    return "{$item->product->name} (x{$item->quantity})";
                                })->implode('; ');
                            }),
                        // GRAND TOTAL hanya ada di paling bawah
                        Tables\Columns\TextColumn::make('grand_total')->label('Grand Total')->getStateUsing(function (Order $record) {
                            return Order::sum('total_amount');
                        })
                    ])
                   
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
