<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! SEOMeta::generate() !!}
  	{!! OpenGraph::generate() !!}
  	{!! Twitter::generate() !!}

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'>

    <!-- styles -->
    <link href="{{ mix('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ mix('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ mix('css/owl.theme.css') }}" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="{{ mix('css/style.default.css') }}" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="{{ mix('css/custom.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.png">

    @yield('css')
    <script type="text/javascript">
      var _appBaseUrl = '{{ url('/') }}';
      @yield('js-variables')
    </script>
  </head>
  <body>

    @include('layouts.partials._bar')
    @include('layouts.partials._navbar')
    <div id="all">
      @yield('content')
      @include('layouts.partials._footer')
    </div>

    <script src="https://use.fontawesome.com/5e62eba060.js"></script>
    <script src="{{ asset('js/plugins/respond.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.cookie.min.js') }}"></script>
    <script src="{{ asset('js/plugins/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/plugins/modernizr.min.js') }}"></script>
    <script src="{{ asset('js/plugins/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('js/plugins/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.lazy-master/jquery.lazy.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery.lazy-master/jquery.lazy.plugins.min.js') }}"></script>
    <script src="{{ asset('js/plugins/pace.min.js') }}"></script>
    <script src="{{ mix('js/front.js') }}"></script>
    <script src="{{ mix('js/init.js') }}"></script>
    <script src="{{ mix('js/frontend/cart.js') }}"></script>
    @yield('scripts')
  </body>
</html>
