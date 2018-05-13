<?php

namespace App\Http\Controllers;

use App\Like;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function likeTopic()
    {
        $topicId = Input::get('topicId');
        $topic = Topic::find($topicId);
        $like = new Like();
        $like->user_id = Auth::id();
        $check_user_liked = $topic->likes()->where('user_id',Auth::id())->where('likeable_id',$topicId)->first();
        if(!$check_user_liked){
            $topic->likes()->save($like);
            return response()->json(['status' => 'success', 'message' => 'liked']);
        }else{
            $topic->likes()->delete();
            return response()->json(['status' => 'success', 'message' => 'unliked']);
        }
    }
}
