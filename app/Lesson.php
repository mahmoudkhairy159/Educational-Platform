<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'material', 'course_id'
    ];

    //Relationship
    public function assignment()
    {
        return $this->hasOne(Assignment::class);
    }

    public function exam()
    {
        return $this->hasOne(Exam::class);
    }

    //InverseRelationship
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

