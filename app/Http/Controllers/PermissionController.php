<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    function create(Request $request){
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

     Permission::create(['name' => $request->input('name'),'guard_name'=>'web']);

        return redirect()->back()->with('success','Role created successfully');
    }
}
