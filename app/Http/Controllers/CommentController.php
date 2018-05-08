<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Xetaio\Mentions\Parser\MentionParser;

class CommentController extends Controller
{

    public function storeComment(Request $request,Topic $topic)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|min:20',
        ]);
        if ($validator->fails()) {
            Session::flash('commentcreateerror','Comment is Required and minimum 20 characters');
            return redirect(route('topic.show',$topic->id.'#lf_comment_create_form'));
        }

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::user()->id;
        $comment = $topic->comments()->save($comment);
        // Register a new Parser and parse the content.
        $parser = new MentionParser($comment);
        $content = $parser->parse($comment->body);
        $comment->body = $content;
        $comment->save();
        return redirect(route('topic.show',$topic->id.'#commentno'.$comment->id));
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if(Auth::user()->id != $comment->user_id){
            return redirect('/');
        }
        $validator = Validator::make($request->all(), [
            'editcommentbody' => 'required|min:20',
        ]);
        if ($validator->fails()) {
            Session::flash('editcommentbody'.$comment->id,'Comment is Required and minimum 20 characters');
            return redirect(route('topic.show',$comment->commentable_id.'#commentno'.$comment->id));
        }
        $comment->update([
            'body' => $request->editcommentbody,
        ]);
        return redirect(route('topic.show',$comment->commentable_id.'#commentno'.$comment->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commentdata = Comment::findOrFail($id);
        if(Auth::user()->id != $commentdata->user_id){
            return redirect('/');
        }
        $commentdata->delete();
        Session::flash('commentmessage', "Comment Deleted");
        return redirect(route('topic.show',$commentdata->commentable_id.'#lf_comments_wrap'));
    }
}
