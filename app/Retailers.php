<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retailers extends Model
{
    protected $table='retailers';
    protected $fillable=['id','user_id','address','shopName','avatarImage'];


}
