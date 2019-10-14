<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    ////  USER and Role RelationShip
    public function user_role()
    {
      
        return $this->hasOne('App\Role', 'id', 'role_id');
    }

//   public function user_role2()
//   {
//      return $this->belongsTo('App\Role', 'role_id', 'id');
//   }

   
    //// USER and Post Relationship
    public function posts()
    {
        return $this->hasMany('App\Post', 'submitted_by', 'id');
    }

    // public function posts2()
    // {
    //     return $this->belongsToMany('App\User', 'posts', 'submitted_by', 'submitted_by');
    // }


    
  

    
    
}
