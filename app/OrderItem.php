<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{

    protected $table='orderitem';

    protected $fillable = [
        'id','quantity','orderItemCompletedDate','subTotal','order_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

}
