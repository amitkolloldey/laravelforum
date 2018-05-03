<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $sureDelete = __('Are you sure want to Delete?');
        $topics = Topic::orderBy('id', 'desc')->paginate(10);
        return view('home',compact('topics','sureDelete'));
    }

}
