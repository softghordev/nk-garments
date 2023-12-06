<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 
class purchase extends Model
{
    use HasFactory;

    protected $table="purchases";
 
    protected $guarded=[];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class,'purchase_id');
    }

    public function receive_challan()
    {
        return $this->hasMany(ReceiveChallan::class,'purchase_id');
    }
    
    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function party(){
        return $this->belongsTo(Party::class)->withDefault([
            'party_name' => '',
        ]);
    }

    public function department(){
        return $this->belongsTo(Department::class)->withDefault([
            'name' => '',
        ]);
    }

    public function receive_status(){

        $delivery_status = $this->receive_challan()->count() == 0 ? 0 : 1;

        $this->update([
            'delivery_status' => $delivery_status
        ]);
    }


    public function update_paid()
    {
        $this->update([
            'paid' => $this->payments()->sum('amount')
        ]);
    }

    public function update_calculated_data(){
        // update paid
        $this->update_paid();

        $total=$this->payable - $this->paid;
        $this->update([
            'due' => $total,
        ]);
        
    }

    public function filter($request, $purchases)
    {
        if ($request->party_id != null) {
            $purchases = $purchases->where('id', $request->party_id);
        }

        if ($request->purchase_form != null) {
            $purchases = $purchases->where('purchase_form', $request->purchase_form);
        }

        if ($request->phone != null) {
            $purchases = $purchases->where('phone', $request->phone);
        }

        if ($request->purchase_by != null) {
            $purchases = $purchases->where('purchase_by', $request->purchase_by);
        }

        if ($request->department != null) {
            $purchases = $purchases->where('department_id', $request->department);
        }

        if ($request->has('purchase_date')) {
            $dateRange = explode(' - ', $request->input('purchase_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $purchases = $purchases->whereBetween('purchase_date', [$startDate, $endDate]);
            }
        }

        if ($request->has('delivery_date')) {
            $dateRange = explode(' - ', $request->input('delivery_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $purchases = $purchases->whereBetween('delivery_date', [$startDate, $endDate]);
            }
        }

        return $purchases;
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

     // Don't delete if any relation is existing
     protected static function boot()
     {
         parent::boot();
         static::deleting(function ($rel) {
             $relationMethods = ['receive_challan'];
 
             foreach ($relationMethods as $relationMethod) {
                 if ($rel->$relationMethod()->count() > 0) {
                     return false;
                 }
             }
         });
     }
    

}
