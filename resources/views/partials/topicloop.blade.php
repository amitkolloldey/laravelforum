<div class="post">
    <div class="wrap-ut pull-left">
        <div class="userinfo pull-left">
            <div class="avatar">
                <img src="{{ Gravatar::get($topic->user->email,'default') }}" alt="{{$topic->user->name}}">
                <div class="status green">&nbsp;</div>
            </div>
            @if(Auth::check() && Auth::user()->id == $topic->user->id)
                <div class="lf_icons">
                    <div class="lf_edit">
                        <a href="{{route('topic.edit',$topic->id)}}" title="{{__('Edit')}}"><i class="fa fa-edit"></i></a>
                    </div>
                    <div class="lf_del">
                        <form action="{{route('topic.destroy',$topic->id)}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" onclick="return confirm('{{$sureDelete}}')"><i class="fa fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @endif
            <div class="icons">
                <img src="images/icon1.jpg" alt=""><img src="images/icon4.jpg" alt="">
            </div>
        </div>
        <div class="posttext pull-left">
            <h2 class="lf_topic_title"><a href="{{route('topic.show',$topic->id)}}">{{$topic->title}}</a></h2>
            <p>{!! str_limit(Michelf\Markdown::defaultTransform(strip_tags($topic->details)) ,100)  !!}</p>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="postinfo pull-left">
        <div class="comments">
            <div class="commentbg">
                {{$topic->comments()->count()}}
                <div class="mark"></div>
            </div>

        </div>
        <div class="views"><i class="fa fa-eye"></i> {{$topic->getPageViews()}}</div>
        <div class="time"><i class="fa fa-clock-o"></i> {{ $topic->created_at->diffForHumans()}}</div>
    </div>
    <div class="clearfix"></div>
</div>