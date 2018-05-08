@extends('layouts.app')

@section('content')
    <div class="col-md-8 lf_topics_wrapper">
        {{ $topics->links() }}

        @if (Session::has('danger'))
            <div class="alert alert-danger">{{ Session::get('danger') }}</div>
        @endif
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
        @endif
        @forelse($topics as $topic)
            @include('partials.topicloop')
        @empty
        <div class="alert alert-danger">
            {{__('No Topics Available')}}
        </div>
        @endforelse

        {{ $topics->links() }}
    </div>
    @stop
@section('sidebar')
    @include('partials.sidebar')
@stop