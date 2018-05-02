<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $topics = Topic::paginate(10);
        return view('home',compact('topics'));
    }

}
