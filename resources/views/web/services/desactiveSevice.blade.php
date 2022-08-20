@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-9">
                    <div class="section-title clearfix">
                        <div class="float-left float-xs-none">
                            <h3 class="mr-3 align-text-bottom">El servicio no se encuentra actualmente activo, pero puedes ver 
                                el siguiente listado de servicios.</h3>
                        </div>
                    </div>
                    <div class="items list grid-xl-3-items grid-lg-3-items grid-md-2-items">
                        @foreach ($services as $service)
                        <div class="item">
                            @if($service->publish == 'Destacado')
                            <div class="ribbon-featured">Recomendado</div>
                            @endif
                            <div class="wrapper" {{ $service->category_id == 12 || $service->category_id == 13 ? "style=background:honeydew;" : ""}}>
                                <div class="image">
                                    <h3>
                                        <a href="{{ route('service', [$service->slug, $service->ref]) }}" class="title">{{
                                            Str::limit($service->title, 29) }}</a>
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
                                    <figure>
                                        <a href="#">
                                            <i class="fa fa-comments"></i>Comentarios ({{ $service->comment_count }})
                                        </a>
                                    </figure>
                                </div>
                                <div class="description">
                                    <p>{{ Str::limit($service->description, 100) }}</p>
                                </div>
                            </div>
                            <a href="{{ route('service', [$service->slug, $service->ref]) }}"
                                class="detail text-caps underline">{{ $service->category_id == 12 || $service->category_id == 13 ? 'Ver Trabajo' : 'Ver Servicio' }}</a>
                        </div>
                        @endforeach
                    </div>
                    <div class="page-pagination">
                        <nav aria-label="Pagination">
                            <ul class="pagination">
                                {{ $services->render() }}
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3">
                    <aside class="sidebar">
                        @include('web.categories._asideList')
                    </aside>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection