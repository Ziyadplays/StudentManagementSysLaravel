<?php

namespace App\Http\Controllers;

use App\Models\studentClass;
use App\Models\Students;


use App\Models\Teacher;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index(){
//        $teacher = Teacher::find(1);
//        return $teacher->Student;
        $teachers = Teacher::all();
        return view('management.teacher.teachers' , compact('teachers'));
    }
    public function show(){
        $classes  = studentClass::all();
        return view('management.teacher.create',compact('classes'));
    }
    public function create(Request $request){
        $data = $request->validate(['name' => 'required']);
        Teacher::create($data);
        return redirect('/teacher');
    }

    public function edit($id){
        $data = Teacher::find($id);
        return view('management.teacher.edit' , compact('data'));
    }
    public function update(Request $request){
        $teacher = Teacher::find($request->id);
        $data = $request->validate(['name' => 'required']);
        $teacher->update($data);
        return redirect('/teacher')->with('success' , 'Teacher Updated');
    }
    public function delete(Request $request){
        $teacher = Teacher::find($request->id);
        $teacher->delete($request->id);
        return back()->with('success' , 'Teachers Deleted');
    }

    public function showClass($id){
        $teacher = Teacher::find($id);
        $class = studentClass::all();
        return view('management.teacher.assignclass' ,compact('class' , 'teacher'));
    }


    public function updateClass(Request $request){
        $class = $request->validate(['class' => 'required']);
        $teacher = Teacher::find($request->id);
        if($teacher->studentClass->has($class['class'])){
            return back()->with('success' , 'Class Already Exists');

        }
        else{
            $teacher->studentClass()->attach($class['class']);
            return back()->with('success' , 'Class Assigned Successfully');
        }
    }
    public function deleteClass(Request $request){
        $teacher = Teacher::find($request->teacherid);
        $teacher->studentClass()->detach($request->classid);
        return back()->with('success' , 'Class Deleted Successfully');
    }
    public function viewClassPage($id){
        return redirect('/class/view/'.$id);
    }

    public function viewMore($id){
        $teacher = Teacher::find($id);
        $students = $teacher->Student;

        return view('management.teacher.details' , compact('teacher' , 'students'));
    }
}

