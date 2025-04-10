<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {!! SEO::generate() !!}

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('styleWeb/assets/bootstrap/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('styleWeb/assets/fonts/font-awesome.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('styleWeb/assets/css/selectize-min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('styleWeb/assets/css/style-min.css') }}">

    @yield('css')
    @flashStyle

    {!! htmlScriptTagJsApi() !!}
    @include('external.analytics')
    @include('external.shareit')
    {{-- @include('external.pixel') --}}
    {{-- @include('external.hotjar') --}}
    @include('external.ads')

</head>

<body>
    <div class="page home-page">

        @include('web.parts._menu')

        <section class="content">
            @yield('content')
        </section>

        @include('web.parts._footer')
    </div>

    @flashScript
    @flashRender
    <script src="{{ asset('styleWeb/assets/js/jquery-3.3.1.min.js') }}"></script>
    {{-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script> --}}
    <script type="text/javascript" src="{{ asset('styleWeb/assets/js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('styleWeb/assets/bootstrap/js/bootstrap.min.js') }}"></script>

    @yield('js')

    <script src="{{ asset('styleWeb/assets/js/selectize.min.js') }}"></script>
    <script src="{{ asset('styleWeb/assets/js/icheck.min.js') }}"></script>
    <script src="{{ asset('styleWeb/assets/js/custom.js') }}"></script>

</body>

</html>