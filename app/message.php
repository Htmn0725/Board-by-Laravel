<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    protected
     $table = 'message';

     protected $fillable = [
         'view_name',
         'message',
     ];

     public function comments()
     {
        return $this->hasMany('App\Comment');
     }
}
