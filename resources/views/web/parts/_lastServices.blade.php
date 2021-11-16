@section('css')
<link href="{{ asset('styleWeb/assets/css/star-min.css') }}" rel="stylesheet">
@endsection

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 page-content col-thin-left">
                <div class="category-list">
                    <div class="adds-wrapper property-list">
                        @foreach ($services as $service)
                        <div class="item-list">
                            <div class="col-sm-3 no-padding photobox">
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
                            <!--/.photobox-->
                            <div class="col-sm-7 add-desc-box">
                                <div class="add-details">
                                    <h5 class="add-title"><a
                                            href="{{ route('service', [$service->slug, $service->ref]) }}">
                                            {{ $service->title }} </a></h5>
                                    <span class="info-row"> {{ Str::limit($service->description, 100) }} </span>
                                    <div class="prop-info-box">

                                        <div class="prop-info">
                                            <div class="clearfix prop-info-block">
                                                <a href="">
                                                <span class="text"><i class="fa fa-map-marker"></i> {{
                                                    $service->region->name }}</span>
                                                </a>
                                            </div>
                                            <div class="clearfix prop-info-block middle">
                                                <a href="{{ route('favorite.add', $service) }}">
                                                    <span class="text"><i class="fa fa-tag"></i>
                                                        Agregar a Favoritos</span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="clearfix prop-info-block">
                                                <a href="">
                                                    <span class="text"> <i class="fa fa-comments"></i>
                                                            Comentarios ({{ $service->comment_count }})
                                                    </span>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--/.add-desc-box-->
                            <div class="col-sm-2 text-right  price-box">
                                <a class="btn btn-border-thin  btn-share" target="blank_"
                                href="https://facebook.com/sharer/sharer.php?u={{ route('service', [$service->slug, $service->ref]) }}">
                                    <i class="icon icon-export" data-toggle="tooltip" data-placement="left"
                                        title="share"></i>
                                </a>

                                <h3 class="item-price ">
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
                                </h3>
                                <div style="clear: both"></div>

                                <a class="btn btn-success btn-sm bold"
                                    href="{{ route('service', [$service->slug, $service->ref]) }}">
                                    Ver Servicio
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <img src="{{ asset('styleWeb/assets/img/bannerHome.png') }}">
        </div>
    </div>
</div>