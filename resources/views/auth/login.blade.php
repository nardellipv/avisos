@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-md-4">
                    <div class="text-center mb-3">
                        <a href="{{ route('login.google') }}" class="btn btn-light border w-100 d-flex align-items-center justify-content-center px-3 py-2" style="text-decoration: none;">
                            <div class="d-flex align-items-center">
                                <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google Logo" width="20" style="margin-right: 10px;">
                                <span style="font-weight: 500;">Continuar con Google</span>
                            </div>
                        </a>
                        
                    </div>
                    <div class="d-flex align-items-center my-3">
                        <hr class="flex-grow-1">
                        <span class="px-2 text-muted" style="font-size: 1rem;">o continuar con tu email</span>
                        <hr class="flex-grow-1">
                    </div>
                    
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