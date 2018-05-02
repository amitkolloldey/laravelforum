@include('partials.header')


<section class="content">

    <div class="container">
        <div class="row">
            @yield('content')

            @yield('sidebar')
        </div>
    </div>
@yield('partials.pagination')

</section>
@include('partials.footer')