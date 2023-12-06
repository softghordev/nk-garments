<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\DepartmentScope; 

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relations
     */
    public function paymentable()
    {
        return $this->morphTo();
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'paymentable_id', 'id');
    }

    public function purchase()
    {
        return $this->belongsTo(purchase::class, 'paymentable_id', 'id');
    }

    public function party()
    {
        return $this->belongsTo(Party::class, 'paymentable_id', 'id');
    }

    public function account()
    {
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }

    public function filter($request, $payments)
    {
        if ($request->has('payment_date')) {
            $dateRange = explode(' - ', $request->input('payment_date'));
            if (isset($dateRange[1])) {
                $startDate = date('Y-m-d', strtotime($dateRange[0]));
                $endDate = date('Y-m-d', strtotime($dateRange[1]));
                $payments = $payments->whereBetween('payment_date', [$startDate, $endDate]);
            }
        }

        if ($request->bank_account != null) {
            $payments = $payments->where('bank_account_id', $request->bank_account);
        }

        if ($request->payment_type != null) {
            $payments = $payments->where('payment_type', $request->payment_type);
        }

        if ($request->source_of_payment != null) {
            $payments = $payments->where('source_of_payment', $request->source_of_payment);
        }

        return $payments;
    }

    // static function booted()
    // {
    //     static::addGlobalScope(new DepartmentScope);
    // }

    protected static function boot(){
        parent::boot();

        static::deleted(function($payment){

            if($payment->paymentable&&$payment->paymentable_type==Sale::class){
                $payment->paymentable->update_calculated_data();
            }

            if($payment->paymentable&&$payment->paymentable_type==PartySale::class){
                $payment->paymentable->update_calculated_data();
            }

            if($payment->paymentable&&$payment->paymentable_type==purchase::class){
                $payment->paymentable->update_calculated_data();
            }
        });
    }

}
