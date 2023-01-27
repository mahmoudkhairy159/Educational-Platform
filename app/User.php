<?php

namespace App;



use App\Course;
use App\UserProfile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/*Student*/
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }





    //inverse Relationships

}
