<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InventoryTransaction;

class Product extends Model
{
       protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'quantity', 
        'reorder_level',
        'unit_price',
        'supplier',
    ];

    public function isLowStock()
{
    return $this->quantity <= $this->reorder_level;
}

public function inventoryTransactions()
{
    return $this->hasMany(InventoryTransaction::class);
}
}
