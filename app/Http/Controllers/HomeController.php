<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(){
        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->paginate(10);
        $usertopics = Topic::where('user_id',Auth::id())->paginate(5);
        $sureDelete = __('Are you sure want to Delete?');
        $topics = Topic::orderBy('id', 'desc')->paginate(10);
        return view('home',compact('topics','sureDelete','usertopics','topicview'));
    }
}
