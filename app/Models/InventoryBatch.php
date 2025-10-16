<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBatch extends Model
{
    use HasFactory;

    protected $fillable = ['site_name', 'date_received', 'total', 'received_by'];

    public function items()
    {
        return $this->hasMany(InventoryItem::class, 'batch_id');
    }
    public function employee()
{
    return $this->belongsTo(Employee::class, 'received_by');
}
  public function getTotalAttribute()
    {
        // Sum of (cost * quantity) for each item
        return $this->items->sum(function($item) {
            return $item->cost * $item->quantity;
        });
    }
}
