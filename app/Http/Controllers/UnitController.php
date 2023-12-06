<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
class UnitController extends Controller
{
    public function index(){

    }

    public function create(){
        $result = Unit::orderBy('id','desc')->paginate(10);
        $units=Unit::all();
        return view('admin.unit.create',compact('result','units'));
    }

    public function store(Request $request){
          $request->validate([
            'name'=>'required',
            'related_to_unit_id'=>['nullable',function($attribute, $value, $fail)use($request) {
                if(!$request->related_to_unit_id||!$request->related_sign||!$request->related_by){
                    return $fail("This Field has other related fields.");
                }
            }],
            'related_sign'=>['nullable',function($attribute, $value, $fail)use($request) {
                if(!$request->related_to_unit_id||!$request->related_sign||!$request->related_by){
                    return $fail("This Field has other related fields.");
                }
            }],
            'related_by'=>['nullable',function($attribute, $value, $fail)use($request) {
                if(!$request->related_to_unit_id||!$request->related_sign||!$request->related_by){
                    return $fail("This Field has other related fields.");
                }
            }]
        ]);

        $unit=Unit::create($request->all());

        if($unit){
            return back()->with('success','unit created successfully');
        }
            return back()->with('error', 'Oops Something went wrong!');
    }

    public function get_related(Unit $unit)
    {
        // return $unit;
        return $unit->related_unit;
    }

  
}
