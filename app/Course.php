<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected  $fillable=[
        'name_ar','name_en','description_ar','description_en','photo','trainer_id'
    ];

    // Relationships
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function exam()
    {
        return $this->hasOneThrough(
            'App\Exam',
            'App\Lesson',
            'course_id', // Foreign key on lessons table...
            'lesson_id', // Foreign key on exams table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
    public function assignment()
    {
        return $this->hasOneThrough(
            'App\Assignment',
            'App\Lesson',
            'course_id', // Foreign key on lessons table...
            'lesson_id', // Foreign key on assignments table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
    //inverse Relationships
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function trainer()
    {
        return $this->belongsTo(Trainer::class);
    }


}
