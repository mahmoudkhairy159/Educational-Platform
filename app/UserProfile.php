<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\User;

class UserProfile extends Authenticatable
{
    use Notifiable;
    protected $table='usersProfiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
     'nationalId','gender','governorate','city','educationType','educationYear','photo','user_id'
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
