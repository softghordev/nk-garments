<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartySaleItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sale()
    {
        return $this->belongsTo(PartySale::class,'party_sale_id');
    }

    public function variation()
    {
        return $this->belongsTo(ItemVariation::class, 'item_variation_id');
    }

    public function items()
    {
        return $this->belongsTo(items::class,'item_id');
    }

    public function delivery_challan_items()
    {
        return $this->hasMany(DeliveryChallanItem::class,'party_sale_item_id');
    }

    public function update_delivery_qty(){
        $due_main=$this->main_unit_qty - $this->delivery_challan_items->sum('main_unit_qty');
        $due_sub=$this->sub_unit_qty - $this->delivery_challan_items->sum('sub_unit_qty');
        $due_qty=$this->qty - $this->delivery_challan_items->sum('qty');
        
        $this->update([
            'due_main_unit_qty' => $due_main,
            'due_sub_unit_qty'  => $due_sub,
            'due_qty'           => $due_qty,
        ]);
    }

    public function update_calculated_data(){
        $this->update_delivery_qty();
    }
    
}
