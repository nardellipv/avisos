<div class="col-md-3">
    <nav class="nav flex-column side-nav">
        <a class="nav-link icon {{ Route::current()->getName() == 'dashboard.index' ? 'active' : '' }}"
            href="{{ route('dashboard.index') }}">
            <i class="fa fa-desktop"></i>Mis Datos
        </a>
        <a class="nav-link icon {{ Route::current()->getName() == 'dashboard.personalData' ? 'active' : '' }}"
            href="{{ route('dashboard.personalData', ['id'=>userConnect(),'name'=>userConnect()->name]) }}">
            <i class="fa fa-user"></i>Datos Personales
        </a>
        @if (userConnect()->type == 'Admin')
        <a class="nav-link icon" href="{{ route('adminDashboard.index') }}" target="_blank">
            <i class="fa fa-user"></i>Aministración
        </a>
        @endif
        <a class="nav-link icon {{ Route::current()->getName() == 'favorite.list' ? 'active' : '' }}"
            href="{{ route('favorite.list') }}">
            <i class="fa fa-heart"></i>Servicios Favoritos ({{ $countFavorite }})
        </a>

        @if (userConnect()->type == 'Anunciante')
        <a class="nav-link icon" href="{{ route('service.list') }}">
            <i class="fa fa-star"></i>Mis Servicios ({{ $countService }})
        </a>
        <a class="nav-link icon {{ Route::current()->getName() == 'service.pending' ? 'active' : '' }}"
            href="{{ route('service.pending') }}">
            <i class="fa fa-clock-o"></i>Servicios Pendientes ({{ $countPendingService }})
        </a>
        <a class="nav-link icon {{ Route::current()->getName() == 'message.list' ? 'active' : '' }}"
            href="{{ route('message.list') }}">
            <i class="fa fa-envelope"></i>Mensajes ({{ $countPendingMessages }})
        </a>
        @endif

        <a class="nav-link icon" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>Salir
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </nav>
</div>