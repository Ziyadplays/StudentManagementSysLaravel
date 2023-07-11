<?php

namespace App\Repositories;


use App\Interfaces\TeacherRepositoryInterface;
use App\Models\studentClass;
use App\Models\Teacher;

class TeacherRepository implements TeacherRepositoryInterface{
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return $teachers;
//can use User models and get the users with only role teachers with it???
    }
    public function show()
    {
        return studentclass::all();

    }

    public function edit($id)
    {
        $teacher = Teacher::find($id);
        return $teacher;
    }
    public function update($teacher , $data)
    {
//        $teacher->update($data);
        $teacher->User->update($data);

    }
    public function delete($teacher)
    {
        $user = $teacher->user;
        $user->removeRole('teacher');
        $teacher->update([
            'user_id' => 0
        ]);
        $teacher->delete();
//        $user = $teacher->user;
//        $user->removeRole('teacher');
//        $teacher->delete();
//        $teacher->deleted_by = Auth::id();
//        $teacher->save();

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
        $teacher = Teacher::where('id', $id)->with('student')->first();
        $student = $teacher->Student;
        return [$teacher, $student];

    }
}


