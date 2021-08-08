@extends('layouts.main')

@section('css')
    <link href="{{ asset('styleWeb/assets/css/star-min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 page-sidebar mobile-filter-sidebar">
                    @include('web.categories._asideList')
                </div>
                <div class="col-sm-9 page-content col-thin-left">

                    <div class="category-list">
                        <div class="tab-box clearfix ">

                            <div class="col-lg-12  box-title no-border">
                                <div class="inner">
                                    <h2><span>
                                            {{--  {{ basename(Request::url()) != 'listado' ? $category->name : 'Todos los servicios' }}  --}}
                                        </span>
                                        <small> {{ count($services) }} encontrados</small>
                                    </h2>
                                </div>
                            </div>

                        </div>

                        {{-- filtro aside movil --}}
                        <div class="mobile-filter-bar col-lg-12  ">
                            <ul class="list-unstyled list-inline no-margin no-padding">
                                <li class="filter-toggle">
                                    <a class="">
                                        <i class="  icon-th-list"></i>
                                        Filtros
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-overly-mask"></div>
                        {{-- -------------------------- --}}


                        <div class="adds-wrapper jobs-list">
                            @foreach ($services as $service)
                                <div class="item-list job-item">

                                    <div class="col-sm-1  col-xs-2 no-padding photobox">
                                        <div class="add-image">
                                            @if ($service->photo)
                                                <div class="add-image"><a
                                                        href="{{ route('service', [$service->slug, $service->ref]) }}"><img
                                                            alt="{{ $service->title }}"
                                                            src="{{ asset('users/' . $service->user->id . '/service/' . $service->photo) }}"
                                                            class="thumbnail no-margin"></a></div>
                                            @else
                                                <div class="add-image"><a
                                                        href="{{ route('service', [$service->slug, $service->ref]) }}"><img
                                                            alt="{{ $service->title }}"
                                                            src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                                            class="thumbnail no-margin"></a></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-10  col-xs-10  add-desc-box">
                                        <div class="add-details jobs-item">
                                            <h5 class="company-title "><a href="">{{ $service->category->name }}</a></h5>
                                            <h4 class="job-title"><a
                                                    href="{{ route('service', [$service->slug, $service->ref]) }}">
                                                    {{ $service->title }} </a></h4>
                                            <span class="info-row"> <span class="item-location"><i
                                                        class="fa fa-map-marker"></i> {{ $service->region->name }}
                                                </span>
                                            </span>

                                            <div class="jobs-desc">
                                                {{ Str::limit($service->description, 100) }}
                                            </div>


                                            <div class="job-actions">
                                                <ul class="list-unstyled list-inline">
                                                    <li>
                                                        <a class="save-job"
                                                            href="{{ route('service', [$service->slug, $service->ref]) }}">
                                                            <span class="fa fa-angle-double-right"></span>
                                                            Ver Servicio
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="" class="email-job">
                                                            <i class="fa fa-tag"></i>
                                                            Favorito
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="" class="email-job">
                                                            <i class="fa fa-comments"></i>
                                                            Comentarios ({{ $service->comment_count }})
                                                        </a>
                                                    </li>

                                                    <li>
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
                                                    </li>

                                                </ul>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>
                    

                    @if (Auth::check())
                        @if (userConnect()->type == 'Anunciante')
                            <div class="post-promo text-center">
                                <h2> ¿Querés publicar tu servicio? </h2>
                                <h5> ¡Registrate totalmente Gratis y publicá tu servicio. Llegá a más clientes! </h5>
                                <a href="{{ route('service.create') }}"
                                    class="btn btn-lg btn-border btn-post btn-danger">Publicar Servicio </a>
                            </div>
                        @else
                            <div class="post-promo text-center">
                                <h2> ¿Querés publicar tu servicio? </h2>
                                <h5> ¡Registrate totalmente Gratis y publicá tu servicio. Llegá a más clientes! </h5>
                                <a href="{{ route('dashboard.changeType', userConnect()) }}" id="button2id"
                                    name="button2id" class="btn btn-warning btn-post">Convertite en
                                    anunciante
                                </a>
                            </div>
                        @endif
                    @else
                        <div class="post-promo text-center">
                            <h2> ¿Querés publicar tu servicio? </h2>
                            <h5> ¡Registrate totalmente Gratis y publicá tu servicio. Llegá a más clientes! </h5>
                            <a href="{{ route('register') }}"
                                class="btn btn-lg btn-border btn-post btn-danger">Registrate Gratis </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script async src="{{ asset('styleWeb/assets/js/owl.carousel.min.js') }}"></script>

    <script async src="{{ asset('styleWeb/assets/js/jquery.matchHeight-min.js') }}"></script>

    <script async src="{{ asset('styleWeb/assets/js/hideMaxListItem.js') }}"></script>

    <script async src="{{ asset('styleWeb/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js') }}"></script>
    <script async src="{{ asset('styleWeb/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js') }}"></script>
    <script async src="{{ asset('styleWeb/assets/js/script.js') }}"></script>
@endsection
