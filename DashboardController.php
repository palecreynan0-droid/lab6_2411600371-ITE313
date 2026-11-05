<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('quantity');

        $lowStockProducts = Product::whereColumn(
            'quantity',
            '<=',
            'reorder_level'
        )
            ->orderBy('quantity')
            ->get();

        $lowStock = $lowStockProducts->count();

        $inventoryValue = Product::sum(
            DB::raw('quantity *  unit_price')
        );

        return view('dashboard', compact(
            'totalProducts',
            'totalStock',
            'lowStock',
            'inventoryValue',
            'lowStockProducts'
        ));
    }
}