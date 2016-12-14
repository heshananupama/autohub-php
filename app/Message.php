<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='messages';

    protected $fillable = [
        'id','messageType','user_id','retailer_id','message',
    ];
    public function customer()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function retailer()
    {
        return $this->belongsTo('App\User', 'retailer_id');
    }
}
