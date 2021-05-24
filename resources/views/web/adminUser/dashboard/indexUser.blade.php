@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-sm-9 page-content">
                    <div class="inner-box">
                        <div class="row">
                            <div class="col-md-5 col-xs-4 col-xxs-12">
                                <h3 class="no-padding text-center-480 useradmin"><a href="">
                                        @if ($user->photo)
                                            <img src="{{ asset('users/' . $user->id . '/images/120x120-' . $user->photo) }}"
                                                alt="foto perfil" class="userImg">
                                        @else
                                            <img src="{{ asset('styleWeb/assets/user.png') }}" class="userImg" alt="Logo">
                                        @endif
                                        {{ $user->name }}
                                    </a></h3>
                            </div>
                            @if (userConnect()->type == 'Anunciante')
                                <div class="col-md-7 col-xs-8 col-xxs-12">
                                    <div class="header-data text-center-xs">

                                        <div class="hdata">
                                            <div class="mcol-left">
                                                <i class="fa fa-eye ln-shadow"></i>
                                            </div>
                                            <div class="mcol-right">
                                                <p><a href="#">{{ $countVisit }}</a> <em>visitas</em></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="hdata">
                                            <div class="mcol-left">
                                                <i class="icon-th-thumb ln-shadow"></i>
                                            </div>
                                            <div class="mcol-right">
                                                <p><a href="#">{{ $countService }}</a><em>Servicios</em></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="hdata">
                                            <div class="mcol-left">
                                                <i class="icon-heart ln-shadow"></i>
                                            </div>
                                            <div class="mcol-right">
                                                <p><a href="#">{{ $countFavorite }}</a> <em>Favoritos </em></p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>

                            @else
                                <div class="col-md-7 col-xs-8 col-xxs-12">
                                    <div class="header-data text-center-xs">
                                        <a href="{{ route('dashboard.changeType', $user) }}" id="button2id"
                                            name="button2id" class="btn btn-warning btn-post">Convertite en
                                            anunciante
                                        </a>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                    <div class="inner-box">
                        @include('web.alerts.error')
                        <div class="welcome-msg">
                            <h3 class="page-sub-header2 clearfix no-padding">Hola, {{ $user->name }} </h3>
                            <span class="page-sub-header-sub small">Usuario Tipo: <b>{{ $user->type }}</b></span>
                        </div>
                        <div id="accordion" class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB1" data-toggle="collapse"> Mi Perfil </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseB1">
                                    <div class="panel-body">
                                        <form action="{{ route('profile.updateProfile', $user) }}" class="form-horizontal"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Nombre</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="name" value="{{ $user->name }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Apellido</label>

                                                <div class="col-sm-9">
                                                    <input type="text" name="lastname" value="{{ $user->lastname }}"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Email</label>

                                                <div class="col-sm-9">
                                                    <input type="email" name="email" value="{{ $user->email }}"
                                                        class="form-control" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Localidad</label>

                                                <div class="col-sm-9">
                                                    <select class="form-control" name="region_id">
                                                        <option value="{{ $user->region_id }}">
                                                            {{ $user->region->name }}</option>
                                                        <option disabled>---------------------</option>
                                                        @foreach ($regions as $region)
                                                            <option value="{{ $region->id }}">{{ $region->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @if (userConnect()->type == 'Anunciante')
                                                <div class="form-group">
                                                    <label for="Phone" class="col-sm-3 control-label">Teléfono</label>

                                                    <div class="col-sm-9">
                                                        <input type="text" name="phone" value="{{ $user->phone }}"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="textarea"> Picture </label>

                                                <div class="col-md-8">
                                                    <div class="mb10">
                                                        <input id="input-upload-img1" name="photo" type="file" class="file"
                                                            data-preview-file-type="text">
                                                    </div>
                                                    {{-- <p class="help-block">Add up to 5 photos. Use a real image of your
                                                        product, not catalogs.</p> --}}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-default">Actualizar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB2" data-toggle="collapse"> Contraseña </a>
                                    </h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseB2">
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form"
                                            action="{{ route('profile.updatePassword') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Contraseña Actual</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="current_password" class="form-control"
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Nueva Contraseña</label>

                                                <div class="col-sm-9">
                                                    <input type="password" name="new_password" class="form-control"
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Confirmar Contraseña</label>

                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" name="new_confirm_password"
                                                        placeholder="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9">
                                                    <button type="submit" class="btn btn-default">Actualizar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="#collapseB3" data-toggle="collapse">
                                            Preferences </a></h4>
                                </div>
                                <div class="panel-collapse collapse" id="collapseB3">
                                    <div class="panel-body">
                                        <form class="form-horizontal" role="form"
                                            action="{{ route('profile.updateNewsLetters') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input name="recive" type="checkbox"
                                                                {{ $newsLetter->recive == 'Y' ? 'checked' : '' }}>
                                                            Quiero recibir noticias del sitio. </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <button type="submit" class="btn btn-default"
                                                            style="margin-top: 10px">Actualizar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('styleWeb/assets/js/fileinput.min.js') }}" type="text/javascript"></script>
    <script>
        // initialize with defaults
        $("#input-upload-img1").fileinput();

    </script>
@endsection
