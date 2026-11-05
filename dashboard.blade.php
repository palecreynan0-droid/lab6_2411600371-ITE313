<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hardware Inventory Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-gray-500">Total Products</h3>
                    <p class="text-3xl font-bold">
                        {{ $totalProducts }}
                    </p>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-gray-500">Total Stock</h3>
                    <p class="text-3xl font-bold">
                        {{ $totalStock }}
                    </p>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-gray-500">Low Stock</h3>
                    <p class="text-3xl font-bold text-red-600">
                        {{ $lowStock }}
                    </p>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-gray-500">Inventory Value</h3>
                    <p class="text-3xl font-bold">
                        ₱{{ number_format($inventoryValue, 2) }}
                    </p>
                </div>

            </div>

<div class="mt-6 bg-white p-6 shadow-sm sm:rounded-lg">

    <h3 class="text-lg font-semibold text-red-600 mb-4">
        ⚠ Low Stock Alerts
    </h3>

    @if($lowStockProducts->count() > 0)

        @foreach($lowStockProducts as $product)
            <div class="border-b py-3">
                <strong>{{ $product->name }}</strong>
                <span class="text-red-600">
                    — Only {{ $product->quantity }} left
                </span>
                <span class="text-gray-500">
                    (Reorder level: {{ $product->reorder_level }})
                </span>
            </div>
        @endforeach

    @else
        <p class="text-green-600">
            ✓ All products have enough stock.
        </p>
    @endif

    <div class="mt-5">
        <a href="{{ route('products.index') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            View Products
        </a>
    </div>

</div>

        </div>
    </div>
</x-app-layout>