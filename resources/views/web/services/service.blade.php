@extends('layouts.main')

@section('css')
<meta property="fb:app_id" content="507631946630340" />
<meta property="fb:admins" content="109559280472432" />

<link href="{{ asset('styleWeb/assets/css/star-min.css') }}" rel="stylesheet">
<link href="{{ asset('styleWeb/assets/plugins/bxslider/jquery.bxslider.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="main-container">
    <div class="container">
        <ol class="breadcrumb pull-left">
            <li><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
            <li><a href="{{ route('category.listCategory', $service->category->slug) }}">Ver listado Servicios</a>
            </li>
            <li class="active">{{ $service->category->name }}</li>
        </ol>
        <div class="pull-right backtolist"><a href="{{ route('category.listCategory', $service->category->slug) }}">
                <i class="fa fa-angle-double-left"></i>
                Volver al Listado</a></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 page-content col-thin-right">
                @include('web.alerts.error')
                <div class="inner inner-box ads-details-wrapper">
                    <h2> {{ $service->title }}
                        <small class="label label-default adlistingtype">{{ $service->category->name }}</small>
                    </h2>
                    <span class="info-row"> <span class="date"><i class=" icon-clock"> </i> Actualizado
                            {{ \Carbon\Carbon::parse($service->updated_at)->diffForHumans() }} </span> -
                        @if ($service->subcategory)
                        <span class="category">
                            {{ $service->subcategory->name }}
                        </span> -
                        @endif
                        <span class="item-location"><i class="fa fa-map-marker"></i>
                            {{ $service->region->name }}
                        </span>
                    </span>

                    <div class="ads-image">
                        {{-- <h1 class="pricetag"> $25</h1> --}}
                        @if ($service->photo)
                        <img src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                            alt="{{ $service->title }}" class="img-responsive" />
                        @else
                        <img src="{{ asset('styleWeb/assets/sin_imagen_grande.png') }}" alt="{{ $service->title }}"
                            class="img-responsive" />
                        @endif
                    </div>



                    <div class="Ads-Details">
                        <h5 class="list-title">Detalles sobre <strong> {{ $service->title }}</strong></h5>

                        <div class="row">
                            <div class="ads-details-info col-md-8">
                                <p> {{ $service->description }} </p>
                            </div>
                            <div class="col-md-4">
                                <div class="ads-action">
                                    <ul class="list-border">
                                        <li><a href="{{ route('service.vote', $service) }}"> <i
                                                    class=" fa fa-thumbs-o-up"></i> Voto positivo </a></li>
                                        <li><a href="{{ route('favorite.add', $service) }}"> <i
                                                    class=" fa fa-heart-o"></i> Agregar a favoritos </a></li>
                                        {{-- <li><a href="#reportAdvertiser" data-toggle="modal"> <i
                                                    class="fa icon-info-circled-alt"></i> Reportar Abuso </a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-sm-9 automobile-left-col">
                                <div class="ads-image">
                                    <ul class="bxslider">
                                        @foreach ($images as $image)
                                        <li><img src="{{ asset('users/' . $service->user->id . '/service/' . $image->name) }}"
                                                alt="img" /></li>
                                        @endforeach
                                    </ul>
                                    <div class="product-view-thumb-wrapper">
                                        <ul id="bx-pager" class="product-view-thumb">
                                            @foreach ($images as $key => $image)
                                            <li><a data-slide-index="{{ $key }}" class="thumb-item-link" href=""><img
                                                        src="{{ asset('users/' . $service->user->id . '/service/' . $image->name) }}"
                                                        alt="img" /></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="sharethis-inline-share-buttons" style="margin: 5% 0% 5% 0%;"></div>
                        <div style="clear: both"></div>

                        <div class="w100 map" id="prop-map">
                            <iframe id="locmap" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyD7eUalpQrZ5TA9BrE5XgsudugZC7TIPYo
                    &q={{ $service->region->name, 'Mendoza', 'Argentina' }}" height="350"
                                style="border:0;   width:100%">
                            </iframe>
                        </div>
                    </div>
                </div>

                @include('web.services.comments')
            </div>

            <div class="col-sm-3  page-sidebar-right">
                <aside>
                    <div class="panel sidebar-panel panel-contact-seller">
                        <div class="panel-heading">Contacto</div>
                        <div class="panel-content user-info">
                            <div class="panel-body text-center">
                                <div class="seller-info">
                                    <h3 class="no-margin">{{ $service->user->name }}</h3>

                                    <p>Ubicación: <strong>{{ $service->region->name }}</strong></p>

                                    <p> Miembro desde:
                                        <strong>{{ \Carbon\Carbon::parse($service->created_at)->format('d/m/Y')
                                            }}</strong>
                                    </p>

                                    <p> Cantidad de Visitas:
                                        <strong>{{ $service->visit }}</strong>
                                    </p>

                                    <p> Cantidad de Votos:
                                        <strong>{{ $service->like }}</strong>
                                    </p>

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

                                </div>
                                <div class="user-ads-action">
                                    <a href="#contactAdvertiser" data-toggle="modal"
                                        class="btn btn-default btn-block"><i class=" icon-mail-2"></i> Enviar Mensaje
                                    </a>
                                    @if ($service->phoneWsp == 'Y' and $service->phone)
                                    <a href="https://api.whatsapp.com/send?phone=549{{ $service->phone }}&text=Hola%20te%20contacto%20desde%20el%20sitio%20avisosmendoza.com.ar%20https%3A%2F%2Favisosmendoza.com.ar"
                                        target="_blank" rel="noopener" aria-label="WhatsApp"
                                        class="btn  btn-info btn-block"><i class="fa fa-whatsapp"></i> Enviar
                                        whatsapp
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel sidebar-panel">
                        <div class="panel-heading">Seguridad Personal</div>
                        <div class="panel-content">
                            <div class="panel-body text-left">
                                <ul class="list-check">
                                    <li> Insista en un lugar de reunión público como una cafetería, un banco o un centro
                                        comercial. </li>
                                    <li> Dígale a un amigo o familiar adónde va. </li>
                                    <li> Lleve su teléfono celular si tiene uno. </li>
                                    <li> Considere la posibilidad de que un amigo lo acompañe. </li>
                                    <li> Confía en tus instintos. </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel sidebar-panel">
                        <div class="panel-heading">Últimos Publicados</div>
                        <div class="panel-content">
                            <div class="panel-body text-left">
                                @foreach ($services as $service)
                                <div class="item"><a href="{{ route('service', [$service->slug, $service->ref]) }}">
                                        <span class="item-carousel-thumb">
                                            @if ($service->photo)
                                            <img class="img-responsive"
                                                src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                                                alt="{{ $service->title }}">
                                            @else
                                            <img class="img-responsive"
                                                src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                                alt="{{ $service->title }}">
                                            @endif
                                        </span>
                                        <p style="text-align: center"> <b>{{ $service->title }}</b> </p>
                                        <p style="text-align: center"><i class="fa fa-map-marker"></i> <i>{{
                                                $service->region->name }}</i> </p>
                                    </a>
                                </div>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
    @include('web.services._modalMessage')

</div>
@endsection

@section('js')
<script src="{{ asset('styleWeb/assets/plugins/bxslider/jquery.bxslider.min.js') }}"></script>
<script>
    $(document).ready(function() {

            // Slider
            var $mainImgSlider = $('.bxslider').bxSlider({
                speed: 1000,
                pagerCustom: '#bx-pager',
                controls: false,
                adaptiveHeight: true
            });

            // initiates responsive slide
            var settings = function() {
                var mobileSettings = {
                    slideWidth: 80,
                    minSlides: 2,
                    maxSlides: 5,
                    slideMargin: 5,
                    adaptiveHeight: true,
                    pager: false,

                };
                var pcSettings = {
                    slideWidth: 100,
                    minSlides: 3,
                    maxSlides: 5,
                    pager: false,
                    slideMargin: 10,
                    adaptiveHeight: true
                };
                return ($(window).width() < 768) ? mobileSettings : pcSettings;
            }

            var thumbSlider;

            function tourLandingScript() {
                thumbSlider.reloadSlider(settings());
            }

            thumbSlider = $('.product-view-thumb').bxSlider(settings());
            $(window).resize(tourLandingScript);

        });

</script>
@endsection