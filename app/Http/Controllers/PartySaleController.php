<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Party;
use App\Models\PartySale;
use App\Models\PartySaleItem;
use App\Models\Payment;
use Redirect,Response;
class PartySaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sales= new PartySale();
        $sales = $sales->filter($request, $sales);
        $sales =   $sales->orderBy('id','desc')->paginate(20);
        $parties = Party::orderBy('id','desc')->get();
        $employees = Employee::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();
        return view('admin.sale.party.index',compact('sales','bank_accounts','parties','employees','showrooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $item = items::orderBy('id','desc')->get();
        $parties = Party::orderBy('id','desc')->get();
        $employees = Employee::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $bank_accounts=BankAccount::where('default',1)->get();

        return view('admin.sale.party.create',compact('item','parties','employees','showrooms','bank_accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'party_id' => 'required|integer',
            'sale_date' => 'required|date|date_format:Y-m-d',
            'sold_by' => 'required',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'receivable'     =>'required',
        ]);

        try {
            DB::beginTransaction();

            $sale = PartySale::create([
                'department_id' => session('department'),
                'showroom'      => $request->showroom,
                'sale_type'     => $request->sale_type,
                'party_id'      => $request->party_id,
                'sale_date'     => $request->sale_date,
                'delivery_date' => $request->delivery_date,
                'delivery_to'   => $request->delivery_to,
                'sold_by'       => $request->sold_by,
                'order_by'      => $request->order_by,
                'note'          => $request->note,
                'total_discount'    => $request->total_discount,
                'receivable'    => $request->receivable,
            ]);

            
            foreach ($request->new_item as $key=>$item_id) {
                $item = items::find($item_id);
                $variationCount = ItemVariation::where('item_id', $item_id)->count();
                // dd($variationCount);

                if ($request->item_variation_id[$key]) {

                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);
                    
                    $data['department_id'] = session('department');
                    $data['party_sale_id'] = $sale->id;
                    $data['item_id']     = $item_id;
                    $data['details']     = $request->item_details[$key];
                    $data['item_variation_id']= $request->item_variation_id[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['commission'] = $request->commission[$key];
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $sale->items()->create($data);

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
                    $commission = $request->commission[$key] ??0;
                    $rate = $request->rate[$key] / $request->related_by[$key] - $commission;
                    $subTotal= $rate * $qty;
                    
                    $variations = ItemVariation::where('item_id', $item_id)->get();
                    foreach ($variations as $variation) {
                        $data['department_id'] = session('department');
                        $data['party_sale_id'] = $sale->id;
                        $data['item_id'] = $item_id;
                        $data['item_variation_id'] = $variation->id;
                        $data['details'] = $request->item_details[$key];
                        $data['main_unit_qty'] = $main_qty;
                        $data['sub_unit_qty'] = $sub_qty;
                        $data['qty'] = $qty;
                        $data['commission'] = $commission;
                        $data['rate'] = $rate;
                        $data['sub_total'] =$subTotal;
                        $sale->items()->create($data);
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
                    $data['party_sale_id'] = $sale->id;
                    $data['item_id']     = $item_id;
                    $data['details']     = $request->item_details[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['commission'] = $request->commission[$key];
                    $data['rate']        = $request->rate[$key];
                    $data['sub_total']   = $request->sub_total[$key];
                    $sale->items()->create($data);
                }
                
            }

            $sale->update_calculated_data();

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
    public function destroy(PartySale $party_sale)
    {
        if ($party_sale->delete()) {
            session()->flash('success', 'Sale Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function report(){
        $sales = PartySaleItem::with('sale')->orderBy('id', 'desc')->paginate(20);
        return view('admin.sale.party.report',compact('sales'));
    }

    public function challan_delivery(PartySale $party_sale){
        $item = items::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $parties =  Party::orderBy('id','desc')->get();
        $departments = Department::orderBy('id','desc')->get();
        $employees =  Employee::orderBy('id','desc')->get();
        return view('admin.challan.delivery.create',compact('party_sale','item','showrooms','parties','departments','employees'));
    }

    public function get_sale($id){
        $where = array('id' => $id);
		$sale = PartySale::where($where)->first();
		return Response::json($sale);
    }

    public function by_invoice(Request $request){

        $sale = PartySale::findOrFail($request->invoice_id);
        $sale->payments()->create([
            'payment_date'      =>   date('Y-m-d'),
            'bank_account_id'   => $request->bank_account_id,
            'source_of_payment' => "Party Sale",
            'payment_type'      => 'receive',
            'amount'            => $request->pay_amount,
        ]);

        if($sale){
            $sale->update_calculated_data();
            session()->flash('success', 'Payment Completed...');
        }else{
            session()->flash('warning', 'Opps operation failed!');
        }
        
        return back();
    }

    public function payment_list(PartySale $party_sale){
        $payments = Payment::where('source_of_payment','Party Sale')->where('paymentable_id',$party_sale->id)->orderBy('id','desc')->paginate(20);

        return view('admin.sale.party.payment-list',compact('payments'));
    }
    
    public function invoice($sale_id){
        $party_sale  = PartySale::findOrFail($sale_id);
        return view('admin.sale.party.invoice',compact('party_sale'));
    }
}
