<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body', 'image'
    ];

     protected $hidden = [
       'remember_token',
    ];
}
