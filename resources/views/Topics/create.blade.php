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
                    <div class="alert alert-danger">{{ $error }}</div>
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
                    <textarea class="form-control" id="details" rows="20" name="details" data-provide="markdown" data-iconlibrary="fa" data-hidden-buttons="cmdPreview">{{old('details')}}</textarea>
                </div>

                <div class="form-group">
                    <label for="tags">{{__('Tags')}}</label>
                    <input type="text" class="form-control" id="tags" name="tags" value="{{old('tags')}}" data-role="tagsinput">
                </div>
                <div class="form-group">
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
    @include('partials.sidebar',['usertopics' => $usertopics,'topicview' => $topicview,'tags'=>$tags])
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('front/tagsinput.css')}}">
    <link rel="stylesheet" href="{{asset('front/typeaheadjs.css')}}">
    {!! NoCaptcha::renderJs() !!}
@stop
@section('scripts')
    <script src="{{asset('front/tagsinput.js')}}"></script>
    <script src="{{asset('front/typeahead.js')}}"></script>
    <script>

        var tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: "{{url('tag/names')}}",
                cache: false
            }
        });
        tags.initialize();

        $('#tags').tagsinput({
            typeaheadjs: {
                name: 'tags',
                source: tags.ttAdapter()
            }
        });
    </script>
@stop
