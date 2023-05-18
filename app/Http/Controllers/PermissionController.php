<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        $permission = Permission::all();
        return view('roles and permission.permission.permission' , compact('permission'));
    }
    public function show(){
        return view('roles and permission.permission.create');
    }

    public function create(Request $request){
        $permission = $request->validate(['name' => 'required']);
        Permission::create($permission);
        return redirect('/permission')->with('success' , 'Permission Created Successfully');
    }
    //skipping the edit functionality because we will need to edit it everywhere,ill come back to it
//    public function edit($id){
//        $permission = Role::find($id);
//        $permission = Permission::all();
//        return view('roles and permission.roles.edit' , compact('role','permission'));
//    }
//    public function update(Request $request){
//        $permission = Role::find($request->id);
//        $data = $request->validate(['name' => 'required']);
//        $permission->update($data);
//        return redirect('/role')->with('success' , 'Role Updated');
//    }
    public function delete(Request $request){
        $permission = Permission::find($request->id);
        $permission->delete($request->id);
        return back()->with('success' , 'Role Deleted');
    }
}
