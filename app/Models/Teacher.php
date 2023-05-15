<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $fillable = ['name'];
    use HasFactory;
    public function studentClass(){
        return $this->belongsToMany(studentClass::class);
    }
    public function Student(){
        return $this->hasManyThrough(Student::class , Pivot::class , 'teacher_id' , 'student_class_id' , 'id' , 'student_class_id');
    }
}
