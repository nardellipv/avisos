@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-md-9">
                     {{--  cabecera  --}}
                     @include('web.adminUser.dashboard.header')

                     {{--  notificaciones  --}}
                     @include('web.adminUser.dashboard.notification')
 
                     {{--  destacar servicios  --}}
                     {{--  @include('web.adminUser.dashboard.sponsor')  --}}
 
                     {{--  perfil  --}}
                     {{--  @include('web.adminUser.dashboard.profile')  --}}
                </div>
            </div>
        </div>
    </section>
</section>
@endsection