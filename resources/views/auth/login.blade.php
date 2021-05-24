@extends('layouts.main')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 login-box">
                    <div class="panel panel-default">
                        <div class="panel-intro text-center">
                            <h2 class="logo-title">
                                <!-- Original Logo will be placed here  -->
                                <img src="{{ asset('styleWeb/assets/logo_chico.png') }}"> Avisos<span>Mendoza </span>
                            </h2>
                        </div>
                        <div class="panel-body">
                            <form role="form" class="loginForm" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="sender-email" class="control-label">Email:</label>

                                    <div class="input-icon"><i class="fa fa-envelope fa"></i>
                                        <input id="email" type="email" placeholder="Email"
                                            class="form-control email  @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" name="email" required autocomplete="email" autofocus>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password:</label>

                                    <div class="input-icon"><i class="icon-lock fa"></i>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" id="password" name="password" required autocomplete="current-password">
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <input name="submit" class="btn btn-primary  btn-block" value="Ingresar" type="submit">
                                </div>
                            </form>
                        </div>
                        <div class="panel-footer">

                            <div class="checkbox pull-left">
                                <label> <input type="checkbox" value="1" name="remember" id="remember"> Mantenerme Logueado</label>
                            </div>


                            {{--  <p class="text-center pull-right"><a href="forgot-password.html"> ¿Olvidé mi contraseña? </a>
                            </p>  --}}

                            <div style=" clear:both"></div>
                        </div>
                    </div>
                    <div class="login-box-btm text-center">
                        <p> No tengo cuenta <br>
                            <a href="{{ route('register') }}"><strong>Registrarme !</strong> </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
