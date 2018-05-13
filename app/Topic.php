<?php

namespace App;

use CyrildeWit\PageViewCounter\Traits\HasPageViewCounter;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    use HasPageViewCounter;

    protected $fillable = [
        'title','details','user_id'
    ];



    use HasPageViewCounter;


    public function user(){
        return $this->belongsTo('App\User');
    }


    public function getDetailsAttribute($value){
        $value =  str_replace('<code>','<code class="language-php"><xmp>',$value);
        return str_replace('</code>','</xmp></code>',$value);
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
