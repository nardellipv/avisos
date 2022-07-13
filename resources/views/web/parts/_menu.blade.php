<header class="hero">
    <div class="hero-wrapper">
        <div class="main-navigation">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('styleWeb/assets/logo_chico.png') }}" alt="avisos mendoza logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
                        aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                            </li>
                            @if (!Auth::check())
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="btn btn-primary small">Registrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="btn btn-info small">Ingresar</a>
                            </li>
                            @else
                            <li class="nav-item active has-child">
                                <a class="nav-link" href="#">{{ userConnect()->name }}</a>
                                <ul class="child">
                                    <li class="nav-item"><a href="{{ route('dashboard.index') }}" class="nav-link"> Mis
                                        Datos
                                    </a></li>
                                    <li class="nav-item"><a href="{{ route('service.list') }}" class="nav-link"> Mis
                                            Servicios
                                            ({{ $countService }})
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('service.pending') }}" class="nav-link">
                                            Servicios Pendientes ({{ $countPendingService }})
                                        </a></li>
                                    <li class="nav-item"><a href="{{ route('message.list') }}" class="nav-link">
                                            Mensajes ({{ $countPendingMessages }})
                                        </a></li>
                                </ul>
                            </li>

                            @if (userConnect()->type == 'Anunciante')
                            <li class="nav-item">
                                <a href="{{ route('service.create') }}"
                                    class="btn btn-primary text-caps btn-rounded btn-framed">Subir un
                                    servicio</a>
                            </li>
                            @endif
                        </ul>
                        @endif
                    </div>
                </nav>
            </div>
            @if (Route::current()->getName() == 'home')
            @include('web.parts._header')
            @endif
        </div>
    </div>
</header>