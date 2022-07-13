@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <form class="form clearfix" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="col-form-label required">Email</label>
                            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" placeholder="Ingresar Email" value="{{ old('email') }}" required
                                autocomplete="email" autofocus>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="form-group">
                            <label for="password" class="col-form-label required">Contraseña</label>
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Ingresar Contraseña" required autocomplete="current-password">
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="d-flex justify-content-between align-items-baseline">
                            <label>
                                <input type="checkbox" name="remember" value="1">
                                Recordarme
                            </label>
                            <button type="submit" class="btn btn-primary">Ingresar</button>
                        </div>
                    </form>
                    <hr>
                    <p>
                        No tengo cuenta... <a href="{{ route('register') }}" class="link">Registrarme!</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection