<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryTransactionController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'transaction_type' => 'required|in:stock_in,stock_out',
            'quantity' => 'required|integer|min:1',
            'reference' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated, $product) {

            if (
                $validated['transaction_type'] === 'stock_out' &&
                $validated['quantity'] > $product->quantity
            ) {
                abort(422, 'Not enough stock available.');
            }

            if ($validated['transaction_type'] === 'stock_in') {
                $product->increment('quantity', $validated['quantity']);
            } else {
                $product->decrement('quantity', $validated['quantity']);
            }

            InventoryTransaction::create([
                'product_id' => $product->id,
                'transaction_type' => $validated['transaction_type'],
                'quantity' => $validated['quantity'],
                'reference' => $validated['reference'],
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Inventory transaction recorded successfully.');
    }
}