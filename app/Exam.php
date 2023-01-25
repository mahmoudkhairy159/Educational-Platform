<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable=[
        'exam','answer','correctAnswer','mark','totalMark','lesson_id',
    ];
    //relationships

    //inverseRelationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
