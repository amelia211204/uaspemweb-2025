<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?string $pluralLabel = 'Pesanan';
    protected static ?string $navigationGroup = 'Restoran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('customer_name')
                    ->label('Nama Pemesan')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('phone')
                    ->label('No. HP')
                    ->tel()
                    ->required()
                    ->maxLength(20),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat')
                    ->rows(3)
                    ->required(),

                Forms\Components\Textarea::make('note')
                    ->label('Catatan')
                    ->rows(2)
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pemesan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('No. HP'),

                Tables\Columns\TextColumn::make('address')
                    ->label('Alamat')
                    ->limit(30),

                Tables\Columns\TextColumn::make('note')
                    ->label('Catatan')
                    ->limit(30),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Jumlah Item')
                    ->counts('items'),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total Harga')
                    ->getStateUsing(fn ($record) => $record->items->sum('subtotal'))
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal Pesan')
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
        return []; // Tidak menggunakan Relation Manager
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
