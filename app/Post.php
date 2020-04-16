<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    protected $guarded = [];
    //// USER and Post Relationship
    public function user()
    {
        return $this->belongsTo('App\User', 'submitted_by', 'id');
    }

    public function user2()
    {
        return $this->hasOne('App\User', 'id', 'submitted_by');
    }
}


