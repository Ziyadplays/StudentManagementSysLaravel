<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view-users');
    }

    public function index()
    {
        $user = User::all();
        return view('User.user', compact('user'));
    }

    public function addnew()
    {
        $role = Role::all();
        return view('User.addnew', compact('role'));
    }

    public function create(UserValidationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect('/user')->with('success', 'User Created Successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('   User.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        $user = User::find($request->id);

        if ($user->hasRole('teacher')) { // if the user has the role called teacher then it will also update the teacher associated with the user
            $user->Teacher()->update($data);
        } elseif ($user->hasRole('student')) {
            $user->Student()->update($data);
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
        } elseif ($user->hasRole('student')) {
            $user->Student()->delete();
        }
        $user->delete($user->id);
        return back()->with('success', 'User Deleted');
    }


    public function assignrole(Request $request)
    {
        $user = User::find($request->id);
        $role = Role::findById($request->role);
        if ($user->hasRole($role->name)) {
            return back()->with('success', 'Role Already exists');
        } else {
            $user->assignRole($request->role);
            if ($role->name == 'teacher') {
                $user->Teacher()->create();
            } elseif ($role->name == 'student') {
                $user->Student()->create();
            }
            return back()->with('success', 'Role Assigned');
        }
    }

    public function revokerole(Request $request)
    {
        $user = User::find($request->userid);
        $role = Role::find($request->roleid);
        if ($user->hasRole('teacher')) { //if the user has the role of teacher then it will delete the Teacher of the same details as the user
            $user->Teacher()->delete();
        } elseif ($user->hasRole('student')) {
            $user->Student()->delete();
        }
        $user->removerole($role); //removes the role
        return back()->with('success', 'Role Removed');
    }

    public function rolepermissions(Request $request)
    {
        return redirect('/role/view/' . $request->id);
    }


}