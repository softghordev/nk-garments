<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ReceiveChallan;
use App\Models\ReceiveChallanItem;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\ItemVariation;
use App\Models\Party;
use App\Models\purchase;
class ReceiveChallanController extends Controller
{

    public function index(){
        $challans =  ReceiveChallan::orderBy('id','desc')->paginate(20);
        return view('admin.challan.receive.index',compact('challans'));
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_date' => 'required|date|date_format:Y-m-d',
            'order_by' => 'required',
            'receive_by' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $challan = ReceiveChallan::create([
                'department_id'     => session('department'),
                'purchase_id'        => $request->purchase_id,
                'delivery_date'     => $request->delivery_date,
                'ref_no'            => $request->ref_no,
                'receive_by'        => $request->receive_by,
                'purchase_date'     => $request->purchase_date,
                'order_by'          => $request->order_by,
                'transport_details' => $request->transport_details,
                'note'              => $request->note,
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
                    $data['receive_challan_id'] = $challan->id;
                    $data['item_id']     = $item_id;
                    $data['details']     = $request->item_details[$key];
                    $data['item_variation_id']= $request->item_variation_id[$key];
                    $data['main_unit_qty'] = $main_qty;
                    $data['sub_unit_qty'] = $sub_qty;
                    $data['qty']         = $qty;
                    $data['total_packages']=$request->total_packages[$key];
                    $data['packaging_details']=$request->packaging_details[$key];

                    $challan->items()->create($data);

                }elseif($variationCount > 0 && $request->item_variation_id[$key] ==''){
                    
                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;
                    $rate=0;
                    $subTotal=0;

                    $sub_qty = $request->related_by[$key] / $variationCount * $request->main_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);
                    $rate = $request->rate[$key] / $request->related_by[$key];
                    $subTotal= $rate * $qty;
                    
                    $variations = ItemVariation::where('item_id', $item_id)->get();
                    foreach ($variations as $variation) {
                        $data['department_id'] = session('department');
                        $data['receive_challan_id'] = $challan->id;
                        $data['item_id'] = $item_id;
                        $data['item_variation_id'] = $variation->id;
                        $data['details'] = $request->item_details[$key];
                        $data['main_unit_qty'] = $main_qty;
                        $data['sub_unit_qty'] = $sub_qty;
                        $data['qty'] = $qty;
                        $data['total_packages']=$request->total_packages[$key];
                        $data['packaging_details']=$request->packaging_details[$key];
                        $challan->items()->create($data);
                    }
                }else{
                    $data      = [];
                    $main_qty = 0;
                    $sub_qty = 0;
                    $qty = 0;

                    $main_qty = $request->main_unit_qty[$key];
                    $sub_qty = $request->sub_unit_qty[$key];
                    $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                    $data['department_id'] = session('department');
                    $data['receive_challan_id'] = $challan->id;
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
            return redirect()->route('receive-challan.index')->with('success', 'Data saved!');
         

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
         }
    }

    public function report(){
        $challans = ReceiveChallanItem::with('challan')->orderBy('id', 'desc')->paginate(20);
        return view('admin.challan.receive.report',compact('challans'));
    }

    public function destroy(ReceiveChallan $receive_challan)
    {
        if ($receive_challan->delete()) {
            $receive_challan->purchase->receive_status();
            session()->flash('success', 'Challan Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }

    public function invoice($challan_id){
        $challan  = ReceiveChallan::findOrFail($challan_id);
        return view('admin.challan.receive.invoice',compact('challan'));
    }
}
