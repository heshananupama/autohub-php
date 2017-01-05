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

    public function orderItem()
    {
        return $this->hasMany('App\OrderItem','order_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
