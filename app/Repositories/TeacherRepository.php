<?php

namespace App\Repositories;


use App\Http\Requests\ValidationRequest;
use App\Interfaces\TeacherRepositoryInterface;
use App\Models\Student;
use App\Models\studentClass;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherRepository implements TeacherRepositoryInterface{
    public function index()
    {
        return Teacher::all();
//can use User models and get the users with only role teachers with it???
    }
    public function show()
    {
        return studentclass::all();

    }
    public function create($data)
    {
        Teacher::create($data);

    }
    public function edit($id)
    {
        return Teacher::find($id);

    }
    public function update($teacher , $data)
    {
        $teacher->update($data);

    }
    public function delete($teacher)
    {
        $teacher->delete($teacher->id);
        $teacher->deleted_by = Auth::id();
        $teacher->save();

    }
    public function showClass($id)
    {
        $teacher = Teacher::find($id);
        $class = studentClass::all();
        return [$teacher , $class];

    }
    public function updateClass($class ,$id){
       $teacher = Teacher::find($id);

       if($teacher[0]->studentClass->has($class)){
           return $flag = 0 ;
       }
       else{
           $teacher[0]->studentClass()->attach($class);
           return $flag = 1;

       }
    }
    public function deleteClass($teacher , $classid)
    {
        $teacher->studentClass()->detach($classid);
    }
    public function viewMore($id)
    {
        $teacher = Teacher::find($id);
        $student = $teacher->Student;
        return [$teacher, $student];

    }

}


