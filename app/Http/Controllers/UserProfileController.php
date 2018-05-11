<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserProfileController extends Controller
{
    public function show($id){
        $user = User::findOrFail($id);
        $comments = Comment::where('user_id',$id)->orderBy('id', 'asc')->paginate(5);
        $topics = Topic::where('user_id',$id)->orderBy('id', 'asc')->paginate(5);
        $commented_topics = DB::table('topics')
            ->join('comments', 'comments.commentable_id', '=', 'topics.id')
            ->select('topics.*','comments.body')
            ->paginate(5);
        $liked_topics = DB::table('topics')
            ->join('likes', 'likes.likeable_id', '=', 'topics.id')
            ->select('topics.*')
            ->paginate(5);
        return view('profile.show',compact('user','commented_topics','topics','liked_topics'));
    }
}
