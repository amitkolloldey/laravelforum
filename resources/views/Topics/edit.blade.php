@extends('layouts.app')
@section('tab-title')
    {{'- Edit Topic'}}
@stop
@section('content')
    <div class="col-md-8">
        <div class="lf_wrap_content">
            <div class="lf_page_title">
                <h2>{{$topic->title}}</h2>
            </div>
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form action="{{route('topic.update',$topic->id)}}" method="post">
                {{csrf_field()}}
                {{method_field('PATCH')}}
                <div class="form-group">
                    <label for="title">{{__('Topic Title')}}</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Enter Title For The Topic')}}" value="{{$topic->title}}">
                </div>
                <div class="form-group">
                    <label for="details">{{__('Details')}}</label>
                    <textarea class="form-control" id="details" rows="20" name="details" data-provide="markdown"
                              data-iconlibrary="fa" data-hidden-buttons="cmdPreview">{{$topic->getOriginal()['details']}}</textarea>
                </div>
                <div class="form-group">
                    {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{__('Update Topic')}}">
                </div>
            </form>
        </div>
    </div>
@stop

@section('sidebar')
    @include('partials.sidebar')
@stop

@section('styles')
    {!! NoCaptcha::renderJs() !!}
@stop

