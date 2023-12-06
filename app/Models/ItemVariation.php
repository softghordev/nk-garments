<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVariation extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function item()
    {
        return $this->belongsTo(items::class,'item_id');
    }

    
    public function item_color()
    {
        return $this->belongsTo(ItemColor::class,'item_color_id');
    }

    public function item_size()
    {
        return $this->belongsTo(ItemSize::class,'item_size_id');
    }


    public function purchase_items()
    {
        return $this->hasMany(PurchaseItem::class);
    }


    /****** CUSTOM FUNCTIONS ******/


    public function sale_count($size_id = null)
    {
        $qty = SaleItem::where('item_variation_id', $this->id)->where('department_id', session('department'));
        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id)->where('department_id', session('department'));
        }

        return $qty->sum('qty');
    }

    public function delivery_challan_count($size_id = null)
    {
        $qty = DeliveryChallanItem::where('item_variation_id', $this->id)->where('department_id', session('department'));

        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id)->where('department_id', session('department'));
        }

        return $qty->sum('qty');
    }

    public function receive_challan_count($size_id = null)
    {
        $qty = ReceiveChallanItem::where('item_variation_id', $this->id)->where('department_id', session('department'));
        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id)->where('department_id', session('department'));
        }

        return $qty->sum('qty');
    }


    public function stock()
    {
        $receive_challan=$this->receive_challan_count();
        $sold=$this->sale_count();
        $delivery_challan=$this->delivery_challan_count();
        return $receive_challan - $sold - $delivery_challan;
    }


    public function getNameAttribute()
    {
        $size=$this->item_size->size??'';
        $color = $this->item_color->color??'';
        return  $size ." - ".  $color;
    }
}
