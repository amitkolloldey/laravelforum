<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'body','user_id'
    ];


    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }


    public function user(){
        return $this->belongsTo('App\User');
    }


    public function topic(){
        return $this->belongsTo('App\Topic');
    }

    /**
     * Get all of the Comment's replies.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
