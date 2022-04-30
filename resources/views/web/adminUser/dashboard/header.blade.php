<div class="inner-box">
    <div class="row">
        <div class="col-md-4 col-xs-4 col-xxs-12">
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
            <div class="col-md-8 col-xs-8 col-xxs-12">
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
                            <i class="fa fa-certificate ln-shadow"></i>
                        </div>
                        <div class="mcol-right">
                            <p><a href="#">{{ $countServiceSponsor }}</a><em>Destacados</em></p>
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