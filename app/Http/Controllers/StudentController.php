<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\studentClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $students = student::paginate(25);
        return view('management.student.students' , compact('students'));
    }
    public function show(){
        $class = studentClass::all();
        return view('management.student.create' , compact('class'));
    }
    public function create(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'student_class_id' => 'required'
        ]);
        Student::create($data);
        return back()->with('success' , 'Student Created Successfully');
    }

    public function edit($id){
        $data = Student::find($id);
        return view('management.student.edit' , compact('data'));
    }

    public function update(Request $request){
        $student = Student::find($request->id);
        $data = $request->validate(['name' => 'required']);
        $student->update($data);
        return back()->with('success' , 'Student Updated Successfully');
    }

    public function delete(Request $request){
        $student = Student::find($request->id);
        $student->delete($request->id);
        return back()->with('success' , 'Student Deleted Successfully');
    }
    public function viewMore($id){
        $class = student::find($id)->studentClass;
        $student = student::find($id);

        return view('management.student.details' , compact('student','class'));
    }
    public function viewClassPage($id){
        return redirect('/class/view/'.$id);
    }

    public function viewTeacherPage($id){
        return redirect('/teacher/view/'.$id);

    }
    public function updateStudentClass(Request $request){
        $student  = Student::find($request->id);
        $student->student_class_id = $request->class;
        $student->save();
        return redirect('/student')->with('success' , 'Class updated');
    }

}