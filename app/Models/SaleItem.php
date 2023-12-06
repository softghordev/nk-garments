<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }

    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'item_variation_id');
    }

    public static function boot()
    {
        parent::boot();
        // for created & updated
        static::saved(function($item){
            $item->items->update_calculated_data();
        });

        static::deleted(function ($sale_item) {
            $sale_item->items->update_calculated_data();
        });
    }
    
}
