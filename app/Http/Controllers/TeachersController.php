<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassValidation;
use App\Http\Requests\ValidationRequest;
use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Teacher;
use Illuminate\Http\Request;


class TeachersController extends Controller
{
    private TeacherRepositoryInterface $teacherRepository;
    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->middleware('can:view-teachers');
        $this->teacherRepository = $teacherRepository;
    }

    public function index(){
        $teachers = $this->teacherRepository->index();
        return view('management.teacher.teachers' , compact('teachers'));
    }
    public function show(){
        $classes  = $this->teacherRepository->show();
        return view('management.teacher.create',compact('classes'));
    }


    public function edit($id){
        $data = $this->teacherRepository->edit($id);
        return view('management.teacher.edit' , compact('data'));
    }
    public function update(ValidationRequest $request){
        $teacher = Teacher::find($request->id);
        $data = $request->only('name');
        $this->teacherRepository->update($teacher , $data);
        return redirect('/teacher')->with('success' , 'Teacher Updated');
    }

    public function delete(Request $request){
        $teacher = Teacher::find($request->id);

        $this->teacherRepository->delete($teacher);
        return back()->with('success' , 'Teachers Deleted');
    }

    public function showClass($id){
        $details_array = $this->teacherRepository->showClass($id);
        $teacher = $details_array[0];
        $class = $details_array[1];
        return view('management.teacher.assignclass' ,compact('class' , 'teacher'));
    }


    public function updateClass(ClassValidation $request){
        $class = $request->only('class');
        $id = $request->only('id');
        $flag = $this->teacherRepository->updateClass($class , $id);
        if($flag == 0){
            return back()->with('success' , 'Class Already Exists');
        }
        else {
            return back()->with('success', 'Class Assigned Successfully');
        }
    }
    public function deleteClass(Request $request){
        $teacher = Teacher::find($request->teacherid);
        $this->teacherRepository->deleteClass($teacher , $request->class_id);
        return back()->with('success' , 'Class Deleted Successfully');
    }
    public function viewClassPage($id){
        return redirect('/class/view/'.$id);
    }

    public function viewMore($id){
        $details_array = $this->teacherRepository->viewMore($id);
        $teacher = $details_array[0];
        $students = $details_array[1];
        return view('management.teacher.details' , compact('teacher' , 'students'));
    }
//    pz
}


