<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Xetaio\Mentions\Models\Traits\HasMentionsTrait;

class Comment extends Model
{
    use HasMentionsTrait;

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

    /**
     * Get all of the Comment's replies.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
