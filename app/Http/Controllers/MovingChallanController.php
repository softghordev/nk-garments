<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Branch;
use App\Models\MovingChallan;
use App\Models\MovingChallanItem;
use App\Models\Department;
use App\Models\Employee;
use App\Models\items;
use App\Models\Party;
class MovingChallanController extends Controller
{
    public function index(){
        $challans =  MovingChallan::orderBy('id','desc')->paginate(20);
        return view('admin.moving-challan.index',compact('challans'));
    }

     public function create()
    {
        $item = items::orderBy('id','desc')->get();
        $showrooms=Branch::where('status',1)->orderBy('id','desc')->get();
        $parties =  Party::orderBy('id','desc')->get();
        $departments = Department::orderBy('id','desc')->get();
        $employees =  Employee::orderBy('id','desc')->get();
        return view('admin.moving-challan.create',compact('item','showrooms','parties','departments','employees'));
    }

     public function store(Request $request)
    {
        $validated = $request->validate([
            'party_id' => 'required',
            'delivery_date' => 'required|date|date_format:Y-m-d',
            'order_by' =>'required',
            'receive_by' =>'required',
            'release_by' =>'required',
            'payable'     =>'required',
        ]);

        try {
            DB::beginTransaction();

            $challan = MovingChallan::create([
                'for_sale'          =>$request->for_sale,
                'order_by'         =>$request->order_by,
                'showroom'          =>$request->showroom,
                'party_id'          => $request->party_id,
                'delivery_to'       => $request->delivery_to,
                'delivery_from'     => $request->delivery_from,
                'delivery_date'     => $request->delivery_date,
                'release_by'        => $request->release_by,
                'receive_by'        => $request->receive_by,
                'mode_of_transport' => $request->mode_of_transport,
                'transport_details' => $request->transport_details,
                'note'              => $request->note,
                'payable'           => $request->payable,
            ]);

            $challan->update_calculated_data();
            
            foreach ($request->new_item as $key=>$item_id) {
                $data      = [];
                $main_qty = 0;
                $sub_qty = 0;
                $qty = 0;
                $item = items::find($item_id);

                $main_qty = $request->main_unit_qty[$key];
                $sub_qty = $request->sub_unit_qty[$key];

                $qty = $item->to_sub_quantity($main_qty, $sub_qty);

                $data['moving_challan_id']  = $challan->id;
                $data['item_id']             = $item_id;
                $data['details']             = $request->item_details[$key];
                $data['main_unit_qty']       = $main_qty;
                $data['sub_unit_qty']        = $sub_qty;
                $data['qty']                 = $qty;
                $data['total_packages']      = $request->total_packages[$key];
                $data['packaging_details']   = $request->packaging_details[$key];
                $data['rate']                = $request->rate[$key];
                $data['sub_total']           = $request->sub_total[$key];
                $challan->items()->create($data);
            }
            DB::commit();
            return back()->with('success', 'data saved!');

        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return back()->with('warning', 'Opps operation failed!');
         }
    }

    public function report(){
        $challans = MovingChallanItem::with('challan')->orderBy('id', 'desc')->paginate(20);
        return view('admin.moving-challan.report',compact('challans'));
    }

    public function destroy(MovingChallan $moving_challan)
    {
        if ($moving_challan->delete()) {
            session()->flash('success', 'Challan Deleted Successfully.');
        } else {
            session()->flash('warning', 'Deletion Failed.');
        }
        return back();
    }
}
