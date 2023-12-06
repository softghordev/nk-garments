<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovingChallan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function items()
    {
        return $this->hasMany(MovingChallanItem::class,'moving_challan_id');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function due(){
        $total=$this->payable - $this->paid;
        $this->update([
            'due' => $total,
        ]);
    }

    public function update_calculated_data(){
        $this->due();
    }
}
