<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';

    public function loaifile()
    {
    	return $this->belongsTo('App\FileCategory', 'category', 'id');
    }
}
