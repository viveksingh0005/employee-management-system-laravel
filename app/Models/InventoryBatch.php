<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryBatch extends Model
{
    use HasFactory;

    protected $fillable = ['site_name', 'date_received'];

    public function items()
    {
        return $this->hasMany(InventoryItem::class, 'batch_id');
    }
}
