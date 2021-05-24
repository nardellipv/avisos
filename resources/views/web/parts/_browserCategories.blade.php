<div class="container">
    <div class="col-lg-12 content-box ">
        <div class="row row-featured row-featured-category row-featured-company">
            <div class="col-lg-12  box-title no-border">
                <div class="inner">
                    <h2><span>Categorías</span>
                        <a class="sell-your-item" href="{{ route('category.index') }}"> Ver listado completo <i
                                class="  icon-th-list"></i> </a>
                    </h2>
                </div>
            </div>

            @foreach ($categories as $category)
                <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 f-category">
                    <a href="{{ route('category.listCategory', $category->slug) }}"><img alt="img"
                            class="img-responsive" src="{{ asset('styleWeb/assets/imgCat/' . $category->slug . '.png') }}">
                        <h6><span class="company-name">{{ Str::limit($category->name, 15) }}</span> <span
                                class="jobs-count text-muted">({{ $category->services_count }})</span>
                        </h6>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div style="clear: both"></div>

</div>
