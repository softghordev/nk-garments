<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\BankAccount;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $payments= new Payment();
        $payments = $payments->filter($request, $payments);
        $payments =  $payments->orderBy('id','desc')->paginate(20);
        $bank_accounts=BankAccount::where('default',1)->get();
        return view('admin.payments.index',compact('payments','bank_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        if ($payment->delete()) {
            session()->flash('success', 'Payment Delete Success');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
                
        return back();
    }
}
