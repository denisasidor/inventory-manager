<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'location',
        'price',

    ];
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

}
