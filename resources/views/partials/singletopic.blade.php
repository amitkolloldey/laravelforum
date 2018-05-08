<div class="post beforepagination">
    <div class="topwrap">
        <div class="userinfo pull-left">
            <div class="avatar">
                <img src="{{ Gravatar::fallback(url('uploads/avater.png'))->get($topic->user->email) }}" alt="{{$topic->user->name}}">
                <div class="status green">&nbsp;</div>
                <p class="lf_points">{{ count($topicsCount) }}</p>
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
                <img src="images/icon1.jpg" alt=""><img src="images/icon4.jpg" alt=""><img src="images/icon5.jpg" alt=""><img src="images/icon6.jpg" alt="">
            </div>
        </div>
        <div class="posttext pull-left">
            <h2 class="lf_topic_title">{{$topic->title}}</h2>
            {!! Michelf\Markdown::defaultTransform(strip_tags($topic->details))  !!}
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="postinfobot">

        <div class="likeblock pull-left">
            <a href="#" class="up"><i class="fa fa-thumbs-o-up"></i>25</a>
            <a href="#" class="down"><i class="fa fa-thumbs-o-down"></i>3</a>
        </div>

        <div class="prev pull-left">
            <i class="fa fa-comment"></i> {{$topic->comments()->count()}}
        </div>

        <div class="next pull-right">

            <i class="fa fa-eye"></i>  {{$topic->getPageViews()}} <span> | </span>
            <i class="fa fa-clock-o"></i>  {{ $topic->created_at->diffForHumans()}}
        </div>

        <div class="clearfix"></div>
    </div>
</div>