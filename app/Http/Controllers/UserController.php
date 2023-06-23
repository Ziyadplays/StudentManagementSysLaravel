<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('User.user', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('User.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = User::find($request->id);
        if ($user->hasRole('teacher')) { // if the user has the role called teacher then it will also update the teacher associated with the user
            $user->Teacher->update($data);
        }
        $user->update($data);
        return redirect('/user')->with('success', 'User Updated Successfully');
    }

    public function view($id)
    {
        $user = User::find($id);
        $roles = $user->roles;
        return view('User.details', compact('user', 'roles'));
    }


    public function show($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('User.assignrole', compact('user', 'roles'));

    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        if ($user->hasRole('teacher')) {
            $user->Teacher()->delete();
        }
        $user->delete($user->id);

        return back()->with('success', 'User Deleted');

    }

    public function assignrole(Request $request)
    {
        $user = User::find($request->id);
        $role = Role::findByName('teacher'); //find the role associated with the roleid in request
        if ($user->hasRole($role->name)) { //when the role does not have the role
            return back()->with('success', 'Role Already exists');

        } else {
            if ($request->role == $role->id) { //checks if the role in request is equal to the teacher role
                Teacher::create([
                    'name' => $user->name,
                    'user_id' => $user->id,
                ]);
            }
            $user->assignrole($request->role);
            return redirect('/user')->with('success', 'Role Successfully Assigned');
        }
    }
    public function revokerole(Request $request)
    {
        $user = User::find($request->userid);
        $role = Role::find($request->roleid);
        if ($user->hasRole('teacher')) { //if the user has the role of teacher then it will delete the Teacher of the same details as the user
            $user->Teacher->delete();
        }
        $user->removerole($role); //removes the role
        return back()->with('success', 'Role Removed');


    }

    public function rolepermissions(Request $request)
    {
        return redirect('/role/view/' . $request->id);
    }


}