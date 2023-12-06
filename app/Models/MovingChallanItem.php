<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovingChallanItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function challan()
    {
        return $this->belongsTo(MovingChallan::class,'moving_challan_id');
    }

    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }

    public static function boot()
    {
        parent::boot();
        // for created & updated
        static::saved(function($item){
            $item->items->update_calculated_data();
        });

        static::deleted(function ($challan_item) {
            $challan_item->items->update_calculated_data();
        });

    }
}
