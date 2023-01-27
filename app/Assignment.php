<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable=[
              'answer','lesson_id','user_id'
        ];
    //Relationships

    //Inverse Relationships
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
