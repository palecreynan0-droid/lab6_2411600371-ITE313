<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-5xl mx-auto p-6">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Product Details
            </h1>
            <p class="text-gray-500">
                View product and inventory information
            </p>
        </div>

        <a href="{{ route('products.index') }}"
           class="text-blue-600 hover:underline">
            ← Back to Products
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-2xl font-semibold mb-5">
            {{ $product->name }}
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <p class="text-gray-500">SKU</p>
                <p class="font-semibold">{{ $product->sku }}</p>
            </div>

            <div>
                <p class="text-gray-500">Category</p>
                <p class="font-semibold">{{ $product->category }}</p>
            </div>

            <div>
                <p class="text-gray-500">Quantity</p>

                @if($product->isLowStock())
                    <p class="text-red-600 font-bold">
                        {{ $product->quantity }} ⚠ Low Stock
                    </p>
                @else
                    <p class="text-green-600 font-bold">
                        {{ $product->quantity }}
                    </p>
                @endif
            </div>

            <div>
                <p class="text-gray-500">Reorder Level</p>
                <p class="font-semibold">
                    {{ $product->reorder_level }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Unit Price</p>
                <p class="font-semibold">
                    ₱{{ number_format($product->unit_price, 2) }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Supplier</p>
                <p class="font-semibold">
                    {{ $product->supplier }}
                </p>
            </div>

        </div>

        <div class="mt-5">
            <p class="text-gray-500">Description</p>
            <p class="mt-1">
                {{ $product->description ?? 'No description available.' }}
            </p>
        </div>

    </div>

    <div class="bg-white rounded-xl shadow p-6 mt-6">

        <h2 class="text-xl font-semibold mb-5">
            Inventory Transaction
        </h2>

        <form action="{{ route('transactions.store', $product) }}"
              method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-gray-600 mb-1">
                        Transaction Type
                    </label>

                    <select name="transaction_type"
                            class="w-full border rounded-lg p-2"
                            required>

                        <option value="stock_in">
                            Stock In
                        </option>

                        <option value="stock_out">
                            Stock Out
                        </option>

                    </select>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        Quantity
                    </label>

                    <input type="number"
                           name="quantity"
                           min="1"
                           class="w-full border rounded-lg p-2"
                           required>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        Reference
                    </label>

                    <input type="text"
                           name="reference"
                           placeholder="Purchase Order"
                           class="w-full border rounded-lg p-2">
                </div>

            </div>

            <button type="submit"
                    class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                Record Transaction
            </button>

        </form>

    </div>

    <div class="bg-white rounded-xl shadow p-6 mt-6">

        <h2 class="text-xl font-semibold mb-5">
            Transaction History
        </h2>

        @if($product->inventoryTransactions->count() > 0)

            <div class="overflow-x-auto">

                <table class="w-full text-left">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3">Type</th>
                            <th class="p-3">Quantity</th>
                            <th class="p-3">Reference</th>
                            <th class="p-3">Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($product->inventoryTransactions()->latest()->get() as $transaction)

                            <tr class="border-t">

                                <td class="p-3">
                                    @if($transaction->transaction_type === 'stock_in')
                                        <span class="text-green-600 font-semibold">
                                            Stock In
                                        </span>
                                    @else
                                        <span class="text-red-600 font-semibold">
                                            Stock Out
                                        </span>
                                    @endif
                                </td>

                                <td class="p-3">
                                    {{ $transaction->quantity }}
                                </td>

                                <td class="p-3">
                                    {{ $transaction->reference ?? 'N/A' }}
                                </td>

                                <td class="p-3">
                                    {{ $transaction->created_at->format('M d, Y h:i A') }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <p class="text-gray-500">
                No transactions recorded yet.
            </p>

        @endif

    </div>

    <div class="mt-6 flex gap-3">

        <a href="{{ route('products.edit', $product) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
            Edit Product
        </a>

        <a href="{{ route('products.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
            Back to Products
        </a>

    </div>

</div>

</body>
</html>