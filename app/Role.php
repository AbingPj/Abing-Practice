<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  
    public function users()
    {
        return $this->hasMany('App\User', 'role_id', 'id');
    }

    // public function users2()
    // {
    //     return $this->belongsToMany('App\Role', 'users', 'role_id', 'role_id');
    // }
}
