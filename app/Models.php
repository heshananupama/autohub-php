<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $table='models';

    protected $fillable = [
        'id','modelName','transmissionType','fuelType','engineCapacity','countryMade','admin_id','brandName','yearOfManufacture',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function spares()
    {
        return $this->hasMany('App\Spares');
    }

}
