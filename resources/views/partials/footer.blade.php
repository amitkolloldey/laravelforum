<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-xs-12 col-sm-6 ">Copyrights 2018, {{config('app.name')}}</div>
            <div class="col-lg-3 col-xs-12 col-sm-6 sociconcent">
                <ul class="socialicons">
                    <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    <li><a href="#"><i class="fa fa-cloud"></i></a></li>
                    <li><a href="#"><i class="fa fa-rss"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>

<script src="{{asset('front/jquery.js')}}"></script>
<script src="{{asset('front/prism.js')}}"></script>
<script src="//cdn.ckeditor.com/4.9.2/standard/ckeditor.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        // $('#code_block').each(function(i, block) {
        //     hljs.highlightBlock(block);
        // });
        $(function() {
            $source=$("#code");
            $output=$("#code_output");
            $source.keyup(function() {
                $output.text($source.val());
            });
        });
    });
    CKEDITOR.replace( 'details', {
        toolbar: [
            { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'Preview', 'Print', '-', 'Templates' ] },

            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline',
                    'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
            { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', items: [ 'Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar',
                    'PageBreak', 'Iframe' ] },
        ],
        uiColor: '#25D6D1'
    });

</script>

</body>
</html>
