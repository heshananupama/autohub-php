<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Spares extends Model
{
    protected $table='spares';

    protected $fillable = [
        'id','partNumber','quantity','price','warranty','retailer_id','brand_id','model_id','category_id','image','description'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function brand()
    {
        return $this->belongsTo('App\Brands');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'retailer_id');
    }



    public function cartItem()
    {
        return $this->hasMany('App\CartItem');

    }

    public function orderItem()
    {
        return $this->hasMany('App\OrderItem');

    }


    public function model()
    {
        return $this->belongsTo('App\Models');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories');
    }
}
