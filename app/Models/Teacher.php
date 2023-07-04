<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class   Teacher extends Model
{

    protected $fillable = ['name', 'deleted_by', 'user_id'];
    use HasFactory;


    public function studentClass()
    {
        return $this->belongsToMany(studentClass::class);
    }

    public function Student()
    {
        return $this->hasManyThrough(Student::class, Pivot::class, 'teacher_id', 'student_class_id', 'id', 'student_class_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }


//    public function class_detail()
//    {
//        return $this->hasManyThrough(
//            studentClass::class,
//            Pivot::class,
//            'teacher_id', // Foreign key on the environments table...
//            'id', // Foreign key on the deployments table...
//            'id', // Local key on the projects table...
//            'student_class_id' // Local key on the environments table...
//        );
//    }
}
