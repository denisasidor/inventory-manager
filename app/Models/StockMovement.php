<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\LowStockAlert;


class StockMovement extends Model
{

    protected static function booted(): void
    {
        static::created(function (StockMovement $movement) {
            $item = $movement->item;

            if ($movement->type === 'in') {
                $item->quantity += $movement->quantity;
            } elseif ($movement->type === 'out') {
                $item->quantity -= $movement->quantity;

                if ($item->quantity < 0) {
                    $item->quantity = 0;
                }
                if ($item->quantity < 10) {
                    Mail::to('denisasidor13@gmail.com')->send(new LowStockAlert($item));}
            }

            $item->save();
        });
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected $fillable = [
        'item_id',
        'type',
        'quantity',

    ];
}
