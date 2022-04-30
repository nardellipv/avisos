@section('css')
<link href="{{ asset('styleWeb/assets/css/owl.carousel.css') }}" rel="stylesheet">
@endsection

<div class="container">
    <div class="col-lg-12 content-box ">
        <div class="row row-featured">
            <div style="clear: both"></div>
            @if(!$servicesPublish->isEmpty())
            <div class=" relative  content  clearfix">
                <div class="col-lg-12 content-box ">
                    <div class="row row-featured">
                        <div class="col-lg-12  box-title ">
                            <div class="inner">
                                <h2><span>Servicios </span>
                                    Recomendados</h2>
                            </div>
                        </div>

                        <div style="clear: both"></div>

                        <div class=" relative  content featured-list-row clearfix">

                            <nav class="slider-nav has-white-bg nav-narrow-svg">
                                <a class="prev">
                                    <span class="nav-icon-wrap"></span>

                                </a>
                                <a class="next">
                                    <span class="nav-icon-wrap"></span>
                                </a>
                            </nav>

                            <div class="no-margin featured-list-slider ">
                                @foreach($servicesPublish as $servicePublish)
                                <div class="item">
                                    <a href="{{ route('service', [$servicePublish->slug, $servicePublish->ref]) }}">
                                        <span class="item-carousel-thumb">
                                            @if ($servicePublish->photo)
                                            <img alt="{{ $servicePublish->title }}"
                                                src="{{ asset('users/' . $servicePublish->user->id . '/service/' . $servicePublish->photo) }}">
                                            @else
                                            <img alt="{{ $servicePublish->title }}"
                                                src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}">
                                            @endif
                                        </span>
                                        <span class="item-name"> {{ $servicePublish->title }} </span>
                                        <span class="price"> {{ $servicePublish->region->name }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <img id="sponsorImage" src="{{ asset('styleWeb/assets/img/sponsor.png') }}">
            @endif
        </div>
    </div>
</div>

@section('js')
<script src="{{ asset('styleWeb/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('styleWeb/assets/js/script-min.js') }}"></script>
@endsection