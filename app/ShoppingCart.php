<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table='shoppingCart';

    protected $fillable = [
        'id','temporary','isCheckedOut',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cartItem()
    {
        return $this->hasMany('App\CartItem');

    }


}
