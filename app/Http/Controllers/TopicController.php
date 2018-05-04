<?php

namespace App\Http\Controllers;

use App\Code;
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
        //dd($request->all());
        $request_data = $request->only('title', 'details');
        $request_code = $request->only('block');
       // $request_code['block'] = str_replace('</xmp>', '< / xmp >', $request_code['block']);
        $this->validate($request,
            [
            'title' => 'required|unique:topics|min:20',
            'details' => 'required|min:20',
            //'g-recaptcha-response' => 'required|captcha'
            ],
            ['title.unique' => 'This Topic Is Already Posted.']);
        $code = Code::create([
            'block' => $request_code['block']
        ]);
        $topic = auth()->user()->topic()->create([
            'title' => $request_data['title'],
            'details' => $request_data['details'],
            'code_id' => $code->id,
        ]);
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
        $code = Code::findOrFail($topic->code_id);
        $topicsCount = Topic::where('user_id', $topic->user->id)->get();
        return view('topics.show',compact('topic','sureDelete','topicsCount','code'));
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
        $code = Code::findOrFail($topic->code_id);

        if(Auth::user()->id != $topic->user->id){
            return redirect('/');
        }
        return view('topics.edit',compact('topic','code'));
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
        $code = Code::findOrFail($topic->code_id);
        $code->update([
            'block' => $request->block
        ]);
        $topic->update([
            'title' => $request->title,
            'details' => $request->details
        ]);
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
