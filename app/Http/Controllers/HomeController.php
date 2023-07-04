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
//        return view('home');
        $user = User::find(Auth::id()); //<-finds the id of the current user logged in
        if ($user->hasRole('teacher')) {
            $teacher = $user->Teacher;  //<-assigns the Teacher which was created when we assigned the teacher role to the permission to the $teacher variable
            $students = $teacher->Student()->paginate(20); //<-assigns the Student Studying in the Classes associated with our teacher which is linked through has many through relationship
            return view('home', compact('teacher', 'students'));
        } elseif ($user->hasRole('student')) {
            $student = $user->student;
            $class = $student->studentClass;
            $teachers = $student->studentClass->Teacher()->paginate(20);
            return view('home', compact('student', 'teachers', 'class'));
        } else {
            return view('home');
        }

    }

}
