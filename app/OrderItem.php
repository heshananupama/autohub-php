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

    public function order()
    {
        return $this->belongsTo('App\Orders');
    }

    public function spare()
    {
        return $this->belongsTo('App\Spares','spare_id');

    }
}
