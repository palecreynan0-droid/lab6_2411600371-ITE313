<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        $totalStock = Product::sum('quantity');

        $inventoryValue = Product::sum(
            DB::raw('quantity * unit_price')
        );

        $lowStockProducts = Product::whereColumn(
            'quantity',
            '<=',
            'reorder_level'
        )->orderBy('quantity')->get();

        $categoryReport = Product::select(
            'category',
            DB::raw('SUM(quantity) as total_quantity'),
            DB::raw('SUM(quantity * unit_price) as total_value')
        )
        ->groupBy('category')
        ->orderBy('category')
        ->get();

        return view('reports.index', compact(
            'totalProducts',
            'totalStock',
            'inventoryValue',
            'lowStockProducts',
            'categoryReport'
        ));
    }
}