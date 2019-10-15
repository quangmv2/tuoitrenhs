<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    public function user()
    {
        return $this->beLongsToMany('App\Users', 'role_relationship', 'role_id', 'id');
    }

}
