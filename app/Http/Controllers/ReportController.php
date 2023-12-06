<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\items;
class ReportController extends Controller
{
    public function top_sale_item(){
        $result = items::orderBy('total_sold','desc')->select('id','name','type','image','main_unit_id','sub_unit_id')->paginate(20);
        return view('admin.report.top-sale-item',compact('result'));
    }

    public function top_purchase_item(){
        $result = items::orderBy('total_purchase','desc')->select('id','name','type','image','main_unit_id','sub_unit_id')->paginate(20);
        return view('admin.report.top-purchase-item',compact('result'));
    }

    public function top_sale_party(){
        $result = items::orderBy('total_sold','desc')->select('id','name','type','image','main_unit_id','sub_unit_id')->paginate(20);
        return view('admin.report.top-purchase-party',compact('result'));
    }

    public function top_purchase_party(){
        $result = items::orderBy('total_purchase','desc')->select('id','name','type','image','main_unit_id','sub_unit_id')->paginate(20);
        return view('admin.report.top-sale-party',compact('result'));
    }
}
