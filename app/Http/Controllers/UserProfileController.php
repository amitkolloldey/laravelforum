<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use App\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);
        $comments = Comment::where('user_id',$id)->orderBy('id', 'asc')->paginate(5);
        $topics = Topic::where('user_id',$id)->orderBy('id', 'asc')->paginate(5);
        return view('profile.show',compact('user','comments','topics'));
    }
}
