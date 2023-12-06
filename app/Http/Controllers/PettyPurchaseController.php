<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BankAccount;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Party;
use App\Models\purchase;
use App\Models\PurchaseItem;
use App\Models\Payment;
class PettyPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $purchases= new purchase();
        $purchases = $purchases->filter($request, $purchases);
        $purchases =   $purchases->where('purchase_type','Petty Purchase')->orderBy('id','desc')->paginate(20);
        
        $parties = Party::orderBy('id','desc')->get();
        $employees = Employee::orderBy('id','desc')->get();
        $departments = Department::orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();
        $bank_accounts=BankAccount::where('default',1)->get();

        return view('admin.purchase.petty.index',compact('purchases','parties','employees','departments','bank_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = items::orderBy('id','desc')->get();
        $parties =  Party::orderBy('id','desc')->get();
        $departments = Department::orderBy('id','desc')->get();
        $employees =  Employee::orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();

        return view('admin.purchase.petty.create',compact('item','parties','departments','employees','bank_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_form' => 'required',
            'purchase_date' => 'required|date|date_format:Y-m-d',
            'payable'     =>'required',
        ]);

        try {
            DB::beginTransaction();
            
            $purchase = purchase::create([
                'purchase_type'       => 'Petty Purchase',
                'purchase_form'       => $request->purchase_form,
                'department_id'       => session('department'),
                'address'             => $request->address,
                'phone'               => $request->phone,
                'delivery_date'       => $request->delivery_date,
                'purchase_date'       => $request->purchase_date,
                'order_by'            => $request->order_by,
                'delivery_to'         =>$request->delivery_to,
                'purchase_by'         => $request->purchase_by,
                'note'                => $request->note,
                'payable'             => $request->payable,
            ]);
            
            
            foreach ($request->new_item as $key=>$item_id) {
                $item = items::find($item_id);
                $variationCount = ItemVariation::where('item_id', $item_id)->count();

                if ($request->item_variation_id[$key]) {

                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                    $data['department_id'] = session('department');
                    $data['purchase_id'] = $purchase->id;
                    $data['item_id']     = $item_id;
                    $data['details']     = $request->item_details[$key];
                    $data['item_variation_id']= $request->item_variation_id[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $purchase->items()->create($data);

                }elseif($variationCount > 0 && $request->item_variation_id[$key] ==''){
                    
                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;
                    $rate=0;
                    $subTotal=0;

                     if ($request->main_unit_qty > 0 && $request->sub_unit_qty[$key] > 0) {
                        $sub_qty = ($request->related_by[$key] / $variationCount * $request->main_unit_qty[$key]) + ($request->sub_unit_qty[$key] / $variationCount);
                    } elseif ($request->main_unit_qty > 0 && empty($request->sub_unit_qty[$key])) {
                        $sub_qty = ($request->related_by[$key] / $variationCount * $request->main_unit_qty[$key]);
                    } elseif (empty($request->main_unit_qty) && $request->sub_unit_qty[$key] > 0) {
                        $sub_qty = ($request->related_by[$key] / $variationCount * $request->sub_unit_qty[$key]);
                    }
                    
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);
                    $rate = $request->rate[$key] / $request->related_by[$key];
                    $subTotal= $rate * $qty;
                    
                    $variations = ItemVariation::where('item_id', $item_id)->get();
                    foreach ($variations as $variation) {
                        $data['department_id'] = session('department');
                        $data['purchase_id'] = $purchase->id;
                        $data['item_id'] = $item_id;
                        $data['item_variation_id'] = $variation->id;
                        $data['details'] = $request->item_details[$key];
                        $data['main_unit_qty'] = $main_qty;
                        $data['sub_unit_qty'] = $sub_qty;
                        $data['qty'] = $qty;
                        $data['rate'] = $rate;
                        $data['sub_total'] = $subTotal;
                        $purchase->items()->create($data);
                    }
                }else{
                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    if ($request->main_unit_qty > 0 && $request->sub_unit_qty[$key] > 0) {
                        $main_qty = $request->main_unit_qty[$key];
                        $sub_qty = $request->sub_unit_qty[$key];
                    }elseif ($request->main_unit_qty > 0 && empty($request->sub_unit_qty[$key])) {
                        $main_qty = $request->main_unit_qty[$key];
                    }elseif (empty($request->main_unit_qty) && $request->sub_unit_qty[$key] > 0) {
                        $sub_qty = $request->sub_unit_qty[$key];
                    }
                    
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                    $data['department_id'] = session('department');
                    $data['purchase_id'] = $purchase->id;
                    $data['item_id']     = $item_id;
                    $data['details']     = $request->item_details[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $purchase->items()->create($data);
                }
                
            }

            if ($request->pay_amount != null) {
                
                $purchase->payments()->create([
                    'department_id'     => session('department'),
                    'payment_date'      => $request->purchase_date,
                    'bank_account_id'   => $request->bank_account_id,
                    'source_of_payment' => "Petty Purchase",
                    'payment_type'      => 'pay',
                    'amount'        => $request->pay_amount,
                ]);
            }

            $purchase->update_calculated_data();

            DB::commit();
            return back()->with('success', 'data saved!');

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
         }
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
    public function destroy(purchase $petty_purchase)
    {
        if ($petty_purchase->delete()) {
            session()->flash('success', 'Purchase Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function report(){
        $purchases = PurchaseItem::with('purchase')
        ->whereHas('purchase', function ($query) {
            $query->where('purchase_type', 'Petty Purchase');
        })->orderBy('id', 'desc')->paginate(20);

        return view('admin.purchase.petty.report',compact('purchases'));
    }

    
    public function by_invoice(Request $request){

        $purchase = purchase::findOrFail($request->invoice_id);

        $purchase->payments()->create([
            'department_id'     => session('department'),
            'payment_date'      => date('Y-m-d'),
            'bank_account_id'   => $request->bank_account_id,
            'source_of_payment' => "Petty Purchase",
            'payment_type'      => 'pay',
            'amount'            => $request->pay_amount,
        ]);

        if($purchase){
            $purchase->update_calculated_data();
            session()->flash('success', 'Payment Completed...');
        }else{
            session()->flash('warning', 'Opps operation failed!');
        }
        
        return back();
    }

    public function payment_list(purchase $party_purchase){
        $payments = Payment::where('source_of_payment','Petty Purchase')->where('paymentable_id',$party_purchase->id)->orderBy('id','desc')->paginate(20);

        return view('admin.purchase.petty.payment-list',compact('payments'));
    }

    public function invoice($purchase_id){
        $purchase  = purchase::findOrFail($purchase_id);
        return view('admin.purchase.invoice',compact('purchase'));
    }
}
