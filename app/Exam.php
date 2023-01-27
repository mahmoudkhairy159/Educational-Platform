<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'answer', 'mark', 'lesson_id', 'user_id'
    ];
    //relationships

    //inverseRelationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
