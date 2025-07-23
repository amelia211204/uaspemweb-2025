<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Menampilkan semua order beserta item dan menu-nya
     */
    public function index()
    {
        $orders = Order::with('items.menu')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $orders
        ]);
    }

    /**
     * Menyimpan order baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'note' => 'nullable|string',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1'
        ]);

        DB::beginTransaction();

        try {
            // Simpan data order utama
            $order = Order::create([
                'customer_name' => $request->customer_name,
                'phone' => $request->phone,
                'address' => $request->address,
                'note' => $request->note,
            ]);

            // Simpan detail item
            foreach ($request->items as $item) {
                $menu = Menu::findOrFail($item['menu_id']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menu->id,
                    'quantity' => $item['quantity'],
                    'subtotal' => $menu->price * $item['quantity'],
                ]);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Order created successfully',
                'data' => $order->load('items.menu')
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create order',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
