<aside>
    <div class="inner-box">
        @if (Route::current()->getName() == 'category.listCategory')
            <div class="locations-list  list-filter">
                <h5 class="list-title"><strong><a href="#">SubCategorías</a></strong></h5>


                <ul class="browse-list list-unstyled long-list">
                    @foreach ($subcategories as $subcategory)
                        <li><a href="{{ route('category.listSubCategory', [$category->slug, $subcategory]) }}">{{ $subcategory->name }} <span
                                    class="count">{{ $subcategory->service_count }}</span> </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        @endif

        <div class="locations-list  list-filter">
            <h5 class="list-title"><strong><a href="#">Categorías</a></strong></h5>
            <ul class="browse-list list-unstyled long-list">
                @foreach ($categories as $category)
                    <li><a href="{{ route('category.listCategory', $category->slug) }}">{{ $category->name }}
                        <span class="count">{{ $category->services_count }}</span>
                    </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div style="clear:both"></div>
    </div>

</aside>
