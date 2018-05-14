@extends('layouts.app')

@section('content')
    <div class="col-md-8 lf_topics_wrapper">

        @if (Session::has('danger'))
            <div class="alert alert-danger">{{ Session::get('danger') }}</div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        @forelse($taggedtopics as $taggedtopic)
                <div class="post">
                    <div class="wrap-ut pull-left">
                        <div class="userinfo pull-left">
                            <div class="avatar">
                                <a href="{{route('user.show',$taggedtopic->user->slug)}}"><img src="{{ Gravatar::get
                                ($taggedtopic->user->email,
                'default') }}" alt="{{$taggedtopic->user->name}}"></a>
                            </div>
                        </div>
                        <div class="posttext pull-left">
                            <h2 class="lf_topic_title"><a href="{{route('topic.show',$taggedtopic->slug)
                            }}">{{$taggedtopic->title}}</a></h2>
                            {!! str_limit(strip_tags(Michelf\Markdown::defaultTransform($taggedtopic->details)) ,200) !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="postinfo pull-left">
                        <div class="comments">
                            <div class="commentbg">
                                <a href="{{route('topic.show',$taggedtopic->slug)
                                .'#lf_comments_wrap'}}">{{$taggedtopic->comments->count()}}</a>
                                <div class="mark"></div>
                            </div>
                        </div>
                        <div class="views"><i class="fa fa-eye"></i> {{$taggedtopic->getPageViews()}}</div>
                        <div class="time"><i class="fa fa-clock-o"></i> {{ $taggedtopic->created_at->diffForHumans()}}</div>
                    </div>
                    <div class="clearfix"></div>
                </div>
        @empty
            <div class="alert alert-danger">
                {{__('No Topics Available With This Tag')}}
            </div>
        @endforelse
    </div>
@stop
@section('sidebar')
    @include('partials.sidebar',['usertopics' => $usertopics,'topicview' => $topicview,'tags'=>$tags])
@stop