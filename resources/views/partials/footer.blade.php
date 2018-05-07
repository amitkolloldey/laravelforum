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


@yield('scripts')
<script>
    $(document).ready(function() {
        $(' code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
</script>
</body>
</html>
