<div class="post lf_comment_list" id="commentno{{$comment->id}}">
    <div class="topwrap">
        <div class="posttext">
            <div class="avatar">
                <img src="{{ Gravatar::fallback(url('uploads/avater.png'))->get($comment->user->email) }}"
                     alt="{{$topic->user->name}}">
                <strong class="lf_commenter_name">{{$comment->user->name .' '}} <span>{{ __('said')}}</span></strong>
            </div>
            {!! Michelf\Markdown::defaultTransform(strip_tags($comment->body))  !!}
        </div>
    </div>
    <div class="postinfobot">
        <div class="userinfo">

            @if(Auth::check() && Auth::user()->id == $comment->user_id)
                <div class="lf_icons pull-right">
                    <div class="lf_edit pull-right">
                        @include('partials.commentedit')
                    </div>
                    <div class="lf_del pull-right">
                        <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('{{$sureDelete}}')"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endif
            <div class="posted pull-left">
                <i class="fa fa-clock-o"></i> {{ $comment->created_at->diffForHumans()}}
                @if($comment->comments()->count() > 0)
                <a href="#lf_reply{{$comment->id}}" data-toggle="collapse" role="button" aria-expanded="false"
                   aria-controls="lf_reply">{{__('View Replies '.$comment->comments()->count()) }}</a>
                @endif
                @include('partials.replyform')
            </div>
        </div>
    </div>
    <div class="collapse" id="lf_reply{{$comment->id}}">
    @foreach($comment->comments as $reply)
            @include('partials.replyloop')
    @endforeach
    </div>
</div>

