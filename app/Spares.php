<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spares extends Model
{
    protected $table='spares';

    protected $fillable = [
        'id','partNumber','quantity','price','warranty','retailer_id','brand_id','model_id','image','description'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function brand()
    {
        return $this->belongsTo('App\Brands');
    }


    public function model()
    {
        return $this->belongsTo('App\Models');
    }
}
