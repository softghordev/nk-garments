<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class items extends Model
{
    use HasFactory;
    protected $table='items';
    
    protected $guarded = [];

    public function getBrand(){
        return $this->belongsTo(brand::class,'brand','id');
    }

    public function purchase()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function sale()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function party_sale()
    {
        return $this->hasMany(PartySaleItem::class);
    }

    public function main_unit()
    {
        return $this->belongsTo(Unit::class, 'main_unit_id');
    }

    public function sub_unit_name()
    {
        return $this->belongsTo(Unit::class, 'sub_unit_id')->withDefault([
            'name' => '',
        ]);
    }

    public function sub_unit()
    {
        return $this->belongsTo(Unit::class, 'sub_unit_id');
    }


    public function unit_related_by()
    {
        return $this->belongsTo(Unit::class, 'main_unit_id')->withDefault([
            'related_by' => '',
        ]);
    }

    public function sizes()
    {
        return $this->hasMany(ItemSize::class,'item_id');
    }

    public function colors()
    {
        return $this->hasMany(ItemColor::class,'item_id');
    }

    public function variations()
    {
        return $this->hasMany(ItemVariation::class,'item_id');
    }

    public function separate_main_sub_qty($quantity)
    {
        $main_unit=$this->main_unit;

        $main_qty=0;
        $main_qty_as_sub = 0;
        $sub_qty=0;


        if($this->sub_unit_id&&$quantity!=0&&$main_unit->related_by!=null){
            $main_qty=(int)($quantity/$main_unit->related_by);
            $main_qty_as_sub = $main_qty*$main_unit->related_by;
            $sub_qty = $quantity-$main_qty_as_sub;
        }else{
            $main_qty=$quantity;
            $sub_qty=0;
        }

        return [
            'main_qty'=>$main_qty,
            'sub_qty'=>$sub_qty
        ];
    }

    public function readable_qty($quantity)
    {
        $separated= $this->separate_main_sub_qty($quantity);
        // dd($separated);
        $readable_stock="";

        $readable_stock.=$separated['main_qty']." ".$this->main_unit->name;
        if($this->sub_unit){
            $readable_stock.=" ".$separated['sub_qty']." ".$this->sub_unit->name;
        }

        return $readable_stock;
        // in units and sub_units
    }

    // Convert all quantity to sub_unit quantity
    public function to_sub_quantity($main_quantity,$sub_quantity)
    {
        $main_unit=$this->main_unit;

        $related_by=1;
        if($this->sub_unit_id&&$main_unit->related_by!=null){
            $related_by=$main_unit->related_by;
        }

        return ($main_quantity*$related_by)+$sub_quantity;
    }


    public function calculate_worth($main_qty,$sub_qty,$unit_price)
    {
        $main_unit=$this->main_unit;
        $sub_unit_price=0;

        if($main_unit->related_by){
            $sub_unit_price=$unit_price/$main_unit->related_by;
        }

        $main_price = $main_qty*$unit_price;
        $sub_price=$sub_qty*$sub_unit_price;

        return $main_price+$sub_price;
    }

    public function quantity_worth($qty,$unit_price)
    {
        $separated=$this->separate_main_sub_qty($qty);
        return $this->calculate_worth($separated['main_qty'],$separated['sub_qty'],$unit_price);
    }

    public function sale_count($size_id = null)
    {
        $qty = SaleItem::where('item_id', $this->id)->where('department_id', session('department'));
        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id);
        }
        return $qty->sum('qty');
    }

    public function total_sale_count($size_id = null)
    {
        $qty = SaleItem::where('item_id', $this->id);
        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id);
        }
        return $qty->sum('qty');
    }

    public function delivery_challan_count($size_id = null)
    {
        $qty = DeliveryChallanItem::where('item_id', $this->id)->where('department_id', session('department'));

        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id);
        }

        return $qty->sum('qty');
    }

    public function purchase_count($size_id = null)
    {
        $qty = PurchaseItem::where('item_id', $this->id)->where('department_id', session('department'));
        
        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id);
        }
        return $qty->sum('qty');
    }

    public function total_purchase_count($size_id = null)
    {
        $qty = PurchaseItem::where('item_id', $this->id);
        
        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id);
        }
        return $qty->sum('qty');
    }


    public function receive_challan_count($size_id = null)
    {
        $qty = ReceiveChallanItem::where('item_id', $this->id)->where('department_id', session('department'));
        
        if ($size_id != null) {
            $qty = $qty->where('item_variation_id', $size_id);
        }
        return $qty->sum('qty');
    }

    public function stock()
    {
        $stock = $this->receive_challan_count() - $this->sale_count() - $this->delivery_challan_count();
        return  $stock > 0 ? $stock : 0;
    }

    public function update_total_sale()
    {
        $total_sold=$this->total_sale_count();
        $this->update([
            'total_sold'=>$total_sold
        ]);
    }

    public function update_total_purchase()
    {
        $total_purchase=$this->total_purchase_count();
        $this->update([
            'total_purchase'=>$total_purchase
        ]);
    }

    // public function update_stock()
    // {
    //     $stock=$this->stock();
    //     $main_sub_stock=$this->separate_main_sub_qty($stock);
    //     $this->update([
    //         'stock'=>$stock,
    //         'main_unit_stock'=>$main_sub_stock['main_qty'],
    //         'sub_unit_stock'=>$main_sub_stock['sub_qty'],
    //     ]);
    // }

    public function update_calculated_data()
    {
        $this->update_total_sale();
        $this->update_total_purchase();
        // $this->update_stock();
    }

    // Don't delete if any relation is existing
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($rel) {
            $relationMethods = ['sale','party_sale', 'purchase'];

            foreach ($relationMethods as $relationMethod) {
                if ($rel->$relationMethod()->count() > 0) {
                    return false;
                }
            }
        });
    }

}
