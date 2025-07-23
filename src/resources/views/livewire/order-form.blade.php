<div>
    <h2 class="text-xl font-bold mb-4">Form Pemesanan</h2>
    
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <label>Nama Pelanggan</label>
            <input type="text" wire:model="customer_name" class="border p-2 w-full">
            @error('customer_name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>No. Telepon</label>
            <input type="text" wire:model="phone" class="border p-2 w-full">
            @error('phone') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Alamat</label>
            <textarea wire:model="address" class="border p-2 w-full"></textarea>
            @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Catatan</label>
            <textarea wire:model="note" class="border p-2 w-full"></textarea>
        </div>

        <div class="mt-4">
            <h3 class="font-semibold mb-2">Menu</h3>
            @foreach ($menus as $menu)
                <div class="flex justify-between items-center mb-2">
                    <div>{{ $menu->name }} - Rp {{ number_format($menu->price) }}</div>
                    <input type="number" min="0" wire:model="quantities.{{ $menu->id }}" class="w-16 border p-1">
                </div>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Pesan Sekarang</button>
    </form>
</div>
