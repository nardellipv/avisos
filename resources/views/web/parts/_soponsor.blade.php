<section class="content">
    <section class="block">
        <div class="container">
            @if(!$servicesPublish->isEmpty())
            <h2>Servicios Recomendados</h2>
            <div class="items list grid-xl-4-items grid-lg-3-items grid-md-2-items">
                @foreach($servicesPublish as $servicePublish)
                <div class="item">
                    <div class="ribbon-featured">Recomendado</div>
                    <div class="wrapper">
                        <div class="image">
                            <h3>
                                <a href="{{ route('service', [$servicePublish->slug, $servicePublish->ref]) }}" class="title">{{
                                    $servicePublish->title }}</a>
                            </h3>
                            @if ($servicePublish->photo)
                            <img alt="{{ $servicePublish->title }}"
                                src="{{ asset('users/' . $servicePublish->user->id . '/service/' . $servicePublish->photo) }}"
                                class="image-wrapper background-image">
                            @else
                            <img alt="{{ $servicePublish->title }}" src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                class="image-wrapper background-image">
                            @endif
                        </div>
                        <h4 class="location">
                            <a href="#">{{ $servicePublish->region->name }}</a>
                        </h4>
                        <div class="meta">
                            <figure>
                                <i class="fa fa-calendar-o"></i>Publicado {{ $servicePublish->created_at->format('d.m.Y') }}
                            </figure>
                            <figure>
                                <a href="#">
                                    <i class="fa fa-user"></i>{{ $servicePublish->user->name }}
                                </a>
                            </figure>
                        </div>
                        <div class="description">
                            <p>{{ Str::limit($servicePublish->description, 100) }}</p>
                        </div>
                        <a href="{{ route('service', [$servicePublish->slug, $servicePublish->ref]) }}"
                            class="detail text-caps underline">Ver Servicio</a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <img src="{{ asset('styleWeb/assets/img/sponsor.png') }}"
                class="image-wrapper background-image">
            @endif
        </div>
    </section>
</section>