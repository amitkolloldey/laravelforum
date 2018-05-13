<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Like;
use App\Topic;
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
        return view('topics.create');
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
             'g-recaptcha-response' => 'required|captcha'
            ],
            ['title.unique' => 'This Topic Is Already Posted.']);
        $topic = auth()->user()->topic()->create($request->all());
        return redirect(route('topic.show',$topic->id))->withMessage(__('Topic Has Been Created Successfully!'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->paginate(10);
        $usertopics = Topic::where('user_id',Auth::id())->paginate(5);
        $sureDelete = __('Are you sure want to Delete?');
        $comments = Comment::where('commentable_id',$id)->orderBy('id', 'asc')->paginate(5);
        $topic = Topic::findOrFail($id);
        $topic->addPageView();
        $topicsCount = Topic::where('user_id', $topic->user->id)->get();
        if($topic->likes()->count() > 0){
            $like = Like::where('likeable_id', $topic->id)->first();
            $liked_user = $like->user_id;
        }else{
            $liked_user = 0;
        }

        return view('topics.show',compact('topic','sureDelete','topicsCount','comments','liked_user','usertopics','topicview'));
    }

    public function edit(Topic $topic)
    {
        $topicview = Topic::select(DB::raw('topics.created_at,topics.id,topics.title, count(*) as aggregate'))
            ->join('page-views', 'topics.id', '=', 'page-views.visitable_id')
            ->groupBy('topics.title','topics.id','topics.created_at')
            ->orderBy('aggregate', 'desc')
            ->paginate(10);
        $usertopics = Topic::where('user_id',Auth::id())->paginate(5);
        $this->authorize('update', $topic);
        return view('topics.edit',compact('topic','usertopics','topicview'));
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
        $topic->update($request->all());
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


}
