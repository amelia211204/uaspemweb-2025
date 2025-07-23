<?php
namespace App\Livewire;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class OrderForm extends Component
{
    public $menus;
    public $quantities = [];
    public $customer_name;
    public $phone;
    public $address;
    public $note;

    public function mount()
    {
        $this->menus = Menu::all();
        foreach ($this->menus as $menu) {
            $this->quantities[$menu->id] = 0;
        }
    }

    public function submit()
    {
        $this->validate([
            'customer_name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $order = Order::create([
            'customer_name' => $this->customer_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'note' => $this->note,
        ]);

        foreach ($this->quantities as $menuId => $quantity) {
            if ($quantity > 0) {
                $menu = Menu::find($menuId);
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $menuId,
                    'quantity' => $quantity,
                    'subtotal' => $menu->price * $quantity,
                ]);
            }
        }

        session()->flash('success', 'Pesanan berhasil dikirim!');
        return redirect()->route('order.success');
    }

    public function render()
    {
        return view('livewire.order-form');
    }
}
