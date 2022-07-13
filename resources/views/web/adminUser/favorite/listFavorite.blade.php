@extends('layouts.main')

@section('content')
<section class="content">
    <section class="block">
        <div class="container">
            <div class="row">
                @include('web.adminUser.parts._asideMenu')
                <div class="col-md-9">
                    <div class="items list compact grid-xl-3-items grid-lg-2-items grid-md-2-items">
                        @forelse ($favorites as $favorite)
                        <div class="item">
                            @if($favorite->service->publish == 'Destacado')
                            <div class="ribbon-featured">Destacado</div>
                            @endif
                            <div class="wrapper">
                                <div class="image">
                                    <h3>
                                        <p>{{ Str::limit($favorite->service->title, 50) }}</p>
                                    </h3>
                                    @if ($favorite->service->photo)
                                    <img alt="{{ $favorite->service->title }}"
                                        src="{{ asset('users/' . $favorite->service->user->id . '/service/' . $favorite->service->photo) }}"
                                        class="image-wrapper background-image">
                                    @else
                                    <img alt="{{ $favorite->service->title }}"
                                        src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                        class="image-wrapper background-image">
                                    @endif
                                </div>
                                <h4 class="location">
                                    <a href="#">{{ $favorite->service->region->name }} - {{
                                        $favorite->service->category->name }}</a>
                                </h4>
                                <div class="admin-controls">
                                    <a href="{{ route('favorite.delete', $favorite) }}" class="ad-remove">
                                        <i class="fa fa-trash"></i>Eliminar
                                    </a>
                                </div>
                                <div class="additional-info">
                                    <ul>
                                        <li>
                                            <figure>Visto por:</figure>
                                            <aside>{{ $favorite->service->visit }} usuarios</aside>
                                        </li>
                                        <li>
                                            <figure>Actualizado</figure>
                                            <aside>{{
                                                \Carbon\Carbon::parse($favorite->service->updated_at)->diffForHumans()
                                                }}</aside>
                                        </li>
                                        <li>
                                            <figure>Finaliza</figure>
                                            <aside>{{
                                                \Carbon\Carbon::parse($favorite->service->end_date)->format('d/m/Y') }}
                                            </aside>
                                        </li>
                                        <li>
                                            <figure>Estado</figure>
                                            <aside>{{ $favorite->service->status }}</aside>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('service', [$favorite->service->slug, $favorite->service->ref]) }}"
                                    class="detail text-caps underline">Ir al Servicio</a>
                            </div>
                        </div>
                        @empty
                        <p>Todavía no agregas ningún servicio como favorito</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection