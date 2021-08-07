<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fav and touch icons -->

    <link rel="shortcut icon" href="{{ asset('styleWeb/assets/ico/favicon-32x32.png') }}">

    {!! SEO::generate() !!}

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('styleWeb/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('styleWeb/assets/css/style.css') }}" rel="stylesheet">

    @yield('css')

    <!-- styles needed for carousel slider -->

    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- include pace script for automatic web page progress bar  -->

    <script>
        paceOptions = {
            elements: true
        };

    </script>
    <script src="{{ asset('styleWeb/assets/js/pace.min.js') }}"></script>

    {!! htmlScriptTagJsApi() !!}
    @include('external.analytics')
    @include('external.shareit')
    @include('external.pixel')
</head>

<body>

    <div id="wrapper">
        @include('web.parts._menu')
        <!-- /.header -->
        @include('sweetalert::alert')

        @if (Route::current()->getName() == 'home')
        <div class="intro jobs-intro hasOverly"
            style="background-image: url({{ asset('styleWeb/assets/ciudad.jpg') }}); background-position: center center;">
            @include('web.parts._header')
        </div>
        @endif
        <!-- /.intro -->

        <div class="main-container">
            @yield('content')
        </div>

        <!-- /.main-container -->
        @include('web.parts._footer')
        <!-- /.footer -->
    </div>
    <!-- /.wrapper -->

    <!-- Le javascript
================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="{{ asset('styleWeb/assets/bootstrap/js/bootstrap.min.js') }}"></script>

    @yield('js')

</body>
</html>