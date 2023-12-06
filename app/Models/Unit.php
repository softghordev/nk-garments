<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function main_unit_items()
    {
        return $this->hasMany(items::class,'main_unit_id');
    }

    public function sub_unit_items()
    {
        return $this->hasMany(items::class,'sub_unit_id');
    }


    public function related_unit()
    {
        return $this->belongsTo(Unit::class,'related_to_unit_id');
    }


    public function child_units()
    {
        return $this->hasMany(Unit::class,'related_to_unit_id');
    }

}
