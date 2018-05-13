@extends('layouts.app')
@section('tab-title')
    {{'- ' . $topic->title}}
@stop
@section('content')
    <div class="col-md-8 lf_topics_wrapper">
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        @include('partials.singletopic')
        <div class="lf_comment_wrapper" id="lf_comments_wrap">
            @if (Session::has('commentmessage'))
                <div class="alert alert-success">{{ Session::get('commentmessage') }}</div>
            @endif
                @forelse($comments as $comment)
                    @include('partials.commentloop')
                @empty

                <div class="post">
                    <div class="alert alert-info">
                        {{__('Become first one to comment on this topic?')}}
                    </div>
                </div>
            @endforelse
           {{$comments->fragment('lf_comments_wrap')->links()}}
            @if(Auth::check())
                @include('partials.commentform')
            @else
            <div class="post">
                <div class="alert alert-success">
                    <a href="{{route('login')}}">{{__('Please Login To Leave A Comment')}}</a>
                </div>
            </div>
            @endif
        </div>
    </div>
@stop
@section('sidebar')
    @include('partials.sidebar',['usertopics' => $usertopics,'topicview' => $topicview])
@stop




