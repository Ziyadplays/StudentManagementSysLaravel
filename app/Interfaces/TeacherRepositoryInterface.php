<?php

namespace App\Interfaces;

interface TeacherRepositoryInterface{

    public function index();
    public function show();
    public function create($data);
    public function edit($id);
    public function update($teacher ,$data );
    public function delete($teacher);
    public function showClass($id);
    public function updateClass($class ,$id);
    public function deleteClass($teacher , $classid);

    public function viewMore($id);

//    public function teacherHomeDetails();



}
