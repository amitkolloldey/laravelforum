<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['title','details','user_id','code_id'];


    public function user(){
        return $this->belongsTo('App\User','user_id');
    }


    public function code(){
        return $this->hasOne('App\Code');
    }
}
