<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\TrainerProfile;
use App\Course;

class trainer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard ='trainer';
    protected $fillable = [
        'name', 'email', 'password','phone','address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relationships
    public function trainerProfile()
    {
        return $this->hasOne(TrainerProfile::class);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(
            'App\Lesson',
            'App\Course',
            'trainer_id', // Foreign key on courses table...
            'course_id', // Foreign key on lessons table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
        );
    }
}
