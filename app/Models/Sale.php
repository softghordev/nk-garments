<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class Sale extends Model
{
    use HasFactory;

     protected $guarded = [];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function update_paid()
    {
        $this->update([
            'paid' => $this->payments()->sum('amount')
        ]);
    }

    public function update_commission()
    {
        $this->update([
            'total_commission' => $this->items()->sum('commission')
        ]);
    }

    public function update_calculated_data()
    {
         // update paid
        $this->update_paid();
        $this->update_commission();

        $due = $this->receivable - $this->paid;
        
        if($due < 0){
            $status="paid";
        }else{
            $status="unpaid"; 
        }
        // update_due
        $this->update([
            'due' => $due,
            'payment_status' => $status,
        ]);
    }

    public function filter($request, $sales)
    {
        if ($request->customer_name != null) {
            $sales = $sales->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }

        if ($request->showroom != null) {
            $sales = $sales->where('showroom', $request->showroom);
        }

        if ($request->sold_by != null) {
            $sales = $sales->where('sold_by', $request->sold_by);
        }

        if ($request->order_by != null) {
            $sales = $sales->where('order_by', $request->order_by);
        }

        if ($request->has('sale_date')) {
            $dateRange = explode(' - ', $request->input('sale_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sales = $sales->whereBetween('sale_date', [$startDate, $endDate]);
            }
        }

        if ($request->has('delivery_date')) {
            $dateRange = explode(' - ', $request->input('delivery_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $sales = $sales->whereBetween('delivery_date', [$startDate, $endDate]);
            }
        }

        return $sales;
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($sales){
            foreach ($sales->items as $item) {
                $item->delete();
            }
        });
    }

    static function booted()
    {
        static::addGlobalScope(new DepartmentScope);
    }

}
