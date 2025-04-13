<section class="block">
    <div class="container">
        <h2>Avisos Destacados</h2>
        <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-2-items">

            {{-- Aviso por visitas --}}
            @if ($serviceVisit)
                <div class="item">
                    <div class="wrapper"
                        {{ in_array(optional($serviceVisit)->category_id, [12,13]) ? 'style=background:honeydew;' : '' }}>
                        <div class="image">
                            <h3>
                                <a href="{{ route('service', [$serviceVisit->slug, $serviceVisit->ref]) }}">
                                    {{ Str::limit($serviceVisit->title, 35) }}
                                </a>
                            </h3>
                            @if ($serviceVisit->photo)
                                <img alt="{{ $serviceVisit->title }}"
                                    src="{{ asset('users/' . $serviceVisit->user->id . '/service/' . $serviceVisit->photo) }}"
                                    class="image-wrapper background-image">
                            @else
                                <img alt="{{ $serviceVisit->title }}"
                                    src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                    class="image-wrapper background-image">
                            @endif
                        </div>
                        <h4 class="location">
                            <a href="#">{{ optional($serviceVisit->region)->name }}</a>
                        </h4>
                        <div class="meta">
                            <figure>
                                <i class="fa fa-calendar-o"></i>
                                Publicado {{ optional($serviceVisit->created_at)->format('d.m.Y') }}
                            </figure>
                            <figure>
                                <a href="#">
                                    <i class="fa fa-user"></i>{{ optional($serviceVisit->user)->name }}
                                </a>
                            </figure>
                        </div>
                        <div class="description">
                            <p>{{ Str::limit($serviceVisit->description, 100) }}</p>
                        </div>
                        <a href="{{ route('service', [$serviceVisit->slug, $serviceVisit->ref]) }}"
                            class="detail text-caps underline">
                            {{ in_array($serviceVisit->category_id, [12,13]) ? 'Ver Trabajo' : 'Ver Servicio' }}
                        </a>
                    </div>
                </div>
            @endif
            <!--end item-->

            {{-- Aviso por likes --}}
            @if ($serviceLike)
                <div class="item">
                    <div class="wrapper"
                        {{ in_array(optional($serviceLike)->category_id, [12,13]) ? 'style=background:honeydew;' : '' }}>
                        <div class="image">
                            <h3>
                                <a href="{{ route('service', [$serviceLike->slug, $serviceLike->ref]) }}"
                                    class="title">{{ Str::limit($serviceLike->title, 35) }}</a>
                            </h3>
                            @if ($serviceLike->photo)
                                <img alt="{{ $serviceLike->title }}"
                                    src="{{ asset('users/' . $serviceLike->user->id . '/service/' . $serviceLike->photo) }}"
                                    class="image-wrapper background-image">
                            @else
                                <img alt="{{ $serviceLike->title }}"
                                    src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                    class="image-wrapper background-image">
                            @endif
                        </div>
                        <h4 class="location">
                            <a href="#">{{ optional($serviceLike->region)->name }}</a>
                        </h4>
                        <div class="meta">
                            <figure>
                                <i class="fa fa-calendar-o"></i>
                                Publicado {{ optional($serviceLike->created_at)->format('d.m.Y') }}
                            </figure>
                            <figure>
                                <a href="#">
                                    <i class="fa fa-user"></i>{{ optional($serviceLike->user)->name }}
                                </a>
                            </figure>
                        </div>
                        <div class="description">
                            <p>{{ Str::limit($serviceLike->description, 100) }}</p>
                        </div>
                        <a href="{{ route('service', [$serviceLike->slug, $serviceLike->ref]) }}"
                            class="detail text-caps underline">
                            {{ in_array($serviceLike->category_id, [12,13]) ? 'Ver Trabajo' : 'Ver Servicio' }}
                        </a>
                    </div>
                </div>
            @endif
            <!--end item-->

            {{-- Imagen estática --}}
            <div class="item">
                <div class="wrapper">
                    <img src="{{ asset('styleWeb/assets/img/destacado.png') }}" alt="destacado"
                        title="servicio destacado" class="image-wrapper background-image">
                </div>
            </div>
            <!--end item-->

        </div>
    </div>
    <div class="background" data-background-color="#fff"></div>
</section>
