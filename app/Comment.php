<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = "comments";

    public function item(){
        return $this->belongsTo('App\Item');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
