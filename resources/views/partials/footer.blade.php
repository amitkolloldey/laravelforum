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



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('front/bootstrap-markdown.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
<script>
    $(document).ready(function() {
        $(' code').each(function(i, block) {
            hljs.highlightBlock(block);
        });

    });
    function makeAsRead() {
        $.get('{{route('makeAsRead')}}');
    }
</script>

<!-- Initialize autocomplete menu -->
<script>
    var client = algoliasearch('7YAV3UVYFO', 'cd4df531f69b7b9a56df9a3dd4d037d3');
    var index = client.initIndex('topics');
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: true }, {
            source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function(suggestion) {
                    return '<span>' + suggestion._highlightResult.title.value.substr(0,20) +
                        '</span>' +
                        '<span> | </span>' +
                        '<span>' + suggestion._highlightResult.details.value.substr(0,50) + '</span>';
                },
                empty: function (result) {
                    return '<span class="alert">' +"{{__("Sorry Nothing Matched")}}"+ '</span>';
                }

            }
        }).on('autocomplete:selected', function(event, suggestion, dataset) {
                window.location.href = '{{url("topic/show")}}'+'/'+ suggestion.id;
        });
</script>
</body>
</html>
