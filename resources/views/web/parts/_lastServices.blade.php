@section('css')
    <link href="{{ asset('styleWeb/assets/css/star-min.css') }}" rel="stylesheet">
@endsection

<div class="container">
    <div class="row">
        <div class="col-sm-9 page-content col-thin-right">
            <div class="content-box col-lg-12">
                <div class="row row-featured row-featured-category">
                    <div class="col-lg-12  box-title no-border">
                        <div class="inner">
                            <h2><span>Últimos</span>
                                Servicios <a href="{{ route('category.index') }}" class="sell-your-item"> Ver Todos
                                    los servicios <i class="icon-th-list"></i> </a></h2>
                        </div>
                    </div>

                    <div class="adds-wrapper jobs-list">
                        @foreach ($services as $service)
                            <div class="item-list job-item">
                                <div class="col-sm-1  col-xs-2 no-padding photobox">
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
                                <div class="col-sm-10  col-xs-10  add-desc-box">
                                    <div class="add-details jobs-item">
                                        <h5 class="company-title "><a
                                                href="{{ route('category.listCategory', $service->category->slug) }}">{{ $service->category->name }}</a>
                                        </h5>
                                        <h4 class="job-title"><a
                                                href="{{ route('service', [$service->slug, $service->ref]) }}">
                                                {{ $service->title }} </a>
                                        </h4>
                                        <span class="info-row"> <span class="item-location"><i
                                                    class="fa fa-map-marker"></i>
                                                {{ $service->region->name }} </span> <span class="date"></span>

                                            <div class="jobs-desc">
                                                {{ Str::limit($service->description, 150) }}
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
                                                        <a href="{{ route('favorite.add', $service) }}"
                                                            class="email-job">
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
            </div>
        </div>
    </div>
</div>
