<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable=[
        'assignment','answer','correctAnswer','lesson_id'
        ];
    //Relationships

    //Inverse Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
