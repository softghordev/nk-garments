<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\DeliveryChallan;
use App\Models\DeliveryChallanItem;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Party;

class DeliveryChallanController extends Controller
{
    public function index(){
        $challans =  DeliveryChallan::orderBy('id','desc')->paginate(20);
        return view('admin.challan.delivery.index',compact('challans'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_date' => 'required|date|date_format:Y-m-d',
            'dispatched_by' =>'required',
        ]);

        try {
            DB::beginTransaction();

            $challan = DeliveryChallan::create([
                'department_id'    => session('department'),
                'showroom'          =>$request->showroom,
                'sale_date'         => $request->sale_date,
                'party_sale_id'     => $request->party_sale_id,
                'delivery_address'  => $request->delivery_address,
                'delivery_date'     => $request->delivery_date,
                'dispatched_by'     => $request->dispatched_by,
                'order_by'          => $request->order_by,
                'mode_of_transport' => $request->mode_of_transport,
                'transport_details' => $request->transport_details,
                'note'              => $request->note,
            ]);

            
            foreach ($request->new_item as $key=>$item_id) {
                $item = items::find($item_id);
                $variations = ItemVariation::where('item_id', $item_id)->get();
                $variationCount = $variations->count();

                if ($request->item_variation_id[$key]) {
                    $data = [];
                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                    $selectedVariation = ItemVariation::find($request->item_variation_id[$key]);

                    if ($selectedVariation->stock() < $qty) {
                        DB::rollback();
                        return back()->with('error', 'Insufficient stock for the selected variation.');
                    }
                    
                    $data['department_id'] = session('department');
                    $data['party_sale_item_id'] = $request->party_sale_item_id[$key];
                    $data['delivery_challan_id'] = $challan->id;
                    $data['item_id'] = $item_id;
                    $data['details'] = $request->item_details[$key];
                    $data['item_variation_id'] = $request->item_variation_id[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty'] = $qty;
                    $data['total_packages']=$request->total_packages[$key];
                    $data['packaging_details']=$request->packaging_details[$key];
                    $challan->items()->create($data);

                }else{
                    $data   = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                    $selectedItem = items::find($request->new_item[$key]);
                    
                    if ($selectedItem->stock() < $qty) {
                        DB::rollback();
                        return back()->with('error', 'Insufficient stock for the selected variation.');
                    }
                    
                    $data['department_id'] = session('department');
                    $data['party_sale_item_id'] = $request->party_sale_item_id[$key];
                    $data['delivery_challan_id'] = $challan->id;
                    $data['item_id']     = $item_id;
                    $data['details']     = $request->item_details[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['total_packages']=$request->total_packages[$key];
                    $data['packaging_details']=$request->packaging_details[$key];

                    $challan->items()->create($data);
                }
            }
            
            DB::commit();

            return redirect()->route('delivery-challan.index')->with('success', 'Data saved!');


        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
         }
    }

    public function report(){
        $challans = DeliveryChallanItem::with('challan')->orderBy('id', 'desc')->paginate(20);
        return view('admin.challan.delivery.report',compact('challans'));
    }

    public function destroy(DeliveryChallan $delivery_challan)
    {
        if ($delivery_challan->delete()) {
            $delivery_challan->sale->delivery_status();
            
            session()->flash('success', 'Challan Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function invoice($challan_id){
        $challan  = DeliveryChallan::findOrFail($challan_id);
        return view('admin.challan.delivery.invoice',compact('challan'));
    }
}
