<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table='brands';

    protected $fillable = [
        'id','brandName','admin_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function spares()
    {
        return $this->hasMany('App\Spares');
    }
}
