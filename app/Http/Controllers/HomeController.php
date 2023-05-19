<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
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
        $authuser = User::find(Auth::id());
        if($authuser->hasRole('teacher')){
            $data = Teacher::where('name' , '=' , $authuser->name)->get();
            $teacher = Teacher::find($data[0]->id);
            $students = $teacher->Student;
            return view('home' , compact('teacher' , 'students'));
        }
        else{
            return view('home');
        }

    }

}
