<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\studentClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index(){
        $classes = studentClass::all();
        return view('management.class.classes ' , compact('classes'));
    }

    public function showClass($id){
        $teacher = Teacher::find($id);
        $class = studentClass::all();

        return view('management.teacher.assignclass' ,compact('class' , 'teacher'));
    }
    public function viewMore($id){
        $class = studentClass::find($id);
        $students = $class->Student;
        return view('management.class.details' , compact('class' , 'students'));
    }


    public function updateTeacher(Request $request){
        $class = $request->validate(['class' => 'required']);
        $teacher = Teacher::find($request->id);
        if($teacher->StudentClass->has($class['class'])){
            return back()->with('success' , 'Class Already Exists');

        }
        else{
            $teacher->StudentClass()->attach($class['class']);
            return back()->with('success' , 'Class Assigned Successfully');
        }
    }
    public function deleteTeacher(Request $request){
        $teacher = Teacher::find($request->id);
        $teacher->StudentClass()->detach($request->classid);
        return back()->with('success' , 'Teachers Deleted Successfully');
    }
    public function viewTeacherPage($id){
        return redirect('/teacher/view/'.$id);
    }
    public function viewStudentPage($id){
        return redirect('/student/view/'.$id);
    }
    public function viewUpdatePage($id){
        $student = Student::find($id);
        $class = studentClass::all();
        return view('management.student.changestudentclass' , compact('student' , 'class'));
//        $student->student_class_id = null;
//        $student->save();
//        return back()->with('success' , 'Teachers Deleted Successfully');

    }
}
