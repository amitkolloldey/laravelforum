<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\CommentNotification;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    public function storeComment(Request $request,Topic $topic)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('commentcreateerror','Comment is Required');
            return redirect(route('topic.show',$topic->id.'#lf_comment_create_form'));
        }
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::user()->id;
        $comment = $topic->comments()->save($comment);
        if($comment->user_id != $topic->user_id){
            $topic->user->notify(new CommentNotification($topic));
        }
        return redirect(route('topic.show',$topic->id.'#commentno'.$comment->id));
    }


    public function storeReply(Request $request,Comment $comment)
    {
        $validator = Validator::make($request->all(), [
            'replybody' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('replybody'.$comment->id,'Reply is Required');
            return redirect(route('topic.show',$comment->commentable_id.'#commentno'.$comment->id));
        }

        $reply = new Comment();
        $reply->body = $request->replybody;
        $reply->user_id = Auth::user()->id;
        $comment->comments()->save($reply);
        Session::flash('replyadded'.$comment->id,'Reply added');
        return redirect(route('topic.show',$request->topic_id.'#commentno'.$comment->id));
    }



    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update',$comment);
        $validator = Validator::make($request->all(), [
            'editcommentbody' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('editcommentbody'.$comment->id,'Comment is Required');
            return redirect(route('topic.show',$comment->commentable_id.'#commentno'.$comment->id));
        }
        $comment->update([
            'body' => $request->editcommentbody,
        ]);
        return redirect(route('topic.show',$comment->commentable_id.'#commentno'.$comment->id));
    }




    public function replyUpdate(Request $request,Comment $comment)
    {
        $this->authorize('update',$comment);
        $validator = Validator::make($request->all(), [
            'editreplybody' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('editreplybody'.$reply->id,'Reply is Required');
            return redirect(route('topic.show',$request->topic_id.'#commentno'.$request->comment_id));
        }
        $comment->update([
            'body' => $request->editreplybody,
        ]);
        return redirect(route('topic.show',$request->topic_id.'#commentno'.$request->comment_id));
    }


    public function replyDestroy(Request $request,Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comment->delete();
        Session::flash('commentmessage', "Reply Deleted");
        return redirect(route('topic.show',$request->topic_id.'#commentno'.$request->comment_id));
    }



    public function destroy(Comment $comment)
    {
        $this->authorize('delete',$comment);
        $comments = Comment::where('commentable_id',$comment->id)->get();
        foreach ($comments as $reply){
            Comment::where('id',$reply->id)->delete();
        }
        $comment->delete();
        Session::flash('commentmessage', "Comment Deleted");
        return redirect(route('topic.show',$comment->commentable_id.'#lf_comments_wrap'));
    }
}
