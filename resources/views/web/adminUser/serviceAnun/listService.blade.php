@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-md-9">
                    <div class="items list compact grid-xl-3-items grid-lg-2-items grid-md-2-items">
                        @foreach ($services as $service)
                        <div class="item">
                            @if($service->publish == 'Destacado')
                            <div class="ribbon-featured">Destacado</div>
                            @endif
                            <div class="wrapper">
                                <div class="image">
                                    <h3>
                                        <a href="{{ route('service', [$service->slug, $service->ref]) }}"
                                            class="title">{{
                                            Str::limit($service->title, 50) }}</a>
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
                                    <a href="#">{{ $service->region->name }} - {{ $service->category->name }}</a>
                                </h4>
                                <div class="admin-controls">
                                    <a href="{{ route('service.edit', $service) }}">
                                        <i class="fa fa-pencil"></i>Editar
                                    </a>
                                    @if($service->publish == 'Free')
                                    <a href="{{ route('service.highlight', $service) }}" class="ad-hide">
                                        <i class="fa fa-certificate"></i>Destacar
                                    </a>
                                    @endif
                                    <a href="{{ route('service.delete', $service) }}" class="ad-remove">
                                        <i class="fa fa-trash"></i>Eliminar
                                    </a>
                                </div>
                                <div class="additional-info">
                                    <ul>
                                        <li>
                                            <figure>Visto por:</figure>
                                            <aside>{{ $service->visit }} usuarios</aside>
                                        </li>
                                        <li>
                                            <figure>Actualizado</figure>
                                            <aside>{{ \Carbon\Carbon::parse($service->updated_at)->diffForHumans() }}
                                            </aside>
                                        </li>
                                        <li>
                                            <figure>Finaliza</figure>
                                            <aside>{{ \Carbon\Carbon::parse($service->end_date)->format('d/m/Y') }}
                                            </aside>
                                        </li>
                                        <li>
                                            <figure>Estado</figure>
                                            <aside>{{ $service->status }}</aside>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('service', [$service->slug, $service->ref]) }}"
                                    class="detail text-caps underline">{{ $service->category_id == 12 ||
                                    $service->category_id == 13 ? 'Ver Trabajo' : 'Ver Servicio' }}</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection