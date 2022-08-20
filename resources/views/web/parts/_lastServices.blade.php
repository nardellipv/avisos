<section class="content">
    <section class="block">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-9">
                    <div class="section-title clearfix">
                        <h2>Últimos Publicados</h2>
                    </div>
                    <div class="items list compact grid-xl-3-items grid-lg-3-items grid-md-2-items">
                        @foreach ($services as $service)
                        <div class="item">
                            <div class="wrapper" {{ $service->category_id == 12 || $service->category_id == 13 ? "style=background:honeydew;" : ""}}>                            
                                <div class="image">
                                    <h3>
                                        <a href="{{ route('service', [$service->slug, $service->ref]) }}" class="title">{{
                                            Str::limit($service->title, 35) }}</a>
                                    </h3>
                                    @if ($service->photo)
                                    <img alt="{{ $service->title }}"
                                        src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                                        class="image-wrapper background-image">
                                    @else
                                    <img alt="{{ $service->title }}" src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                        class="image-wrapper background-image">
                                    @endif
                                </div>
                                <h4 class="location">
                                    <a href="#">{{ $service->region->name }}</a>
                                </h4>
                                <div class="meta">
                                    <figure>
                                        <i class="fa fa-calendar-o"></i>Publicado {{ $service->created_at->format('d.m.Y') }}
                                    </figure>
                                    <figure>
                                        <a href="#">
                                            <i class="fa fa-user"></i>{{ $service->user->name }}
                                        </a>
                                    </figure>
                                </div>
                                <div class="description">
                                    <p>{{ Str::limit($service->description, 100) }}</p>
                                </div>
                                <a href="{{ route('service', [$service->slug, $service->ref]) }}"
                                    class="detail text-caps underline">{{ $service->category_id == 12 || $service->category_id == 13 ? 'Ver Trabajo' : 'Ver Servicio' }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3">
                        <section>
                            <img id="sponsorImage" src="{{ asset('styleWeb/assets/img/bannerHome.png') }}" class="image-wrapper background-image">
                        </section>
                </div>
            </div>
        </div>
    </section>
</section>