<a href="#" title="{{__('Reply')}}" class="lf_reply" data-toggle="modal" data-target="#lf_reply_modal{{$comment->id}}"><i class="fa fa-reply"></i></a>

<div id="lf_reply_modal{{$comment->id}}"  class="lf_modal modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body ">
                <form action="{{route('topic.reply.create',$comment->id)}}" class="form" method="post">
                    @if (Session::has('replybody'.$comment->id))
                        <div class="alert alert-danger">{{ Session::get('replybody'.$comment->id) }}</div>
                        <script>
                            $(document).ready(function() {
                                $('#lf_reply_modal{{$comment->id}}').modal('show');
                            });
                        </script>
                    @endif
                    {{csrf_field()}}
                    {{method_field('POST')}}
                    <div class="postinfobot">
                        <textarea class="form-control" id="replybody" rows="5" name="replybody" data-provide="markdown" data-iconlibrary="fa" data-hidden-buttons="cmdPreview">{{old('replybody')}}</textarea>
                        <input type="hidden" value="{{$topic->id}}" name="topic_id">
                        <div class="pull-right postreply">
                            <div class="pull-left"><button type="submit" class="btn btn-primary">{{__('Post Reply')}}</button></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>