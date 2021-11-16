@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-8 page-content">
                    <div class="inner-box category-content">
                        <h2 class="title-2"><i class="icon-user-add"></i> Creá tu cuenta totalmente gratis </h2>

                        <div class="row">
                            <div class="col-sm-12">
                                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <fieldset>
                                        <div class="form-group required">
                                            <label class="col-md-4 control-label">Soy <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="type" id="optionsRadios1" value="Cliente"
                                                            checked>
                                                        Particular </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="type" id="optionsRadios2"
                                                            value="Anunciante">
                                                        Empresa u Ofrezco un Servicio </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group required">
                                            <label class="col-md-4 control-label">Nombre <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input id="name" placeholder="Nombre"
                                                    class="form-control input-md @error('name') is-invalid @enderror"
                                                    required autocomplete="name" name="name" autofocus
                                                    value="{{ old('name') }}" type="text">
                                            </div>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Text input-->
                                        <div class="form-group required">
                                            <label class="col-md-4 control-label">Apellido <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input id="lastname" type="text" name="lastname" placeholder="Apellido"
                                                    class="form-control input-md @error('lastname') is-invalid @enderror"
                                                    type="text" value="{{ old('lastname') }}" required
                                                    autocomplete="lastname" autofocus>
                                            </div>
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group required">
                                            <label for="email" class="col-md-4 control-label">Email
                                                <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <input type="email"
                                                    class="form-control  @error('email') is-invalid @enderror" id="email"
                                                    placeholder="Email" name="email" value="{{ old('email') }}" required
                                                    autocomplete="email">
                                            </div>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group required">
                                            <label for="email" class="col-md-4 control-label">Localidad
                                                <sup>*</sup></label>

                                            <div class="col-md-6">
                                                <select id="inputState" name="region_id" class="form-control floating" required>
                                                    <option value="">Elegir Localidad</option>
                                                    <option disabled>---------------------</option>
                                                    @foreach ($regions as $region)
                                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label for="inputPassword3" class="col-md-4 control-label">Password </label>

                                            <div class="col-md-6">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="inputPassword3" placeholder="Password" name="password" required
                                                    autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <p class="help-block">Mínimo 8 caracteres
                                                    <!--Example block-level help text here.-->
                                                </p>
                                            </div>
                                        </div>

                                        <div class="form-group required">
                                            <label for="password-confirm" class="col-md-4 control-label">Password </label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password"
                                                    placeholder="Repetir Password" name="password_confirmation" required
                                                    autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-4 control-label"></label>

                                            <div class="col-md-8">
                                                <div class="termbox mb10">
                                                    <label class="checkbox-inline" for="checkboxes-1">
                                                        <input name="checkboxes" id="checkboxes-1" value="1"
                                                            type="checkbox" required>
                                                        Leí y estoy de acuerdo con los <a
                                                            href="{{ route('terms') }}">Términos y condiciones</a> </label>
                                                </div>
                                                <div style="clear:both"></div>
                                                <button class="btn btn-primary" type="submit">Registrarme</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.page-content -->

                <div class="col-md-4 reg-sidebar">
                    <div class="reg-sidebar-inner text-center">
                        <div class="promo-text-box"><img src="{{ asset('styleWeb/assets/notes.png') }}"
                                class="img-responsive" style="width: 25%;display: block;margin:auto;">

                            <h3><strong>Publicá tus Servicios</strong></h3>

                            <p> Colocar publicidad en Avisos Mendoza es muy fácil y su función es como la publicidad en los
                                periódicos locales. Su ventaja es que sus anuncios llegarán a un público más
                                amplio. Lo que lo hace aún más interesante es que puede cargar una imagen o agregar un
                                enlace a su sitio web.</p>
                        </div>
                        <div class="promo-text-box"><img src="{{ asset('styleWeb/assets/share.png') }}"
                            class="img-responsive" style="width: 25%;display: block;margin:auto;">

                            <h3><strong>Crear y compartir</strong></h3>

                            <p> Crea tus servicios y compartilos en tus redes sociales. Avisos Mendoza también comparte en
                                sus redes la mayoría de los servicios publicados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
@endsection
