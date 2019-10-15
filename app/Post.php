<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function loaitin()
    {
    	return $this->belongsTo('App\PostCategory', 'category', 'id');
    }

}
