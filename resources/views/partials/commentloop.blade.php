<div class="post lf_comment_list" id="commentno{{$comment->id}}">
    <div class="topwrap">
        <div class="posttext">
            <div class="avatar">
                <a href="{{route('user.show',$comment->user_id)}}"><img src="{{ Gravatar::fallback(url('uploads/avater
                .png'))->get
                ($comment->user->email) }}" alt="{{$comment->user->name}}">
                <strong class="lf_commenter_name">{{$comment->user->name .' '}} <span>{{ __('said')}}</span></strong>
                </a>
            </div>
            {!! Michelf\Markdown::defaultTransform(strip_tags($comment->body))  !!}
        </div>
    </div>
    <div class="postinfobot">
        <div class="userinfo">
            @can('update',$comment)
                <div class="lf_icons pull-right">
                    <div class="lf_edit pull-right">
                        @include('partials.commentedit')
                    </div>
                    @can('delete',$comment)
                    <div class="lf_del pull-right">
                        <form action="{{route('comment.destroy',$comment->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('{{$sureDelete}}')"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                    @endcan
                    <div class="clearfix"></div>
                </div>
            @endcan
            <div class="posted pull-left" >
                <span class=" pull-left"><i class="fa fa-clock-o"></i>{{ $comment->created_at->diffForHumans()}}</span>
                @if($comment->comments()->count() > 0)
                    <span> | </span>
                <a href="#lf_reply{{$comment->id}}" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="lf_reply"> {{__('View Replies '.$comment->comments()->count()) }}</a>
                @endif
                @if(Auth::check())
                    <div class="pull-left">
                        @include('partials.replyform')
                    </div>
                @endif
                @can('update',$topic)
                <div class="lf_ba pull-left" >
                    @if($topic->best_answer == $comment->id)
                        <a href="#" title="{{__('Marked As Best Answer')}}" onclick="event.preventDefault();bestAnswer('{{$topic->id}}','{{$comment->id}}',this)"><i class="fa fa-check-circle"></i></a>
                    @else
                        <a href="#" title="{{__('Mark As Best Answer')}}" onclick="event.preventDefault();bestAnswer('{{$topic->id}}','{{$comment->id}}',this)"><i class="fa fa-check-circle-o"></i></a>
                    @endif
                </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="collapse" id="lf_reply{{$comment->id}}">
    @foreach($comment->comments as $reply)
            @include('partials.replyloop')
    @endforeach
    </div>
</div>
