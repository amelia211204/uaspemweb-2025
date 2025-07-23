<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Order;
class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Order::create([
            'customer_name' => 'Budi Santoso',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'note' => 'Minta pedas ya!',
        ]);

        Order::create([
            'customer_name' => 'Siti Aminah',
            'phone' => '089876543210',
            'address' => 'Jl. Mangga Dua No. 45, Bandung',
            'note' => 'Tanpa sambal.',
        ]);
    }
}
