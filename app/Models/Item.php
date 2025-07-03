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
        'company_id',
    ];
    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}
