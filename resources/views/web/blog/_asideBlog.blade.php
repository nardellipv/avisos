<aside>
    <div class="inner-box">
        <div class="categories-list  list-filter">
            <h5 class="list-title uppercase"><strong><a href="#"> Categorías</a></strong></h5>
            <ul class=" list-unstyled list-border ">
                @foreach($categoriesBlog as $categoryBlog)
                <li><a href="{{ route('blog.listCategory', $categoryBlog->slug) }}"><span class="title">{{ $categoryBlog->name }}</span><span class="count">
                            ({{ $categoryBlog->blog_count }})</span></a>
                </li>
                @endforeach
            </ul>
        </div>
        <!--/.categories-list-->
        <div class="categories-list  list-filter">
            <h5 class="list-title uppercase"><strong><a href="#"> Últimos Servicios</a></strong></h5>

            <div class="blog-popular-content">
                @foreach($lastServices as $lastService)
                <div class="item-list">
                    <div class="col-sm-4 col-xs-4 no-padding photobox">
                        @if ($lastService->photo)
                        <div class="add-image"><a href="{{ route('service', [$lastService->slug, $lastService->ref]) }}"><img
                                    alt="{{ $lastService->title }}"
                                    src="{{ asset('users/' . $lastService->user->id . '/service/' . $lastService->photo) }}"
                                    class="thumbnail no-margin"></a></div>
                        @else
                        <div class="add-image"><a href="{{ route('service', [$lastService->slug, $lastService->ref]) }}"><img
                                    alt="{{ $lastService->title }}" src="{{ asset('styleWeb/assets/sin_imagen.jpg') }}"
                                    class="thumbnail no-margin"></a></div>
                        @endif

                    </div>
                    <!--/.photobox-->
                    <div class="col-sm-8 col-xs-8 add-desc-box">
                        <div class="add-details">
                            <h5 class="add-title"><a
                                    href="{{ route('service', [$lastService->slug, $lastService->ref]) }}">{{ $lastService->title }}</a>
                            </h5>
                            <span class="info-row"> <span class="date"><i class="fa fa-map-marker"> </i>
                                    {{ $lastService->region->name }} </span> </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</aside>