<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemColor extends Model
{
    use HasFactory;

    protected $guarded = [];
    // Relations
    public function item()
    {
        return $this->belongsTo(items::class);
    }

    public function item_variations()
    {
        return $this->hasMany(ItemVariation::class);
    }

}
