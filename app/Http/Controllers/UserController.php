<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function delete(Request $request){
        $user = User::find($request->id);
        $data = Teacher::where('name' , '=',$user->name)->get();
        $user->delete($user->id);
        return redirect('/user');
    }

    public function assignrole(Request $request)
    {
        $user = User::find($request->id);
        if ($user->hasRole($request->role)) {
            return back()->with('success', 'Role Already exists');
        } else {
            $user->assignRole($request->role);
            $this->addteacher($user);
            return redirect('/role')->with('success', 'Role Assigned');
        }
    }

    public function revokerole(Request $request)
    {
        $user = User::find($request->userid);
        $role = Role::find($request->roleid);

        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('success', 'Role Removed');
        }
    }

    public function rolepermissions(Request $request)
    {
        return redirect('/role/view/' . $request->id);
    }

    public function addteacher($user)
    {
        if ($user->hasRole('teacher')) {
            Teacher::create(['name' => $user->name]);
        }
    }

}