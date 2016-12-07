<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table='feedback';

    protected $fillable = [
        'id','feedbackType','rating','description','feedbackStatus' ,'orderItem_id','phoneNumber'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
