<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{

    protected $fillable = ['name' , 'deleted_by'];
    use HasFactory ,SoftDeletes;

    public function studentClass(){
        return $this->belongsToMany(studentClass::class);
    }
    public function Student(){
        return $this->hasManyThrough(Student::class , Pivot::class , 'teacher_id' , 'student_class_id' , 'id' , 'student_class_id');
    }
}
