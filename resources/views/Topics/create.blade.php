@extends('layouts.app')
@section('tab-title')
    {{__('- Create Topic')}}
@stop
@section('content')
    <div class="col-md-8 ">
        <div class="lf_wrap_content">
            <div class="lf_page_title">
                <h2>{{__('Create New Topic')}}</h2>
            </div>
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{ __($error) }}</div>
                @endforeach
            @endif
            <form action="{{route('topic.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="title">{{__('Topic Title')}}</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Enter Title For The Topic')}}" value="{{old('title')}}">
                </div>
                <div class="form-group">
                        <label for="details">{{__('Details')}}</label>
                        <textarea id="details" class="form-control" name="details" rows="10">{{old('details')}}</textarea>
                        <p><em>{{__('You can\'t paste code here. Use "Code" field for that.')}}</em></p>
                </div>
                <div class="form-group">
                        <label for="block">{{__('Code')}}</label>
                        <textarea id="code" class="form-control" name="block" rows="10">{{old('block')}}</textarea>
                        <p><em>{{__('Paste Your code here.')}}</em></p>
                </div>
                <div class="form-group">
                    {!! NoCaptcha::renderJs() !!}
                    {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{__('Submit Topic')}}">
                </div>
            </form>
        </div>
    </div>

@stop

@section('sidebar')
    @include('partials.sidebar')
@stop