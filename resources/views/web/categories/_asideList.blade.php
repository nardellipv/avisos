<section>
    <h2>Filtro</h2>
    <div class="form-group">
        <label for="what" class="col-form-label">Categorias</label>
        <ul class="features-checkboxes">
            @foreach ($categories as $category)
                @if($category->services_count > 0)
                    <li><a href="{{ route('category.listCategory', $category->slug) }}">{{ $category->name }}
                            <span class="count">({{ $category->services_count }})</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        @if (Route::current()->getName() == 'category.listCategory')
        <label for="what" class="col-form-label">Sub Categorias</label>
        <ul class="features-checkboxes">
            @foreach ($subcategories as $subcategory)
                @if($subcategory->service_count > 0)
                    <li><a href="{{ route('category.listSubCategory', [$category->slug, $subcategory]) }}">{{
                            $subcategory->name
                            }} <span class="count">{{ $subcategory->service_count }}</span> </a>
                    </li>
                @endif
            @endforeach
        </ul>
        @endif
    </div>
</section>