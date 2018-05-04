<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'block'
    ];
    public function getBlockAttribute($value){
        $value = str_replace('</xmp>', '< / x m p >', $value); ;
        return "<pre class=\"language-php\"><code>&nbsp;<xmp>".$value."</xmp></code></pre>";
    }

    public function topic(){
        return $this->belongsTo('App\Topic');
    }
}
