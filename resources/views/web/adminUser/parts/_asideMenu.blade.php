<div class="col-sm-3 page-sidebar">
    <aside>
        <div class="inner-box">
            <div class="user-panel-sidebar">
                <div class="collapse-box">
                    <h5 class="collapse-title no-border"> Menú <a href="#MyClassified" data-toggle="collapse"
                            class="pull-right"><i class="fa fa-angle-down"></i></a>
                    </h5>

                    <div class="panel-collapse collapse in" id="MyClassified">
                        <ul class="acc-list">
                            <li><a class="{{ Route::current()->getName() == 'dashboard.index' ? 'active' : '' }}"
                                    href="{{ route('dashboard.index') }}"><i class="icon-user"></i>
                                    Perfil </a></li>
                            @if (userConnect()->type == 'Admin')
                                <li><a href="{{ route('adminDashboard.index') }}" target="_blank"><i
                                            class="icon-user"></i>
                                        Admin </a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="collapse-box">
                    <h5 class="collapse-title"> Servicios <a href="#MyAds" data-toggle="collapse" class="pull-right"><i
                                class="fa fa-angle-down"></i></a></h5>

                    <div class="panel-collapse collapse in" id="MyAds">
                        <ul class="acc-list">
                            <li><a class="{{ Route::current()->getName() == 'favorite.list' ? 'active' : '' }}"
                                    href="{{ route('favorite.list') }}"><i class="icon-heart"></i>
                                    Mis Favoritos <span class="badge">{{ $countFavorite }}</span>
                                </a></li>
                            @if (userConnect()->type == 'Anunciante')
                                <li><a href="{{ route('service.list') }}"><i class="icon-docs"></i> Mis Servicios
                                        <span class="badge">{{ $countService }}</span> </a></li>
                                <li><a href="{{ route('service.pending') }}"><i class="fa fa-clock-o"></i>
                                        Pendientes <span class="badge">{{ $countPendingService }}</span>
                                    </a></li>
                                <li><a href="{{ route('message.list') }}"><i class="fa fa-envelope"></i>
                                        Mensajes <span class="badge">{{ $countPendingMessages }}</span></a></li>
                                {{-- <li><a href="account-pending-approval-ads.html"><i class="icon-hourglass"></i>
                                        Pending approval <span class="badge">42</span></a></li> --}}
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="collapse-box">
                    <div class="panel-collapse collapse in" id="TerminateAccount">
                        <ul class="acc-list">
                            <li><a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="glyphicon glyphicon-off"></i> Salir </a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
