<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table='orders';

    protected $fillable = [
        'id','orderDate','orderTotal','shippingAddress','user_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
