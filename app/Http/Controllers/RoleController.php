<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $role = Role::all();
        return view('roles and permission.roles.role' , compact('role'));
    }
    public function show(){
        return view('roles and permission.roles.create');
    }

    public function create(Request $request){
        $role = $request->validate(['name' => 'required']);
        Role::create($role);
        return redirect('/role')->with('success' , 'Role Created Successfully');
    }
    public function edit($id){
        $role = Role::find($id);
        $permission = Permission::all();
        return view('roles and permission.roles.edit' , compact('role','permission'));
    }
    public function update(Request $request){
        $role = Role::find($request->id);
        $data = $request->validate(['name' => 'required']);
        $role->update($data);
        return redirect('/role')->with('success' , 'Role Updated');
    }
    public function delete(Request $request){
        $role = Role::find($request->id);
        $role->delete($request->id);
        return back()->with('success' , 'Role Deleted');
    }


    public function view(Request $request){
        $role = Role::find($request->id);
        $permission = $role->permissions; //assigns all the permissions of the role to permission
        return view('roles and permission.roles.view' , compact('role' , 'permission'));
    }
    public function permissionview($id){
        $role = Role::find($id);
        $permission = Permission::all();
        return view('roles and permission.roles.permissionview' , compact('role','permission'));
    }
    public function assignPermission(Request $request){
        $role = Role::findById($request->id);
        if(!$role->hasPermissionTo(intval($request->permission))){
            $role->givePermissionTo(intval($request->permission));
            return redirect('role/view/'.$request->id)->with('success' , 'Permission Assigned');
        }
        else {
            return back()->with('success', 'Permission Already Exists');
        }
    }
        public function revokePermission(Request $request){
            $role = Role::find($request->roleid);
            $permission = Permission::find($request->permissionid);

            if($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
                return back()->with('success', 'Permission Revoked');
            }
        }



}
