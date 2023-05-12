<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentClass extends Model
{
    use HasFactory;
    function Teacher(){
        return $this->belongsToMany(Teacher::class);
    }
    function Student(){
        return $this->hasMany(Student::class);
    }
}
