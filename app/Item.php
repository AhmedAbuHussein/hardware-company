<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $table = "items";
    
    public function category(){
        return $this->belongsto('App\Category');
    }

    public function user(){
        return $this->belongsto('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
