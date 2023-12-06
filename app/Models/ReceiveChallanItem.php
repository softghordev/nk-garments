<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class ReceiveChallanItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function challan()
    {
        return $this->belongsTo(ReceiveChallan::class,'receive_challan_id');
    }

    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }

    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'item_variation_id');
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    public static function boot()
    {
        parent::boot();
        // for created & updated
        static::saved(function($item){
            $item->items->update_calculated_data();
        });

        static::deleted(function ($purchase_item) {
            $purchase_item->items->update_calculated_data();
        });

    }
}
