<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    protected $table='retailers';
    protected $fillable=['id','user_id','address','shopName'];
}
