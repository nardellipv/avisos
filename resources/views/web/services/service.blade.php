@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('styleWeb/assets/css/owl.carousel.min.css') }}" type="text/css">
<link href="{{ asset('styleWeb/assets/css/star-min.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <section>
                        <h2>{{ $service->title }}</h2>
                        @include('web.alerts.error')
                        @if ($service->photo)
                        <div class="gallery-carousel owl-carousel">
                            @foreach ($images as $key=>$image)
                            <img src="{{ asset('users/' . $service->user->id . '/service/' . $image->name) }}"
                                alt="{{ $service->category->name }}" title="{{ $service->category->name }}">
                            @endforeach
                        </div>
                        <div class="gallery-carousel-thumbs owl-carousel">
                            @foreach ($images as $key => $image)
                            <a href="#{{ $key }}" class="owl-thumb background-image">
                                <img src="{{ asset('users/' . $service->user->id . '/service/' . $image->name) }}"
                                    alt="{{ $service->category->name }}" title="{{ $service->category->name }}">
                            </a>
                            @endforeach
                        </div>
                        @else
                        <img alt="{{ $service->title }}" src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                            class="image-wrapper background-image">
                        @endif
                    </section>     
                    <hr>               
                    <section>
                        <h2>Descripción</h2>
                        <p>
                            {{ $service->description }}
                        </p>
                    </section>
                    <hr>
                    <section>
                        <h2>Ubicación</h2>
                        <iframe width="100%" frameborder="0" scrolling="no" height="350" style="border:0"
                            marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=612&amp;height=416&amp;hl=en&amp;q={{ $service->region->name}}, mendoza, argentina&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>

                    </section>
                    <section>
                        <ul class="list-unstyled columns-3">
                            <li><h3><a href="{{ route('service.vote', $service) }}"> <i
                                class="text-danger fa fa-thumbs-o-up"></i> Voto positivo </a></h3></li>
                    <li><h3><a href="{{ route('favorite.add', $service) }}"> <i
                                class="text-danger fa fa-heart-o"></i> Agregar a favoritos </a></h3></li>
                    <li><h3><a href="#reportAdvertiser" data-toggle="modal"> <i
                                class="text-danger fa fa-info-circle"></i> Reportar Abuso </a></h3></li>
                        </ul>
                    </section>
                    <hr>
                    <section>
                        <h2>Comparti el servicio</h2>
                        <div class="sharethis-inline-share-buttons" style="margin: 5% 0% 5% 0%;"></div>
                    </section>
                    <hr>
                    <section>
                        @include('web.services.comments')
                    </section>
                </div>
                <div class="col-md-4">
                    <aside class="sidebar">
                        <section>
                            <h2>Datos</h2>
                            <div class="box">
                                <dl>
                                    <dt>Nombre</dt>
                                    <dd>
                                        <h3>{{ $service->user->name }}</h3>
                                    </dd>
                                    <dt>Rating</dt>
                                    <dd>
                                        <div class="ratings">
                                            <div class="empty-stars"></div>
                                            @if ($service->like > 0)
                                            <div class="full-stars"
                                                style="width:{{ round(($service->like * 100) / $service->visit, 0) }}%">
                                            </div>
                                            @else
                                            <div class="full-stars" style="width:0%">
                                            </div>
                                            @endif
                                        </div>
                                    </dd>

                                    <dt>Miembro desde</dt>
                                    <dd>{{ \Carbon\Carbon::parse($service->created_at)->format('d.m.Y') }}</dd>
                                    <dt>Cantidad de Visitas:</dt>
                                    <dd>{{ $service->visit }}</dd>
                                    <dt>Cantidad de Votos:</dt>
                                    <dd>{{ $service->like }}</dd>
                                </dl>

                                @include('web.services._message')
                            </div>
                        </section>
                        <section>
                            <h2>Últimos Publicados</h2>
                            <div class="items">
                                @foreach ($services as $service)
                                <div class="item">
                                    @if($service->publish == 'Destacado')
                                    <div class="ribbon-featured">Recomendado</div>
                                    @endif
                                    <div class="wrapper" {{ $service->category_id == 12 || $service->category_id == 13 ? "style=background:honeydew;" : ""}}>
                                        <div class="image">
                                            <h3>
                                                <a href="{{ route('service', [$service->slug, $service->ref]) }}"
                                                    id="lastPublish">{{
                                                    Str::limit($service->title, 35) }}</a>
                                            </h3>
                                            @if ($service->photo)
                                            <img alt="{{ $service->title }}"
                                                src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                                                class="image-wrapper background-image">
                                            @else
                                            <img alt="{{ $service->title }}"
                                                src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                                class="image-wrapper background-image">
                                            @endif
                                        </div>
                                        <h4 class="location">
                                            <a href="#">{{ $service->region->name }}</a>
                                        </h4>
                                        <div class="meta">
                                            <figure>
                                                <i class="fa fa-calendar-o"></i>Publicado {{
                                                $service->created_at->format('d.m.Y') }}
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
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@section('js')
<script src="{{ asset('styleWeb/assets/js/owl.carousel.min.js') }}"></script>
@endsection