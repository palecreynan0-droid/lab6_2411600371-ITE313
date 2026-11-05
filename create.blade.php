<!DOCTYPE html>
<html>
<head>
    <title>Add Product - Hardware Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-4xl mx-auto p-6">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Add Product
        </h1>

        <p class="text-gray-500">
            Add a new hardware product to your inventory
        </p>
    </div>

    @if($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-5">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow p-6">

        <form action="{{ route('products.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-gray-600 mb-1">
                        Product Name
                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full border rounded-lg p-2"
                           required>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        SKU
                    </label>

                    <input type="text"
                           name="sku"
                           value="{{ old('sku') }}"
                           class="w-full border rounded-lg p-2"
                           required>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        Category
                    </label>

                    <input type="text"
                           name="category"
                           value="{{ old('category') }}"
                           class="w-full border rounded-lg p-2"
                           placeholder="Example: Hardware"
                           required>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        Supplier
                    </label>

                    <input type="text"
                           name="supplier"
                           value="{{ old('supplier') }}"
                           class="w-full border rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        Quantity
                    </label>

                    <input type="number"
                           name="quantity"
                           value="{{ old('quantity', 0) }}"
                           min="0"
                           class="w-full border rounded-lg p-2"
                           required>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        Reorder Level
                    </label>

                    <input type="number"
                           name="reorder_level"
                           value="{{ old('reorder_level', 10) }}"
                           min="0"
                           class="w-full border rounded-lg p-2"
                           required>
                </div>

                <div>
                    <label class="block text-gray-600 mb-1">
                        Unit Price
                    </label>

                    <input type="number"
                           name="unit_price"
                           value="{{ old('unit_price') }}"
                           min="0"
                           step="0.01"
                           class="w-full border rounded-lg p-2"
                           required>
                </div>

            </div>

            <div class="mt-5">

                <label class="block text-gray-600 mb-1">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="w-full border rounded-lg p-2">{{ old('description') }}</textarea>

            </div>

            <div class="mt-6 flex gap-3">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Add Product
                </button>

                <a href="{{ route('products.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>