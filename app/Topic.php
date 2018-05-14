<?php

namespace App;

use Cviebrock\EloquentTaggable\Taggable;
use CyrildeWit\PageViewCounter\Traits\HasPageViewCounter;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Topic extends Model
{
    use Taggable;
    use Searchable;

    use HasPageViewCounter;

    protected $fillable = [
        'title','details','user_id'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    /**
     * Get all of the Topic's comments.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }


    /**
     * Get all of the Like's.
     */
    public function likes()
    {
        return $this->morphMany('App\Like', 'likeable');
    }

}
