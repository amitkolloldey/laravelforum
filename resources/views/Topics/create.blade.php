@extends('layouts.app')
@section('tab-title')
    {{__('- Create Topic')}}
@stop
@section('content')
    <div class="col-md-8">
        <div class="lf_page_title">
            <h2>{{__('Create New Topic')}}</h2>
        </div>
        <form action="" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="title">{{__('Topic Title')}}</label>
                <input type="text" class="form-control" id="title" placeholder="{{__('Enter Title For The Topic')}}">
            </div>
            <div class="form-group">
                <label for="details">{{__('Details')}}</label>
                 <textarea class="form-control" id="details" rows="3"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="{{__('Submit Topic')}}">
            </div>
        </form>
    </div>
@stop

@section('sidebar')
    @include('partials.sidebar')
@stop