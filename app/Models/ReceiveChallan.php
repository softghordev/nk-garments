<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class ReceiveChallan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function purchase()
    {
        return $this->belongsTo(purchase::class, 'purchase_id');
    }

    public function items()
    {
        return $this->hasMany(ReceiveChallanItem::class,'receive_challan_id');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($challan) {
            $challan->purchase->receive_status();
        });

        static::deleting(function ($challan) {
            foreach ($challan->items as $item) {
                $item->delete();
            }
        });
    }

}
