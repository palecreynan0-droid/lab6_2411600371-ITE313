<!DOCTYPE html>
<html>
<head>
    <title>Inventory Reports</title>
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
</head>
<body>

    <h1>Inventory Reports</h1>

    <hr>

    <h2>Summary</h2>

    <p><strong>Total Products:</strong> {{ $totalProducts }}</p>

    <p><strong>Total Stock:</strong> {{ $totalStock }}</p>

    <p>
        <strong>Total Inventory Value:</strong>
        ₱{{ number_format($inventoryValue, 2) }}
    </p>

    <hr>

    <h2>Low Stock Products</h2>

    @if($lowStockProducts->count() > 0)

        <table border="1" cellpadding="8">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Reorder Level</th>
            </tr>

            @foreach($lowStockProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->reorder_level }}</td>
                </tr>
            @endforeach
        </table>

    @else
        <p>No low stock products.</p>
    @endif

    <hr>

    <h2>Stock by Category</h2>

    <table border="1" cellpadding="8">
        <tr>
            <th>Category</th>
            <th>Total Quantity</th>
            <th>Total Value</th>
        </tr>

        @foreach($categoryReport as $category)
            <tr>
                <td>{{ $category->category }}</td>
                <td>{{ $category->total_quantity }}</td>
                <td>₱{{ number_format($category->total_value, 2) }}</td>
            </tr>
        @endforeach
    </table>

    <br>

    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
    |
    <a href="{{ route('products.index') }}">Products</a>

</body>
</html>