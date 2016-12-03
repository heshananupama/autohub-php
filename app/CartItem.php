<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table='cartitem';

    protected $fillable = [
        'id','spare_id','quantity','cart_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function spare()
    {
        return $this->belongsTo('App\Spares','spare_id');

    }

    public function shoppingCart()
    {

        return $this->belongsTo('App\ShoppingCart','cart_id');

    }
}
