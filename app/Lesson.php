<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name_ar', 'name_en','video' ,'material' , 'course_id', 'assignment','assignmentCorrectAnswer',   'exam','examCorrectAnswer','examTotalMark'
    ];

    //Relationship
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    //InverseRelationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

