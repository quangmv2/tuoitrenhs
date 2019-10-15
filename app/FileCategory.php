<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileCategory extends Model
{
    protected $table = 'file_category';

    public function tintuc()
     {
     	return $this->hasMany('App\File', 'category', 'id');
     }
}
