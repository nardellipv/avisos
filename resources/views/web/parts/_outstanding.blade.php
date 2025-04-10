<section class="block">
    <div class="container">
        <h2>Avisos Destacados</h2>
        <div class="items grid grid-xl-3-items grid-lg-3-items grid-md-2-items">
            <div class="item">
                <div class="wrapper" {{ $serviceVisit->category_id == 12 || $serviceVisit->category_id == 13 ? "style=background:honeydew;" : ""}}>                            
                    <div class="image">
                        <h3>
                            <a href="{{ route('service', [$serviceVisit->slug, $serviceVisit->ref]) }}" class="title">{{
                                Str::limit($serviceVisit->title, 35) }}</a>
                        </h3>
                        @if ($serviceVisit->photo)
                        <img alt="{{ $serviceVisit->title }}"
                            src="{{ asset('users/' . $serviceVisit->user->id . '/service/' . $serviceVisit->photo) }}"
                            class="image-wrapper background-image">
                        @else
                        <img alt="{{ $serviceVisit->title }}" src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                            class="image-wrapper background-image">
                        @endif
                    </div>
                    <h4 class="location">
                        <a href="#">{{ $serviceVisit->region->name }}</a>
                    </h4>
                    <div class="meta">
                        <figure>
                            <i class="fa fa-calendar-o"></i>Publicado {{ $serviceVisit->created_at->format('d.m.Y') }}
                        </figure>
                        <figure>
                            <a href="#">
                                <i class="fa fa-user"></i>{{ $serviceVisit->user->name }}
                            </a>
                        </figure>
                    </div>
                    <div class="description">
                        <p>{{ Str::limit($serviceVisit->description, 100) }}</p>
                    </div>
                    <a href="{{ route('service', [$serviceVisit->slug, $serviceVisit->ref]) }}"
                        class="detail text-caps underline">{{ $serviceVisit->category_id == 12 || $serviceVisit->category_id == 13 ? 'Ver Trabajo' : 'Ver Servicio' }}</a>
                </div>
            </div>
            <!--end item-->

            <div class="item">
                <div class="wrapper" {{ $serviceLike->category_id == 12 || $serviceLike->category_id == 13 ? "style=background:honeydew;" : ""}}>                            
                    <div class="image">
                        <h3>
                            <a href="{{ route('service', [$serviceLike->slug, $serviceLike->ref]) }}" class="title">{{
                                Str::limit($serviceLike->title, 35) }}</a>
                        </h3>
                        @if ($serviceLike->photo)
                        <img alt="{{ $serviceLike->title }}"
                            src="{{ asset('users/' . $serviceLike->user->id . '/service/' . $serviceLike->photo) }}"
                            class="image-wrapper background-image">
                        @else
                        <img alt="{{ $serviceLike->title }}" src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                            class="image-wrapper background-image">
                        @endif
                    </div>
                    <h4 class="location">
                        <a href="#">{{ $serviceLike->region->name }}</a>
                    </h4>
                    <div class="meta">
                        <figure>
                            <i class="fa fa-calendar-o"></i>Publicado {{ $serviceLike->created_at->format('d.m.Y') }}
                        </figure>
                        <figure>
                            <a href="#">
                                <i class="fa fa-user"></i>{{ $serviceLike->user->name }}
                            </a>
                        </figure>
                    </div>
                    <div class="description">
                        <p>{{ Str::limit($serviceLike->description, 100) }}</p>
                    </div>
                    <a href="{{ route('service', [$serviceLike->slug, $serviceLike->ref]) }}"
                        class="detail text-caps underline">{{ $serviceLike->category_id == 12 || $serviceLike->category_id == 13 ? 'Ver Trabajo' : 'Ver Servicio' }}</a>
                </div>
            </div>
            <!--end item-->

            <div class="item">
                <div class="wrapper">
                    <img src="{{ asset('styleWeb/assets/img/destacado.png') }}" alt="destacado" title="servicio destacado"
                class="image-wrapper background-image">
                </div>
            </div>
            <!--end item-->

        </div>
    </div>
    <div class="background" data-background-color="#fff"></div>
    <!--end background-->
</section>