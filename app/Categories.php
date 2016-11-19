<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table='categories';

    protected $fillable = [
        'id','categoryName','admin_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
