<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentController extends Controller
{
    public function index(){

    }

    public function create(){
        $result = Department::orderBy('id','desc')->paginate(10);
        return view('admin.department.create',compact('result'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:departments',
        ]);

        Department::create([
            'name'=>$request->name,
            'status'=>$request->status
        ]);

        return back()->with('success','department created successfully');
    }

    public function show($id)
    {
      dd('show');
    }
    public function update(Request $request,$id){
      Department::find($id)->update(['name'=>$request->name,'status'=>$request->status]);
      return back()->with('success','department updated successfully');
    }

    public function change_active(Request $request)
    {
        session(['department'=>$request->department_id]);
        session()->flash('success', 'Changes Department Successfully!');
        return back();
    }
}
