<?php

namespace App\Http\Controllers;

use App\Topic;
use Cviebrock\EloquentTaggable\Services\TagService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home(){
        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->take(10)
            ->get();
        $usertopics = Topic::where('user_id',Auth::id())->take(10)->get();
        $sureDelete = __('Are you sure want to Delete?');
        $topics = Topic::orderBy('id', 'desc')->paginate(10);
        $tagService = app(TagService::class);
        $tags = $tagService->getPopularTags(20);
        return view('home',compact('topics','sureDelete','usertopics','topicview','tags'));
    }
}
