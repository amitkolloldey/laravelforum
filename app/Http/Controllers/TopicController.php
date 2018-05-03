<?php

namespace App\Http\Controllers;

use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth')->except('index','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

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
            'details' => 'required|min:20'
            ],
            ['title.unique' => 'This Topic Is Already Posted.']);

        $topic = auth()->user()->topic()->create($request->all());
        return redirect(route('topic.show',$topic->id))->withMessage('Topic Has Been Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sureDelete = __('Are you sure want to Delete?');
        $topic = Topic::findOrFail($id);
        $topicsCount = Topic::where('user_id', $topic->user->id)->get();
        return view('topics.show',compact('topic','sureDelete','topicsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        if(Auth::user()->id != $topic->user->id){
            return redirect('/');
        }
        return view('topics.edit',compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        if(Auth::user()->id != $topic->user->id){
            return redirect('/');
        }

        $this->validate($request,
            [
                'title' => 'required|min:20|unique:topics,title,'.$id,
                'details' => 'required|min:20'
            ],
            ['title.unique' => 'This Topic Is Already Posted.']
        );
        $topic->update($request->all());
        return redirect(route('topic.show',$id))->withMessage('Topic Has Been Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        if(Auth::user()->id != $topic->user->id){
            return redirect('/');
        }
        $topic->delete();
        return redirect('/')->withDanger('Topic Has Been Deleted!');
    }
}
