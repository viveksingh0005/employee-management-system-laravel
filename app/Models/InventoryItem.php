<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['batch_id', 'product_name', 'cost', 'quantity'];

    public function batch()
    {
        return $this->belongsTo(InventoryBatch::class, 'batch_id');
    }
      public function getTotalAttribute()
    {
        // Sum of (cost * quantity) for each item
        return $this->items->sum(function($item) {
            return $item->cost * $item->quantity;
        });
    }
}
