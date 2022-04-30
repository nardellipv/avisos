@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-sm-9 page-content">
                    {{--  cabecera  --}}
                    @include('web.adminUser.dashboard.header')

                    {{--  notificaciones  --}}
                    @include('web.adminUser.dashboard.notification')

                    {{--  destacar servicios  --}}
                    @include('web.adminUser.dashboard.sponsor')

                    {{--  perfil  --}}
                    @include('web.adminUser.dashboard.profile')
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script async src="{{ asset('styleWeb/assets/js/fileinput.min-min.js') }}" type="text/javascript"></script>
    <script async>
        // initialize with defaults
        $("#input-upload-img1").fileinput();

    </script>
@endsection
