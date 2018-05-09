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
                @if(Auth::check() && Auth::user()->id == $topic->user->id)
                <div class="lf_ba pull-left" >
                    @if($topic->best_answer == $comment->id)
                        <a href="#" title="{{__('Marked As Best Answer')}}" onclick="event.preventDefault();bestAnswer('{{$topic->id}}','{{$comment->id}}',this)"><i class="fa fa-check-circle"></i></a>
                    @else
                        <a href="#" title="{{__('Mark As Best Answer')}}" onclick="event.preventDefault();bestAnswer('{{$topic->id}}','{{$comment->id}}',this)"><i class="fa fa-check-circle-o"></i></a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="collapse" id="lf_reply{{$comment->id}}">
    @foreach($comment->comments as $reply)
            @include('partials.replyloop')
    @endforeach
    </div>
</div>
@section('scripts')
    <script>
        function bestAnswer(topicId, commentId, elem) {
            var csrfToken='{{csrf_token()}}';
            $.post('{{route('bestAnswer')}}', {commentId: commentId, topicId: topicId,_token:csrfToken}, function (data) {
                $(elem).html('<i class="fa fa-check-circle"></i>');
                location.reload();
            });}

        function like(topicId, elem) {
            var csrfToken='{{csrf_token()}}';
            $.post('{{route('likeTopic')}}', {topicId: topicId,_token:csrfToken}, function
                (data) {
                $(elem).addClass(' liked');
                location.reload();
            });}
    </script>
@endsection