@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            @include('web.alerts.error')
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6 col-sm-8">
                    <form class="form clearfix" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="col-form-label required">Soy</label>
                            <figure>
                                <label>
                                    <input type="radio" name="type" value="Cliente" required>
                                    Particular
                                </label>
                                <label>
                                    <input type="radio" name="type" value="Anunciante" required>
                                    Empresa u Ofrezco un servicio
                                </label>
                            </figure>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-form-label required">Nombre</label>
                            <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" placeholder="Ingresar Nombre" required autocomplete="name" name="name"
                                autofocus value="{{ old('name') }}">
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="form-group">
                            <label for="lastname" class="col-form-label required">Apellido</label>
                            <input name="lastname" type="text" class="form-control @error('name') is-invalid @enderror"
                                id="lastname" placeholder="Ingresar Apellido" required autocomplete="lastname"
                                name="lastname" autofocus value="{{ old('lastname') }}">
                        </div>
                        @error('lastname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror


                        <div class="form-group">
                            <label for="email" class="col-form-label required">Email</label>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="Ingresar Email" value="{{ old('email') }}" required
                                autocomplete="email">
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="form-group">
                            <label for="searchable-select" class="col-form-label">Localidad</label>
                            <select name="region_id" id="searchable-select" data-placeholder="Buscar Localidad"
                                data-enable-search="true" required>
                                <option value="">Elegir Localidad</option>
                                <option disabled>---------------------</option>
                                @foreach ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-form-label required">Contraseña</label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Ingresar Contraseña" required autocomplete="new-password">
                            <p class="opacity-80"><code>Mínimo 8 caracteres</code></p>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror


                        <div class="form-group">
                            <label for="password_confirmation" class="col-form-label required">Repetir
                                Contraseña</label>
                            <input name="password_confirmation" type="password" class="form-control"
                                id="password_confirmation" placeholder="Repetir Contraseña" required
                                autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            {!! htmlFormSnippet() !!}
                        </div>


                        <div class="d-flex justify-content-between align-items-baseline">
                            <label>
                                <input type="checkbox" name="recive" value="Y" checked>
                                Recibir Novedades
                            </label>
                            <button type="submit" class="btn btn-primary">Registrarme</button>
                        </div>
                    </form>
                    <hr>
                    <p>
                        Al registrarse esta aceptando nuestros <a href="{{ route('terms') }}" class="link"
                            target="_Blank">términos y
                            condiciones.</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection