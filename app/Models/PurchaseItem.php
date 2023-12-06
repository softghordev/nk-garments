<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class PurchaseItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(purchase::class, 'purchase_id');
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
}
