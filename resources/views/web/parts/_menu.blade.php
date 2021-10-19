<div class="header">
    <nav class="navbar   navbar-site navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span></button>
                <a href="{{ route('home') }}" class="navbar-brand logo logo-title">
                    <img src="{{ asset('styleWeb/assets/logo.png') }}" class="img-responsive" alt="Avisos Mendoza">
                </a>
            </div>
            <div class="navbar-collapse collapse">

                <ul class="nav navbar-nav navbar-left">
                    <li><img src="{{ $temp['condition']['icon'] }}"></li>
                    <li>
                        <p> Actual: {{ $temp['forecast']['temp'] }}°</p>
                        <p> Mín: {{ $temp['forecast']['temp_min'] }}°</p>
                    </li>
                    {{--  <li><a href="{{ route('home') }}">Home</a></li> --}}
                    {{-- <li><a href="">Add Resume</a></li> --}}

                </ul>

                @if (!Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('blog.list') }}">Visita Nuestro Blog</a></li>
                    <li><a href="{{ route('login') }}">Ingresar</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                    <li class="postadd"><a class="btn btn-block btn-border btn-post btn-danger"
                            href="{{ route('service.create') }}">Subir un servicio</a></li>
                </ul>
                @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('blog.list') }}"><b style="color: red">Visita Nuestro Blog</b></a></li>
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span>{{ userConnect()->name }}</span> <i class="icon-user fa"></i>
                            @if (userConnect()->type == 'Anunciante')
                            @if ($countPendingService > 0 or $countPendingMessages > 0)
                            <img src="{{ asset('styleWeb/assets/red_point.png') }}"
                                style="height: 50%;margin: 0 0 10% -4%;">
                            @endif
                            @endif
                            <i class=" icon-down-open-big fa"></i>
                        </a>
                        <ul class="dropdown-menu user-menu">
                            <li class="active"><a href="{{ route('dashboard.index') }}"><i class="icon-user"></i>
                                    Perfil
                                </a></li>

                            <li><a href="{{ route('favorite.list') }}"><i class="icon-heart"></i> Servicios
                                    Favoritos ({{ $countFavorite }})</a>
                            </li>
                            @if (userConnect()->type == 'Anunciante')
                            <li><a href="{{ route('service.list') }}"><i class="icon-docs"></i> Mis Servicios
                                    ({{ $countService }})
                                </a></li>
                            <li><a href="{{ route('service.pending') }}"><i class="fa fa-clock-o"></i>
                                    Servicios Pendientes ({{ $countPendingService }})
                                </a></li>
                            <li><a href="{{ route('message.list') }}"><i class="fa fa-envelope"></i>
                                    Mensajes ({{ $countPendingMessages }})
                                </a></li>
                            @endif
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="glyphicon glyphicon-off"></i> Salir </a>
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @if (userConnect()->type == 'Anunciante')
                    <li class="postadd"><a class="btn btn-block btn-border btn-post btn-danger"
                            href="{{ route('service.create') }}">Subir un servicio</a></li>
                    @endif
                </ul>
                @endif
            </div>
        </div>
    </nav>
</div>