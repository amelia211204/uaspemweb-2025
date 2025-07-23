<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\OrderItem;
use App\Models\Order;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $menu1 = Menu::where('name', 'Ayam Bakar Taliwang')->first();
        $menu2 = Menu::where('name', 'Rendang Padang')->first();
        $menu3 = Menu::where('name', 'Soto Betawi')->first();

        $order1 = Order::first(); // Budi Santoso
        $order2 = Order::skip(1)->first(); // Siti Aminah

        OrderItem::create([
            'order_id' => $order1->id,
            'menu_id' => $menu1->id,
            'quantity' => 2,
            'subtotal' => $menu1->price * 2,
        ]);

        OrderItem::create([
            'order_id' => $order1->id,
            'menu_id' => $menu3->id,
            'quantity' => 1,
            'subtotal' => $menu3->price,
        ]);

        OrderItem::create([
            'order_id' => $order2->id,
            'menu_id' => $menu2->id,
            'quantity' => 3,
            'subtotal' => $menu2->price * 3,
        ]);
    }
}
