<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderItemResource\Pages;
use App\Models\OrderItem;
use App\Models\Menu;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Item Pesanan';
    protected static ?string $pluralLabel = 'Detail Pesanan';
    protected static ?string $navigationGroup = 'Restoran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('order_id')
                    ->label('ID Pesanan')
                    ->relationship('order', 'customer_name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('menu_id')
                    ->label('Menu')
                    ->relationship('menu', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Kuantitas')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                Forms\Components\TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->prefix('Rp')
                    ->numeric()
                    ->required()
                    ->disabled(fn ($get) => true), // opsional jika ingin readonly
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.customer_name')
                    ->label('Pemesan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('menu.name')
                    ->label('Menu')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Kuantitas'),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dipesan Pada')
                    ->dateTime('d M Y H:i'),
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
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
