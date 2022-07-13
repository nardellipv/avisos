<section class="my-0">
    <div class="author big">
        <div class="author-image">
            <div class="background-image">
                @if ($user->photo)
                <img src="{{ asset('users/' . $user->id . '/images/120x120-' . $user->photo) }}" alt="foto perfil">
                @else
                <img src="{{ asset('styleWeb/assets/user.png') }}" alt="Logo">
                @endif
            </div>
        </div>
        <div class="author-description">
            <div class="section-title">
                <h2>{{ $user->name }}</h2>
                <h4 class="location">
                    <a href="#">{{ $user->region->name }}</a>
                </h4>
            </div>

            <div class="additional-info">
                <ul>
                    <li>
                        <figure>Miembro desde</figure>
                        <aside>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</aside>
                    </li>
                    <li>
                        <figure>Email</figure>
                        <aside>{{ $user->email }}</aside>
                    </li>
                    <li>
                        <figure>Cuenta tipo</figure>
                        <aside>{{ $user->type }}</aside>
                    </li>
                </ul>
            </div>
            @if (userConnect()->type == 'Anunciante')      
                @if($countService == 0)
                    <p>Te invitamos a publicar tu primer servicio, es totalmente gratis.</p>
                    <p>Trabajamos diariamente para que tus publicaciones lleguen a la mayor cantidad de mendocinos posibles.</p>
                @endif              
                @if($countService >= 1 AND $countServiceSponsor <= 0)
                    <p>Pobra nuesto pograma de sponsor, destacá tus servicios y llegá a muchos más mendocinos.</p>
                    <a href="{{ route('info.highlight') }}" class="btn btn-warning small">Destaca tus Servicios </a>
                    <br>
                    <br>
                @endif
                @if($countServiceSponsor > 0)
                    <p>Muchas gracias por participar de nuestro programa de sponsor con tus servicios publicados.</p>
                    <p>Lo valoramos mucho y trabajamos diariamente para mejorar y brindarte lo mejor.</p>
                @endif
            @endif
        </div>
        @if (userConnect()->type == 'Anunciante')
        <div class="col-md-12">
            <h3>Estadística de tus servicios</h3>
            <div class="box">
                <section>
                    <dl class="columns-2">
                        <dt>Vistas de tus servicios</dt>
                        <dd>{{ $countVisit }}</dd>
                        <dt>Cantidad de servicios</dt>
                        <dd>{{ $countService }}</dd>
                        <dt>Servicios Destacados</dt>
                        <dd>{{ $countServiceSponsor }}</dd>
                        <dt>Servicios Favoritos</dt>
                        <dd>{{ $countFavorite }}</dd>
                    </dl>
                </section>
            </div>
            @else
            <section>
                <a href="{{ route('dashboard.changeType', $user) }}" 
                    class="btn btn-warning" style="margin-left: 5%;">Convertite en
                    anunciante
                </a>
            </section>
            @endif
        </div>
</section>