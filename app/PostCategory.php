<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
     protected $table = 'post_categorys';

     public function tintuc()
     {
     	return $this->hasMany('App\Post', 'category', 'id');
     }

     public function muccon()
     {
     	return $this->belongsTo('App\PostCategory', 'parent_id', 'id');
     }

}
