<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiries extends Model
{
    protected $table='enquiries';

    protected $fillable = [
        'id','name','message','contactNo','email',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
