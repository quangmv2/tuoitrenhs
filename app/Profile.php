<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    
    protected $table = 'profile';

  	public function user()
  	{
  		return $this->belongsTo('App\User', 'username', 'username');
  	}

}
