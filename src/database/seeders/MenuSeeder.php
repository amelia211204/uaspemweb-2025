<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['name' => 'Ayam Bakar Taliwang', 'description' => 'Ayam khas Lombok dengan bumbu pedas manis.', 'price' => 35000],
            ['name' => 'Rendang Padang', 'description' => 'Daging sapi dimasak dengan santan dan rempah khas Minang.', 'price' => 40000],
            ['name' => 'Soto Betawi', 'description' => 'Soto dengan kuah santan khas Betawi.', 'price' => 30000],
            ['name' => 'Gudeg Yogyakarta', 'description' => 'Nangka muda manis khas Jogja.', 'price' => 28000],
            ['name' => 'Sambal Matah', 'description' => 'Sambal khas Bali dengan irisan bawang dan cabe segar.', 'price' => 8000],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }   
    }
}
