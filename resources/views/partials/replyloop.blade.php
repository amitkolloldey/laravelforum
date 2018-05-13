<div class="post lf_comment_list lf_reply_list" id="replyno{{$reply->id}}">
    <div class="topwrap">
        <div class="posttext">
            <div class="avatar">
                <a href="{{route('user.show',$reply->user_id)}}">
                    <img src="{{ Gravatar::fallback(url('uploads/avater.png'))->get($reply->user->email) }}"
                         alt="{{$reply->user->name}}">
                    <strong class="lf_commenter_name">{{$reply->user->name .' '}} <span>{{ __('Replied')}}</span></strong>
                </a>
            </div>
            {!! Michelf\Markdown::defaultTransform(strip_tags($reply->body))  !!}
        </div>
    </div>
    <div class="postinfobot">
        <div class="userinfo">

            {{--@can('update',$comment)--}}
                <div class="lf_icons pull-right">
                    <div class="lf_edit pull-right">
                        @include('partials.replyedit')
                    </div>
                    <div class="lf_del pull-right">
                        <form action="{{route('reply.delete',$reply->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <input type="hidden" name="topic_id" value="{{$topic->id}}">
                            <button type="submit" onclick="return confirm('{{$sureDelete}}')"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            {{--@endcan--}}
            <div class="posted pull-left">
                <i class="fa fa-clock-o"></i> {{ $reply->created_at->diffForHumans()}}
            </div>
        </div>
    </div>
</div>