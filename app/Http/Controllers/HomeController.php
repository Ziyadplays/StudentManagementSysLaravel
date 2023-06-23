<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::id()); //<-finds the id of the current user logged in
        if ($user->hasRole('teacher')) {
            $teacher = $user->Teacher;  //<-assigns the Teacher which was created when we assigned the teacher role to the permission to the $teacher variable
            $students = $teacher->Student; //<-assigns the Student Studying in the Classes associated with our teacher which is linked through has many through relationship
            return view('home', compact('teacher', 'students'));
        } else {
            return view('home');
        }

    }

}
