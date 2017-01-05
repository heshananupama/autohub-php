<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->type; // this looks for an admin column in your users table
    }
    public function spares()
    {
        return $this->hasMany('App\Spares');
    }

    public function orders()
    {
        return $this->hasMany('App\Orders');
    }

    public function Enquiries()
    {
        return $this->hasMany('App\Enquiries');
    }

    public function Messages()
    {
        return $this->hasMany('App\Message');
    }


    public function feedback()
    {
        return $this->hasMany('App\Feedback');
    }
}
