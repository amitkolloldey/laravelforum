<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Topic;

use Cviebrock\EloquentTaggable\Models\Tag;
use Cviebrock\EloquentTaggable\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TopicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->take(10)
            ->get();
        $usertopics = Topic::where('user_id',Auth::id())->take(10)->get();
        $tagService = app(TagService::class);
        $tags = $tagService->getPopularTags(20);
        return view('topics.create',compact('topic','sureDelete','topicsCount','comments','liked_user','usertopics','topicview','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,
            [
            'title' => 'required|unique:topics|min:20',
            'details' => 'required|min:100',
            //'g-recaptcha-response' => 'required|captcha'
            ],
            ['title.unique' => 'This Topic Is Already Posted.']);

        $tags = explode(',',$request->tags);
        $topic = auth()->user()->topic()->create($request->all());
        $topic->tag($tags);
        return redirect(route('topic.show',$topic->id))->withMessage(__('Topic Has Been Created Successfully!'));
    }



    public function show(Topic $topic)
    {
        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->take(10)
            ->get();
        $usertopics = Topic::where('user_id',Auth::id())->take(10)->get();
        $sureDelete = __('Are you sure want to Delete?');
        $comments = Comment::where('commentable_id',$topic->id)->orderBy('id', 'asc')->paginate(20);
        $topic = Topic::findOrFail($topic->id);
        $topic->addPageView();
        $topicsCount = Topic::where('user_id', $topic->user->id)->get();
        if($topic->likes()->count() > 0){
            $like = Like::where('likeable_id', $topic->id)->first();
            $liked_user = $like->user_id;
        }else{
            $liked_user = 0;
        }
        $tagService = app(TagService::class);
        $tags = $tagService->getPopularTags(20);
        return view('topics.show',compact('topic','sureDelete','topicsCount','comments','liked_user','usertopics','topicview','tags'));
    }

    public function edit(Topic $topic)
    {
        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->take(10)
            ->get();
        $usertopics = Topic::where('user_id',Auth::id())->take(10)->get();
        $this->authorize('update', $topic);
        $tagService = app(TagService::class);
        $tags = $tagService->getPopularTags(20);
        return view('topics.edit',compact('topic','usertopics','topicview','tags'));
    }


    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $this->validate($request,
            [
                'title' => 'required|min:20|unique:topics,title,'.$topic->id,
                'details' => 'required|min:20',
                //'g-recaptcha-response' => 'required|captcha'
            ],
            ['title.unique' => 'This Topic Is Already Posted.']
        );
        $tags = explode(',',$request->tags);
        $topic->update($request->all());
        $topic->retag($tags);
        return redirect(route('topic.show',$topic))->withMessage(__('Topic Has Been Updated Successfully!'));
    }


    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);

        $comments = Comment::where('commentable_id',$topic->id)->get();
        foreach($comments as $comment){
            Comment::where('commentable_id',$comment->id)->delete();
        }
        Comment::where('commentable_id',$topic->id)->delete();
        Like::where('likeable_id',$topic->id)->delete();
        $topic->detag();
        $topic->delete();
        return redirect('/')->withMessage(__('Topic Has Been Deleted!'));
    }



    public function bestAnswer(Topic $topic)
    {
        $this->authorize('update', $topic);
        $commentId = Input::get('commentId');
        $topic->best_answer = $commentId;
        if ($topic->save()) {
            if (request()->ajax()) {
                return response()->json(['status' => 'success', 'message' => 'marked as best answer.']);
            }
        }
        return back()->withMessage('Marked as Best Answer.');
    }


    public function sortByTags(Tag $tag)
    {
        $sureDelete = __('Are you sure want to Delete?');
        $tag = Tag::findOrFail($tag->tag_id);
        $taggedtopics = Tag::findByName($tag->name)->topics;

        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->take(10)
            ->get();
        $usertopics = Topic::where('user_id',Auth::id())->take(10)->get();
        $tagService = app(TagService::class);
        $tags = $tagService->getPopularTags(20);
        return view('topics.sortbytags',compact('taggedtopics','topicview','usertopics','tags'));
    }



    public function makeAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
    }


}
